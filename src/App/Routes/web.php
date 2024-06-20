<?php declare(strict_types=1);

use Lalaz\Routing\Route;

use App\Middlewares\LogMiddleware;

Route::get('/', 'HomeController@index', [
    LogMiddleware::class
]);
