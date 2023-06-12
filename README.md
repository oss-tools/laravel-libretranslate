# Laravel LibreTranslate

[![Latest Version](https://img.shields.io/github/release/oss-tools/laravel-libretranslate.svg?style=flat-square)](https://github.com/oss-tools/laravel-libretranslate/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/oss-tools/laravel-libretranslate/run-tests.yml?label=tests&branch=master)
![Check & fix styling](https://github.com/oss-tools/laravel-libretranslate/workflows/Check%20&%20fix%20styling/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/oss-tools/laravel-libretranslate.svg?style=flat-square)](https://packagist.org/packages/oss-tools/laravel-libretranslate)

This package adds a client to translate text in Laravel using LibreTranslate.

## What is LibreTranslate?

[LibreTranslate](https://github.com/LibreTranslate/LibreTranslate) is a free and open source translation library.

## Installation

You can install the package via composer:

```bash
composer require oss-tools/laravel-libretranslate
```

### Configuration
To set up the package, you will need to set the below env variables.

```
LIBRETRANSLATE_HOST=https://mylibretranslateserver.com
LIBRETRANSLATE_API_KEY=your-api-key
LIBRETRANSLATE_DEFAULT_SOURCE=en
```
**Note:** The default value for `LIBRETRANSLATE_HOST` is set to [https://translate.argosopentech.com](https://translate.argosopentech.com) however, we recommend setting up your own server or using a host that is suitable for your needs for production.
## Usage

``` php
use OSSTools\LibreTranslate\Client;
use OSSTools\LibreTranslate\Translation\LanguageCodes;

class ExampleController extends Controller
{
    public function translate()
    {
        $client = new Client();
        
        // Returns an instance of \OSSTools\LibreTranslate\Translation\TranslationCollection
        $result = $client->translate('This is some text', LanguageCodes::SPANISH);
        
        // Returns an array of \OSSTools\LibreTranslate\Translation\TranslationItem
        $result = $client->translate('This is some text', LanguageCodes::SPANISH)->getAll();
        
        // Returns a single instance of \OSSTools\LibreTranslate\Translation\TranslationItem
        $result = $client->translate(['This is some text', 'A test'], LanguageCodes::SPANISH)->first();
        
        // Returns a single instance of \OSSTools\LibreTranslate\Translation\TranslationItem
        $result = $client->translate(['This is some text', 'A test'], LanguageCodes::SPANISH)->last();
        
        // Returns a single instance of \OSSTools\LibreTranslate\Translation\TranslationItem
        $result = $client->translate(['This is some text', 'A test'], LanguageCodes::SPANISH)->get('A test');
        
        // Returns "Una prueba"
        $result = $client->translate(['This is some text', 'A test'], LanguageCodes::SPANISH)->last()->getText();
    }
}
```

# Detecting a language from some text
``` php
use OSSTools\LibreTranslate\Client;

class ExampleController extends Controller
{
    public function translate()
    {
        $client = new Client();
        
        // Returns an instance of \OSSTools\LibreTranslate\Translation\TranslationDetectionCollection
        $result = $client->detect('This is some text');
        
        // Returns an array of \OSSTools\LibreTranslate\Translation\TranslationDetectionItem
        $result = $client->detect('This is some text')->getAll();
        
        // Returns a single instance of \OSSTools\LibreTranslate\Translation\TranslationDetectionItem
        $result = $client->translate('This is some text')->first();

        // Returns "en"
        $result = $client->detect('Some text')->first()->getLanguage();
        
        // Returns "es"
        $result = $client->detect('Una prueba')->first()->getLanguage();
    }
}
```

## Testing

``` bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
