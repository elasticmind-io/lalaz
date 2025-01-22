<?php

return [
    // Define the provider to store php session.
    // CAUTION: For now Lalaz online support memory storage for session
    'provider' => env('SESSION_PROVIDER', 'memory'),

    // Define the session lifetime in miliseconds
    'lifetime' => env('SESSION_LIFETIME', 1800)
];
