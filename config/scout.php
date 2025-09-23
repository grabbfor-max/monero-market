<?php

return [
    'opensearch' => [
        "access_key" => env('OPENSEARCH_ACCESS_KEY', 'your-opensearch-access-key'),
        "secret" => env('OPENSEARCH_SECRET', 'your-opensearch-secret'),
        "host" => env('OPENSEARCH_HOST', '127.0.0.1:9200'),
        "options" => [
            "debug" => env('OPENSEARCH_DEBUG', false),
        ],
    ],
];
