<?php declare(strict_types=1);

namespace App\Models;

use Lalaz\Data\ActiveRecord;

class User extends ActiveRecord
{
    public string $role = 'USER';
    public string $name;
    public string $email;
    public string $password;
    public string $dob;
    public ?string $activationCode;
    public int $activated;
    public string $activatedAt;
    public string $createdAt;
    public string $updatedAt;

    public static function tableName(): string
    {
        return 'user';
    }

    public static function countById()
    {
        $q = self::expression()
            ->gte('id', 6);

        return self::findAllByExpression(
            $q,
            ['id' => 'DESC']
        );
    }
}
