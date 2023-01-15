<?php

namespace Accentinteractive\LaravelIgnoreExtensions\Tests;

use Accentinteractive\LaravelIgnoreExtensions\LaravelIgnoreExtensionsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{

    protected function getPackageProviders($app)
    {
        return [
            LaravelIgnoreExtensionsServiceProvider::class,
        ];
    }

    public function setUp(): void
    {
        parent::setUp();
    }
}


