<?php

return [
    // Define the provider for the database
    // CAUTION: For now Lalaz only support SQLite, MySQL or None (DbLess)
    'provider' => env('DB_PROVIDER', 'sqlite'),

    'mysql' => [
        // Define the database host
        'host' => env('DB_HOST', '127.0.0.1'),

        // Define the database port
        'port' => env('DB_PORT', '3306'),

        // Define the database name
        'dbname' => env('DB_NAME', 'lalaz'),

        // Define the database user
        'user' => env('DB_USER', 'root'),

        // Define the database password
        'password' => env('DB_PASSWORD', 'root')
    ],

    'sqlite' => [
        'path' => env('SQLITE_PATH', './database.sqlite'),
    ],

    // Define if the database queries should be logged
    'log' => env('DB_LOG', true)
];
