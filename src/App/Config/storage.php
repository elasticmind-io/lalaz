<?php

return [
    // Define the provider for app storage and uploads
    // CAUTION: For now Lalaz only support local (disk) provider
    'provider' => env('STORAGE_PROVIDER', 'local'),

    // Define the path that files will be saved
    'path' => env('STORAGE_PATH', './uploads'),

    // Define the public url for providing a way for the users to see it
    'publicUrl' => env('STORAGE_PUBLIC_URL', '/uploads')
];
