<?php declare(strict_types=1);

namespace Lalaz\Data;

use Lalaz\Lalaz;
use Lalaz\Data\Query\Queries;
use Lalaz\Data\Query\Expr;
use Lalaz\Data\Query\Expressions;
use Lalaz\Data\Query\IQueryBuilder;

/**
 * Class ActiveRecord
 *
 * @author  Elasticmind <ola@elasticmind.io>
 * @package elasticmind\lalaz-framework
 * @link	https://elasticmind.io
 */
abstract class ActiveRecord extends Model
{
    abstract public static function tableName(): string;

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function save(): int
    {
        $tableName = $this->tableName();
        $pkName = self::primaryKey();
        $pkValue = $this->{$pkName};

        $props = get_object_vars($this);
        unset($props[$pkName]);

        $attributes = array_keys($props);
        $isNew = empty($pkValue);

        $sql = '';

        if ($isNew) {
            $params = array_map(fn($attr) => ":$attr", $attributes);
            $sql = "INSERT INTO $tableName (" . implode(",", $attributes) . ") VALUES (" . implode(",", $params) . ")";
        } else {
            $params = array_map(fn($attr) => "$attr = :$attr", $attributes);
            $sql = "UPDATE $tableName SET " . join(', ', $params) . " WHERE $pkName = :$pkName";
        }

        $statement = self::prepare($sql);

        if ($isNew) {
            foreach ($attributes as $attribute) {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }
        } else {
            foreach (array_merge($attributes, [$pkValue => $pkName]) as $attribute) {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }
        }

        $statement->execute();

        return $statement->rowCount();
    }

    public function destroy(): int
    {
        $pk = self::primaryKey();
        $tableName = self::tableName();
        $sql = "DELETE FROM $tableName WHERE $pk = :$pk";

        $statement = self::prepare($sql);
        $statement->bindValue(":$pk", $this->{$pk});
        $statement->execute();

        return $statement->rowCount();
    }

    public static function statement(IQueryBuilder $builder): \PDOStatement
    {
        $tableName = static::tableName();

        $sql = $builder->from($tableName)->build();
        $statement = self::prepare($sql);

        return $statement;
    }

    public static function findById($id): mixed
    {
        $tableName = static::tableName();
        $pk = self::primaryKey();

        $expr = Expressions::create()
            ->eq($pk, $id);

        return static::findOneByExpression($expr);
    }

    public static function findOneByExpression(Expr $expr): mixed
    {
        $tableName = static::tableName();

        $builder = Queries::select('*')
            ->from($tableName)
            ->where($expr->expression());

        return static::queryOne($builder, $expr->parameters());
    }

    public static function findAll($orderBy = array()): mixed
    {
        $tableName = static::tableName();

        $builder = static::mountQueryWithOrderBy(
            Queries::select('*')->from($tableName),
            $orderBy
        );

        return static::queryAll($builder);
    }

    public static function findAllByExpression(Expr $expr, $orderBy = array()): mixed
    {
        $tableName = static::tableName();

        $builder = static::mountQueryWithOrderBy(
            Queries::select('*')
                ->from($tableName)
                ->where($expr->expression()),
            $orderBy
        );

        return static::queryAll($builder, $expr->parameters());
    }

    public static function count(): int
    {
        $tableName = static::tableName();

        $sql = Queries::select('COUNT(*)')
            ->from($tableName)
            ->build();

        $statement = self::prepare($sql);
        $statement->execute();

        $result = $statement->fetchColumn();

        return $result;
    }

    public static function countByExpression(Expr $expr): int
    {
        $tableName = static::tableName();

        $sql = Queries::select('COUNT(*)')
            ->from($tableName)
            ->where($expr->expression())
            ->build();

        $statement = static::prepareAndBindParameters($sql, $expr->parameters());
        $statement->execute();

        $result = $statement->fetchColumn();

        return $result;
    }

    public static function existsByExpression(Expr $expr): bool
    {
        $result = static::countByExpression($expr);
        return $result > 0;
    }

    protected static function expression(): Expr
    {
        return Expressions::create();
    }

    protected static function queryOne(IQueryBuilder $builder, array $parameters = array()): mixed
    {
        $sql = $builder->build();

        $statement = static::prepareAndBindParameters($sql, $parameters);
        $statement->execute();

        return $statement->fetchObject(static::class);
    }

    protected static function queryAll(IQueryBuilder $builder, array $parameters = array()): mixed
    {
        $sql = $builder->build();

        $statement = static::prepareAndBindParameters($sql, $parameters);
        $statement->setFetchMode(\PDO::FETCH_CLASS, static::class);
        $statement->execute();

        return $statement->fetchAll();
    }

    protected static function prepare($sql): \PDOStatement
    {
        return Lalaz::$app->db->prepare($sql);
    }

    protected static function prepareAndBindParameters(string $sql, array $parameters = array()): \PDOStatement
    {
        $statement = static::prepare($sql);
        static::bindParameters($statement, $parameters);
        return $statement;
    }

    protected static function bindParameters(\PDOStatement $statement, array $parameters = array()): void
    {
        foreach ($parameters as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
    }

    private static function mountQueryWithOrderBy(IQueryBuilder $builder, array $orderBy = array()): IQueryBuilder
    {
        foreach ($orderBy as $field => $direction) {
            $builder = $builder->orderBy($field, $direction);
        }

        return $builder;
    }
}
