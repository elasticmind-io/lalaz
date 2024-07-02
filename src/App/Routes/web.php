<?php declare(strict_types=1);

use Lalaz\Routing\Route;

use App\Middlewares\AdminMiddleware;

Route::get('/', 'HomeController@index', [
    LogMiddleware::class
]);


// Admin routes
Route::get('/admin', 'Admin\LoginController@index');
Route::post('/admin/login', 'Admin\LoginController@create');
Route::get('/admin/logout', 'Admin\LoginController@destroy');

Route::get('/admin/dashboard', 'Admin\DashboardController@index', [AdminMiddleware::class]);
