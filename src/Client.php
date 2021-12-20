<?php

namespace OSSTools\LibreTranslate;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Promise;
use OSSTools\LibreTranslate\Exceptions\InvalidPayloadException;
use OSSTools\LibreTranslate\Exceptions\InvalidTargetException;
use OSSTools\LibreTranslate\Translation\LanguageCodes;
use OSSTools\LibreTranslate\Translation\TranslationDetectionCollection;
use OSSTools\LibreTranslate\Translation\TranslationDetectionItem;
use OSSTools\LibreTranslate\Translation\TranslationItem;
use OSSTools\LibreTranslate\Translation\TranslationCollection;

class Client
{
    /**
     * @var GuzzleClient
     */
    protected $client;

    /**
     * @var TranslationCollection
     */
    protected $translations;

    /**
     * Create a new Package Instance.
     */
    public function __construct()
    {
        $this->client = new GuzzleClient([
            'base_uri' => config('laravel-libretranslate.host'),
        ]);
    }

    /**
     * @param $keys
     * @param $target
     * @param null $source
     * @return TranslationCollection
     * @throws InvalidPayloadException
     * @throws InvalidTargetException
     * @throws \Throwable
     */
    public function translate($keys, $target, $source = null): TranslationCollection
    {
        if (is_string($keys)) {
            $keys = [$keys];
        }

        if (! is_array($keys)) {
            throw new InvalidPayloadException();
        }

        if (! in_array(strtolower($target), static::getSupportedTargets(), true)) {
            throw new InvalidTargetException();
        }

        if (! $source) {
            $source = config('laravel-libretranslate.default_source');
        }

        $requests = [];

        foreach ($keys as $key) {
            $requests[$key] = $this->client->postAsync('/translate?apiKey=' . config('laravel-libretranslate.api_key'), [
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
        foreach ($responses as $key => $response) {
            $translatedText = json_decode($response->getBody(), true)['translatedText'];
            $translations[$key] = new TranslationItem($key, $translatedText, $target);
        }

        return new TranslationCollection($translations);
    }

    /**
     * @param string $key
     * @return TranslationDetectionCollection|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function detect(string $key): ?TranslationDetectionCollection
    {
        $response = $this->client->post('/detect', [
            'form_params' => [
                'q' => $key,
            ],
        ])->getBody();

        $results = json_decode($response, true);

        $detectionArray = array_map(static function (array $detection) {
            return new TranslationDetectionItem($detection['confidence'], $detection['language']);
        }, $results);

        return new TranslationDetectionCollection($detectionArray);
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
