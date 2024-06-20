<?php declare(strict_types=1);

namespace Lalaz\Routing;

use Lalaz\Lalaz;

/**
 * Class Route
 *
 * @author  Elasticmind <ola@elasticmind.io>
 * @package elasticmind\lalaz-framework
 * @link	https://elasticmind.io
 */
final class Route
{
    public static function get($path, $controller, $middlewares = array()): void
    {
        Lalaz::$app->router->get($path, $controller, $middlewares);
    }

    public static function post($path, $controller, $middlewares = array()): void
    {
        Lalaz::$app->router->post($path, $controller, $middlewares);
    }

    public static function put($path, $controller, $middlewares = array()): void
    {
        Lalaz::$app->router->put($path, $controller, $middlewares);
    }

    public static function patch($path, $controller, $middlewares = array()): void
    {
        Lalaz::$app->router->patch($path, $controller, $middlewares);
    }

    public static function delete($path, $controller, $middlewares = array()): void
    {
        Lalaz::$app->router->delete($path, $controller, $middlewares);
    }
}
