<?php

namespace OSSTools\LibreTranslate\Test;

use Exception;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Exceptions\Handler;
use Orchestra\Testbench\TestCase as BaseTestCase;
use OSSTools\LibreTranslate\LibreTranslateServiceProvider;
use OSSTools\LibreTranslate\Translation\LanguageCodes;

abstract class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Set up the environment.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        config(['laravel-libretranslate.host' => 'https://libretranslate.de']);
        config(['laravel-libretranslate.api_key' => null]);
        config(['laravel-libretranslate.default_source' => LanguageCodes::ENGLISH]);
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            LibreTranslateServiceProvider::class,
        ];
    }

    protected function disableExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct()
            {
            }

            public function report(Exception $e)
            {
            }

            public function render($request, Exception $exception)
            {
                throw $exception;
            }
        });
    }
}
