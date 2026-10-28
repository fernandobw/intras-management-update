<?php

return [
    'secret' => env('CAPTCHA_SECRET', env('NOCAPTCHA_SECRET', '')),
    'sitekey' => env('CAPTCHA_SITEKEY', env('NOCAPTCHA_SITEKEY', '')),
    'options' => [
        'timeout' => 30,
    ],
];

