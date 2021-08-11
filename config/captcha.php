<?php

return [
    'secret' => env('NOCAPTCHA_SECRET'),
    'sitekey' => env('NOCAPTCHA_SITEKEY'),
    'version' => 'v2',
    'lang' => 'jp',
    'options' => [
        'timeout' => 30,
    ],
];
