<?php declare(strict_types=1);

namespace Lalaz\Data\Query;

/**
 * Class Expr
 *
 * @author  Elasticmind <ola@elasticmind.io>
 * @package elasticmind\lalaz-framework
 * @link	https://elasticmind.io
 */
class Expr
{
    private array $conditions = [];
    private array $parameters = [];

    public function and(): self
    {
        $this->conditions[] = ' AND ';
        return $this;
    }

    public function or(): self
    {
        $this->conditions[] = ' OR ';
        return $this;
    }

    public function expression(): string
    {
        $q = implode(' ', $this->conditions);
        return $q;
    }

    public function parameters(): array
    {
        return $this->parameters;
    }

    public function eq(string $key, mixed $value): self
    {
        $this->conditions[] = "$key = :$key";
        $this->parameters[$key] = $value;
        return $this;
    }

    public function neq(string $key, mixed $value): self
    {
        $this->conditions[] = "$key <> :$key";
        $this->parameters[$key] = $value;
        return $this;
    }

    public function gt(string $key, mixed $value): self
    {
        $this->conditions[] = "$key > :$key";
        $this->parameters[$key] = $value;
        return $this;
    }

    public function gte(string $key, mixed $value): self
    {
        $this->conditions[] = "$key >= :$key";
        $this->parameters[$key] = $value;
        return $this;
    }

    public function lt(string $key, mixed $value): self
    {
        $this->conditions[] = "$key < :$key";
        $this->parameters[$key] = $value;
        return $this;
    }

    public function lte(string $key, mixed $value): self
    {
        $this->conditions[] = "$key <= :$key";
        $this->parameters[$key] = $value;
        return $this;
    }

    public function null(string $key): self
    {
        $this->conditions[] = "$key IS NULL";
        return $this;
    }

    public function notNull(string $key): self
    {
        $this->conditions[] = "$key IS NOT NULL";
        return $this;
    }

    public function in(string $key, array $values): self
    {
        $inQuery = implode(', ', $values);
        $this->conditions[] = "$key IN ($inQuery)";
        return $this;
    }

    public function notIn(string $key, array $values): self
    {
        $notInQuery = implode(', ', $values);
        $this->conditions[] = "$key NOT IN ($notInQuery)";
        return $this;
    }
}
