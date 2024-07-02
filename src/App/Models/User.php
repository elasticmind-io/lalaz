<?php declare(strict_types=1);

namespace App\Models;

use Lalaz\Data\ActiveRecord;
use Lalaz\Data\Query\Expressions;
use Lalaz\Security\PasswordHash;
use Lalaz\Security\Authenticable;

class User extends ActiveRecord
{
    use Authenticable;

    public int $id;
    public string $username;
    public string $password;
    public string $role;
    public int $active;

    public static function tableName(): string
    {
        return 'user';
    }

    public static function findByUsername(string $username): User|bool
    {
        $filter = Expressions::create()->eq('username', $username);
        $user = self::findOneByExpression($filter);
        return $user;
    }

    private static function loginField(): string
    {
        return 'username';
    }

    private static function passwordField(): string
    {
        return 'password';
    }
}
