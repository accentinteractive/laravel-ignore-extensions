<?php

namespace Accentinteractive\LaravelIgnoreExtensions\Tests\Feature;

use Accentinteractive\LaravelIgnoreExtensions\IgnoreExtensions;
use Accentinteractive\LaravelIgnoreExtensions\Tests\TestCase;

class IgnoreExtensionsTest extends TestCase
{

    const DOMAIN = 'https://example.com';

    /** @test */
    public function itCanDetectAnExtension()
    {
        config(['laravel-ignore-extensions.extensions_to_be_ignored' => 'jpg']);
        $this->assertTrue((new IgnoreExtensions())->hasExtension(self::DOMAIN . '/image.jpg'));
    }

    /** @test */
    public function itCanDetectMultipleExtensions()
    {
        config(['laravel-ignore-extensions.extensions_to_be_ignored' => 'pdf|jpg|png']);
        $this->assertTrue((new IgnoreExtensions())->hasExtension(self::DOMAIN . '/image.pdf'));
        $this->assertTrue((new IgnoreExtensions())->hasExtension(self::DOMAIN . '/image.jpg'));
        $this->assertTrue((new IgnoreExtensions())->hasExtension(self::DOMAIN . '/image.png'));
    }

    /** @test */
    public function itDoesNotDetectExtensionsThatAreNotSet()
    {
        config(['laravel-ignore-extensions.extensions_to_be_ignored' => 'jpg']);
        $this->assertFalse((new IgnoreExtensions())->hasExtension(self::DOMAIN . '/image.png'));
    }
}
