<?php

namespace OSSTools\LibreTranslate\Test;

use OSSTools\LibreTranslate\Client;
use OSSTools\LibreTranslate\Test\TestCase as OrchestraTestCase;
use OSSTools\LibreTranslate\Translation\LanguageCodes;
use OSSTools\LibreTranslate\Translation\TranslationDetectionItem;

class LibreTranslateTest extends OrchestraTestCase
{
    public function test_can_instantiate_libretranslate_client()
    {
        $instance = new Client();

        $this->assertTrue($instance instanceof Client);
    }

    public function test_can_get_translations()
    {
        $instance = new Client();

        $translationPayload = 'This is some text';

        $translation = $instance->translate($translationPayload, LanguageCodes::SPANISH, LanguageCodes::ENGLISH)
            ->get($translationPayload);

        $this->assertSame($translation->getLocale(), LanguageCodes::SPANISH);
        $this->assertNotEmpty($translation->getText());
        $this->assertNotSame($translation->getText(), $translationPayload);
    }

    public function test_can_get_translations_using_first_and_last()
    {
        $instance = new Client();

        $translationPayload = ['This is some text', 'A test'];

        $translation1 = $instance->translate($translationPayload, LanguageCodes::SPANISH, LanguageCodes::ENGLISH)
            ->first();

        $this->assertSame($translation1->getLocale(), LanguageCodes::SPANISH);
        $this->assertNotEmpty($translation1->getText());
        $this->assertNotSame($translation1->getText(), $translationPayload[0]);

        $translation2 = $instance->translate($translationPayload, LanguageCodes::SPANISH, LanguageCodes::ENGLISH)
            ->last();

        $this->assertSame($translation2->getLocale(), LanguageCodes::SPANISH);
        $this->assertNotEmpty($translation2->getText());
        $this->assertNotSame($translation2->getText(), $translationPayload[1]);
    }

    public function test_can_convert_translations_to_an_array()
    {
        $instance = new Client();

        $translationPayload = ['This is some text', 'A test'];

        $translation = $instance->translate($translationPayload, LanguageCodes::SPANISH, LanguageCodes::ENGLISH)
            ->first();

        $this->assertIsArray($translation->toArray());
        $this->assertNotEmpty($translation->toArray()['text']);
        $this->assertSame($translation->toArray()['key'], $translationPayload[0]);
        $this->assertNotSame($translation->toArray()['text'], $translationPayload[0]);
    }

    public function test_can_detect_languages()
    {
        $instance = new Client();

        $enPayload = 'Some text';
        $esPayload = 'Una prueba';

        $detection1 = $instance->detect($enPayload)->first();
        $this->assertInstanceOf(TranslationDetectionItem::class, $detection1);
        $this->assertSame($detection1->getLanguage(), LanguageCodes::ENGLISH);

        $detection2 = $instance->detect($esPayload)->first();
        $this->assertInstanceOf(TranslationDetectionItem::class, $detection2);
        $this->assertSame($detection2->getLanguage(), LanguageCodes::SPANISH);
    }

    public function test_can_translate_text_with_attributes()
    {
        $instance = new Client();

        $payload = 'Some text with an :attribute or :two';

        $translation = $instance->translate($payload, LanguageCodes::SPANISH)->first();

        $this->assertSame($translation->getLocale(), LanguageCodes::SPANISH);
        $this->assertStringContainsString(':attribute', $translation->getText());
        $this->assertStringContainsString(':two', $translation->getText());
    }
}
