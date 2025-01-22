<?php declare(strict_types=1);

use Lalaz\Routing\Route;

/**
 * Defines the routes of the app
 *
 * This function allows you to configure all the routes
 * that will be used by the application.
 *
 */
function onRouterInitialized()
{
    // Public Routes
    Route::get('/', 'HomeController@index');
}
