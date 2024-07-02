<?php declare(strict_types=1);

namespace App\Middlewares;

use Lalaz\Http\Middleware;
use Lalaz\Http\Request;
use Lalaz\Http\Response;
use Lalaz\Logging\Log;

use App\Models\User;

class AdminMiddleware extends Middleware
{
    public function handle(Request $req, Response $res): void
    {
        if (!static::isAuthenticated($req)) {
            $res->redirect('/admin');
        }

        $user = User::findById($req->session('user'));
        $user->hide('password');

        $req->isAuthenticated = $req->session('isAuthenticated');
        $req->user = $user;

        static::shareViewBag($req, $res);
    }

    private static function isAuthenticated(Request $req): bool
    {
        return $req->session('isAuthenticated') !== 1
            && !empty($req->session('user'));
    }

    private static function shareViewBag(Request $req, Response $res): void
    {
        $res->addViewBag('user', $req->user);
    }
}
