<?php declare(strict_types=1);

namespace Lalaz\Security;

use Lalaz\Data\Query\Expressions;

/**
 * trait Authenticable
 *
 * @author  Elasticmind <ola@elasticmind.io>
 * @package elasticmind\lalaz-framework
 * @link	https://elasticmind.io
 */
trait Authenticable
{
    use PasswordHash;

    abstract private static function loginField(): string;
    abstract private static function passwordField(): string;

    public static function authenticate(string $login, string $password): mixed
    {
        $loginField = self::loginField();
        $passwordField = self::passwordField();

        $filter = Expressions::create()->eq("$loginField", $login);
        $user = self::findOneByExpression($filter);

        if (!$user) return false;

        $isValidPassword = self::verifyHash($password, $user->{$passwordField});

        if (!$isValidPassword) return false;

        return $user;
    }
}
