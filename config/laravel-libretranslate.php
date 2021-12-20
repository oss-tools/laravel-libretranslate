<?php

/**
 * Config for the Laravel LibreTranslate package.
 */

return [
    'host' => env('LIBRETRANSLATE_HOST', 'https://translate.api.skitzen.com'),
    'api_key' => env('LIBRETRANSLATE_API_KEY'),
    'default_source' => env('LIBRETRANSLATE_DEFAULT_SOURCE', \OSSTools\LibreTranslate\Translation\LanguageCodes::ENGLISH),
];
