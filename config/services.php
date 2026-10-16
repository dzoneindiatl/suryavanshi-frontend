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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI'),
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('FACEBOOK_REDIRECT_URI'),
    ],
    'instagram' => [
        'user_id' => env('INSTAGRAM_USER_ID'),
        'access_token' => env('INSTAGRAM_ACCESS_TOKEN'),
        'graph_api_version' => env('INSTAGRAM_GRAPH_API_VERSION', 'v23.0'),
        'profile_url' => env('INSTAGRAM_PROFILE_URL', 'https://www.instagram.com/'),
    ],
    'paypal' => [
        'client_id' => env('PAYPAL_CLIENT_ID'),
        'client_secret' => env('PAYPAL_CLIENT_SECRET'),
        'base_url' => env('PAYPAL_BASE_URL', 'https://api-m.sandbox.paypal.com'),
        'currency' => env('PAYPAL_CURRENCY', 'USD'),
        'mode' => env('PAYPAL_MODE', 'sandbox'),
    ],
    'ccavenue' => [
        'merchant_id' => env('CCAVENUE_MERCHANT_ID'),
        'access_code' => env('CCAVENUE_ACCESS_CODE'),
        'working_key' => env('CCAVENUE_WORKING_KEY'),
        'gateway_url' => env('CCAVENUE_URL', 'https://secure.ccavenue.com/transaction/transaction.do'),
        'currency' => env('CCAVENUE_CURRENCY', 'INR'),
        'redirect_url' => env('CCAVENUE_REDIRECT_URL'),
        'cancel_url' => env('CCAVENUE_CANCEL_URL'),
    ],

    'restcountries'=> [
        'key'=>'rc_live_828356f106f449379f5d983336facb3b'
    ]

];
