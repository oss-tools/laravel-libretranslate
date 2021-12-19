<?php

namespace OSSTools\Package\Test;

use OSSTools\Package\PackageClass;
use PHPUnit\Framework\TestCase;

class PackageTest extends TestCase
{
    /** @test */
    public function returns_hello_world_string()
    {
        $package = new PackageClass();

        $this->assertEquals('Hello World', $package->helloWorld());
    }
}
