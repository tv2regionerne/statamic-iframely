<?php
return [
    'api_key' => env('IFRAMELY_API_KEY'),
    'cache_enabled' => env('IFRAMELY_CACHE_ENABLED', true),
    'cache_for' => env('IFRAMELY_CACHE_FOR', '1 hour'),
];
