<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'firebase' => [
    'api_key' => 'AIzaSyCmW6-mhuYpZ71In_A-z-fwDUGINL7VupY', // Only used for JS integration
    'auth_domain' => 'covtract.firebaseapp.com', // Only used for JS integration
    'database_url' => 'https://covtract-default-rtdb.asia-southeast1.firebasedatabase.app/',
    'storage_bucket' => 'covtract.appspot.com', // Only used for JS integration,
    'messagingSenderId'=> "432111250138",
    'appId'=> "1:432111250138:web:88e7e5aacfd69bdeccd3e3",
    'measurementId'=> "G-X1LL38CW54"
],

];
