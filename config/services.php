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

    
    'msg91' => [
        'auth_key' => env('MSG91_AUTH_KEY'),
        'token_auth' => env('MSG91_AUTH_TOKEN'),
        'widget_id' => env('MSG91_WIDGET_ID'),
        'ca_bundle' => env('MSG91_CA_BUNDLE'),
        'template_id' => env('MSG91_TEMPLATE_ID'),
        'sender_id' => env('MSG91_SENDER_ID'),
    ],

];
