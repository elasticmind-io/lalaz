<?php

// Define Lalaz vars
const LALAZ_VERSION = '1.0.0';

// Define the app name
const APP_NAME = 'Lalaz Framework v1.0';

// Define the paths of the app
const APP_ROOT_PATH  = __DIR__ . '/..';
const APP_CONFIG_PATH = APP_ROOT_PATH . '/Config';
const APP_CONTROLLERS_PATH = APP_ROOT_PATH . '/Controllers';
const APP_VIEWS_PATH = APP_ROOT_PATH . '/Views';

// Define the template engine
const APP_TEMPLATE_ENGINE = 'twig';
const APP_VIEW_EXT = '.twig';

// Define the controllers lookup
const APP_CONTROLLERS_NAMESPACES = [
    'base' => 'App\\Controllers'
];