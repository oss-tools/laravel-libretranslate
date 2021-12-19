# Laravel LibreTranslate

[![Latest Version on Packagist](https://img.shields.io/packagist/v/oss-tools/laravel-libretranslate.svg?style=flat-square)](https://packagist.org/packages/oss-tools/laravel-libretranslate)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/oss-tools/laravel-libretranslate/run-tests?label=tests)
![Check & fix styling](https://github.com/oss-tools/laravel-libretranslate/workflows/Check%20&%20fix%20styling/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/oss-tools/laravel-libretranslate.svg?style=flat-square)](https://packagist.org/packages/oss-tools/laravel-libretranslate)

**Note:** This package is still in active development so breaking changes may be applied before v1 is released. Please proceed with caution.

This package adds a client to translate text in Laravel using LibreTranslate.

## What is LibreTranslate?

[LibreTranslate](https://github.com/LibreTranslate/LibreTranslate) is a free and open source translation library

## Installation

You can install the package via composer:

```bash
composer require oss-tools/laravel-libretranslate
```

## Usage

``` php
use OSSTools\LibreTranslate\Client;
use OSSTools\LibreTranslate\Translation\LanguageCodes;

class ExampleController extends Controller
{
    public function translate()
    {
        $client = new Client();
        
        // Returns an array of \OSSTools\LibreTranslate\Translation\Translation
        $result = $client->translate('This is some text', LanguageCodes::SPANISH)->getAll();
        
        // Returns a single record of \OSSTools\LibreTranslate\Translation\Translation
        $result = $client->translate(['This is some text', 'A test'], LanguageCodes::SPANISH)->first();
        
        // Returns a single record of \OSSTools\LibreTranslate\Translation\Translation
        $result = $client->translate(['This is some text', 'A test'], LanguageCodes::SPANISH)->last();
        
        // Returns a single record of \OSSTools\LibreTranslate\Translation\Translation
        $result = $client->translate(['This is some text', 'A test'], LanguageCodes::SPANISH)->get('A test');
        
        // Returns "Una prueba"
        $result = $client->translate(['This is some text', 'A test'], LanguageCodes::SPANISH)->last()->getText();
    }
}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
