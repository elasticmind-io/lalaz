<?php declare(strict_types=1);

namespace App;

use Lalaz\IAppRoutes;
use Lalaz\Server;

use App\Controllers\ContactController;

class Routes implements IAppRoutes
{
    public static function connect(Server $server): void {
        self::routes($server);
        self::controllers($server);
    }

    private static function routes(Server $server): void {
        $server->get('/', 'HomeController@index');
    }

    private static function controllers(Server $server): void {
    }
}