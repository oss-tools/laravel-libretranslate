<?php

namespace OSSTools\LibreTranslate\Test;

use PHPUnit\Framework\TestCase;
use OSSTools\LibreTranslate\Client;

class LibreTranslateTest extends TestCase
{
    public function test_can_instantiate_libretranslate_client()
    {
        $instance = new Client();

        $this->assertTrue($instance instanceof Client);
    }
}
