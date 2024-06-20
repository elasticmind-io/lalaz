<?php declare(strict_types=1);

namespace Lalaz\Logging;

use Lalaz\Lalaz;

/**
 * Interface Log
 *
 * @author  Elasticmind <ola@elasticmind.io>
 * @package elasticmind\lalaz-framework
 * @link	https://elasticmind.io
 */
final class Log
{
    public static function info($message): void
    {
        static::current()->info($message);
    }

    public static function debug($message): void
    {
        static::current()->debug($message);
    }

    public static function error($error): void
    {
        static::current()->error($message);
    }

    private static function current(): Logger
    {
        return Lalaz::$app->logger;
    }
}
