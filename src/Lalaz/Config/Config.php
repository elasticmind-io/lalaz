<?php declare(strict_types=1);

namespace Lalaz\Config;

/**
 * Class Config
 *
 * @author  Elasticmind <ola@elasticmind.io>
 * @package elasticmind\lalaz-framework
 * @link	https://elasticmind.io
 */
class Config
{
    private static $env;

    public static function load(string $envFile): void
    {
        if (empty(self::$env)) {
            if (is_file($envFile)) {
                $file = new \SplFileObject($envFile);
                $delimiter = '=';

                while (false === $file->eof()) {
                    $contents = trim($file->fgets());

                    if (strpos($contents, $delimiter)) {
                        [$key, $value] = explode($delimiter, $contents, 2);
                        $_ENV[$key] = $value;
                    }
                }
            }
        }

        self::$env = $_ENV;
    }

    public static function get(string $key): mixed
    {
        if (array_key_exists($key, self::$env)) {
            return self::$env[$key];
        }

        return null;
    }
}
