<?php

namespace OSSTools\LibreTranslate\Test;

use OSSTools\LibreTranslate\Client;
use PHPUnit\Framework\TestCase;

class LibreTranslateTest extends TestCase
{
    public function test_can_instantiate_libretranslate_client()
    {
        $instance = new Client();

        $this->assertTrue($instance instanceof Client);
    }
}
