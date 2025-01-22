<?php

use Lalaz\View\Providers\TwigTemplateEngine;

return [
    // Defines the template engine for the app
    // You could change the template engine implement the TemplateProvider interface
    'provider' => env('TEMPLATE_PROVIDER', TwigTemplateEngine::class),

    // Define the views path of the app
    'path' => env('VIEWS_PATH', '/Views')
];
