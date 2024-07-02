<?php declare(strict_types=1);

namespace Lalaz;

use Lalaz\Config\Config;
use Lalaz\Data\Database;
use Lalaz\Logging\Logger;
use Lalaz\Logging\LogToConsole;
use Lalaz\Routing\Router;

/**
 * Class Lalaz
 *
 * @author  Elasticmind <ola@elasticmind.io>
 * @package elasticmind\lalaz-framework
 * @link	https://elasticmind.io
 */
class Lalaz
{
    public static Lalaz $app;
    public static string $rootDir;

    public Router $router;
    public Database $db;
    public Logger $logger;

    public function __construct(string $rootDir, ?Logger $logger = null)
    {
        Config::load($rootDir . '/.env');

        $this->router = static::initializeRouter();
        $this->db = static::initializeDb();
        $this->logger = $logger ?? static::initializeDefaultLogger();

        self::$rootDir = $rootDir;
        self::$app = $this;
    }

    public function run(): void
    {
        try {
            $this->router->dispatch(
                $_SERVER['REQUEST_METHOD'],
                $_SERVER['REQUEST_URI']
            );
        } catch (Exception $ex) {
            print($ex);
        }
    }

    private static function initializeDefaultLogger(): Logger
    {
        return Logger::create()
            ->writeTo(new LogToConsole());
    }

    private static function initializeRouter(): Router
    {
        return new Router();
    }

    private static function initializeDb(): Database
    {
        return new Database([
            'dsn' => Config::get('DB_DSN'),
            'user' => Config::get('DB_USER'),
            'password' => Config::get('DB_PASSWORD')
        ]);
    }
}
