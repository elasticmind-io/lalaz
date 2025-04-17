<?php

use Lalaz\View\Providers\TwigTemplateEngine;

return [
    // Defines the template engine for the app
    // You could change the template engine implement the TemplateProvider interface
    'provider' => env('TEMPLATE_PROVIDER', TwigTemplateEngine::class),

    // Define the views path of the app
    'path' => env('VIEWS_PATH', '/Views'),

    /**
     * PHP files that receive the Twig Environment instance and allow the developer
     * to extend the templating system by registering custom functions, filters,
     * or global variables.
     *
     * Each file must return a callable in the following format:
     * fn(Twig\Environment $twig): void
     *
     * Example:
     * return function (\Twig\Environment $twig) {
     *     $twig->addFunction(new \Twig\TwigFunction('app_name', fn() => 'My App'));
     *     $twig->addGlobal('now', date('Y-m-d H:i:s'));
     * };
     */
    'extensions' => env('VIEW_EXTENSIONS', [
        //'./src/App/Support/Extensions/views.php'
    ])
];
