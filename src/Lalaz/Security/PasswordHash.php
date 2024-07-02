<?php declare(strict_types=1);

namespace Lalaz\Security;

/**
 * trait PasswordHash
 *
 * @author  Elasticmind <ola@elasticmind.io>
 * @package elasticmind\lalaz-framework
 * @link	https://elasticmind.io
 */
trait PasswordHash
{
    private const SALT = 'L@laZ1#2F';

    public static function generateHash(string $plainText): string
    {
        $salted = $plainText . self::SALT;

        $hashed = password_hash(
            $salted,
            PASSWORD_ARGON2ID,
            ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]
        );

        return $hashed;
    }

    public static function verifyHash(string $plainText, string $hash): bool
    {
        $salted = $plainText . self::SALT;
        return password_verify($salted, $hash);
    }
}
