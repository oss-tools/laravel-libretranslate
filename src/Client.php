<?php

namespace OSSTools\LibreTranslate;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Promise;
use OSSTools\LibreTranslate\Exceptions\InvalidPayloadException;
use OSSTools\LibreTranslate\Exceptions\InvalidTargetException;
use OSSTools\LibreTranslate\Translation\LanguageCodes;
use OSSTools\LibreTranslate\Translation\Translation;
use OSSTools\LibreTranslate\Translation\Translations;

class Client
{
    /**
     * @var GuzzleClient
     */
    protected $client;

    /**
     * @var Translations
     */
    protected $translations;

    /**
     * Create a new Package Instance.
     */
    public function __construct()
    {
        $this->client = new GuzzleClient([
            'base_uri' => config('laravel-libretranslate.libretranslate_host'),
        ]);
    }

    /**
     * @param $keys
     * @param $target
     * @param null $source
     * @return $this
     * @throws InvalidPayloadException
     * @throws InvalidTargetException
     * @throws \Throwable
     */
    public function translate($keys, $target, $source = null): self
    {
        if (!is_string($keys)) {
            $keys = [$keys];
        }

        if (!is_array($keys)) {
            throw new InvalidPayloadException();
        }

        if (!in_array(strtolower($target), static::getSupportedTargets(), true)) {
            throw new InvalidTargetException();
        }

        $requests = [];

        foreach ($keys as $key) {
            $requests[$key] = $this->client->postAsync('translate?apiKey=' . config('laravel-lbretranslate.laravel-lbretranslate_api_key'), [
                'form_params' => [
                    'q' => $key,
                    'source' => $source,
                    'target' => $target,
                    'format' => 'text',
                ],
            ]);
        }

        $responses = Promise\Utils::unwrap($requests);

        $translations = [];
        foreach ($responses as $key =>  $response) {
            $translatedText = json_decode($response['value']->getBody(), true)['translatedText'];
            $translations[] = new Translation($key, $translatedText);
        }

        $this->translations = new Translations($translations);

        return $this;
    }

    /**
     * @return array
     */
    protected static function getSupportedTargets(): array
    {
        return [
            LanguageCodes::ENGLISH,
            LanguageCodes::SPANISH,
            LanguageCodes::CHINESE,
            LanguageCodes::ARABIC,
            LanguageCodes::DUTCH,
            LanguageCodes::FINNISH,
            LanguageCodes::FRENCH,
            LanguageCodes::GERMAN,
            LanguageCodes::HINDI,
            LanguageCodes::HUNGARIAN,
            LanguageCodes::INDONESIAN,
            LanguageCodes::IRISH,
            LanguageCodes::ITALIAN,
            LanguageCodes::JAPANESE,
            LanguageCodes::KOREAN,
            LanguageCodes::POLISH,
            LanguageCodes::PORTUGUESE,
            LanguageCodes::RUSSIAN,
            LanguageCodes::SWEDISH,
            LanguageCodes::TURKISH,
            LanguageCodes::UKRANIAN,
            LanguageCodes::VIETNAMESE,
        ];
    }
}
