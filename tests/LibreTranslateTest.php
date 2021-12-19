<?php

namespace OSSTools\LibreTranslate\Test;

use OSSTools\LibreTranslate\Client;
use OSSTools\LibreTranslate\Test\TestCase as OrchestraTestCase;
use OSSTools\LibreTranslate\Translation\LanguageCodes;


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
}
