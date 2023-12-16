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

    'elasticsearch' => [
        'host' => env('ELASTICSEARCH_HOST'),
        'port' => env('ELASTICSEARCH_PORT'),
        'index' => env('ELASTICSEARCH_INDEX'),
    ],

    'news_providers' => [
        'news_api_org' => [
            'api_key' => env('NEWS_API_ORG_KEY'),
            'page_size' => env('NEWS_API_ORG_PAGE_SIZE'),
        ],
        'new_york_times' => [
            'api_key' => env('NEW_YORK_TIMES_API_KEY'),
            'host' => env('NEW_YORK_TIMES_HOST'),
            'sleep_rate' =>  env('NEW_YORK_TIMES_SLEEP_RATE')
        ],
        'the_guardian' => [
            'api_key' => env('THE_GUARDIAN_API_KEY'),
            'page_size' => env('THE_GUARDIAN_PAGE_SIZE'),
        ]
    ]

];
