<?php declare(strict_types=1);

namespace App;

use Lalaz\Lalaz;
use Lalaz\Logging\Logger;
use Lalaz\Logging\LogToConsole;

class App
{
    public static function start(): void
    {
        $logger = new Logger();
        $logger->writeTo(new LogToConsole());


        $app = new Lalaz(__DIR__, $logger);
        require 'Routes/web.php';
        $app->run();
    }
}
