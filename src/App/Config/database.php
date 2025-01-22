<?php

return [
    // Define the provider for the database
    // CAUTION: For now Lalaz only support MySQL and MariaDB
    'provider' => env('DB_PROVIDER', 'mysql'),

    // Define the database DSN
    'dns' => env('DB_DSN', 'mysql:host=127.0.0.1;port=3306;dbname=lalaz'),

    // Define the database user
    'user' => env('DB_USER', 'root'),

    // Define the database password
    'password' => env('DB_PASSWORD', 'root'),

    // Define if the database queries should be logged
    'log' => env('DB_LOG', true)
];
