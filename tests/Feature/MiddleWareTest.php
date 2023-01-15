<?php

namespace Accentinteractive\LaravelIgnoreExtensions\Tests\Feature;

use Accentinteractive\LaravelIgnoreExtensions\Http\Middleware\DoNotProcessExtensions;
use Accentinteractive\LaravelIgnoreExtensions\Tests\TestCase;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MiddleWareTest extends TestCase
{

    const DOMAIN = 'https://test.domain.com';

    /** @test */
    public function itAbortsRequestWithExtension()
    {
        config(['laravel-ignore-extensions.extensions_to_be_ignored' => 'jpg']);
        $this->get(self::DOMAIN . '/image.jpg');
        $request = new Request();

        $this->expectException(NotFoundHttpException::class);

        $middleware = new DoNotProcessExtensions();
        $middleware->handle($request, function ($request) {
        });
    }

    /** @test */
    public function itDoesNotAbortsRequestWithOtherExtension()
    {
        config(['laravel-ignore-extensions.extensions_to_be_ignored' => 'jpg']);
        $this->get(self::DOMAIN . '/file.pdf');
        $request = new Request();

        $middleware = new DoNotProcessExtensions();
        $middleware->handle($request, function ($request) use ($middleware) {
            $this->assertSame(DoNotProcessExtensions::class, get_class($middleware));
        });
    }

    /** @test */
    public function itDoesNotProcessUrlsWithoutExtension()
    {
        $this->get(self::DOMAIN . '/file');
        $request = new Request();

        $middleware = new DoNotProcessExtensions();
        $middleware->handle($request, function ($request) use ($middleware) {
            $this->assertSame(DoNotProcessExtensions::class, get_class($middleware));
        });
    }

}
