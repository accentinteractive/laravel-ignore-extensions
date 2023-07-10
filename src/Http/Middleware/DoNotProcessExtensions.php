<?php

namespace Accentinteractive\LaravelIgnoreExtensions\Http\Middleware;

use Accentinteractive\LaravelIgnoreExtensions\IgnoreExtensions;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DoNotProcessExtensions
{

    /**
     * Throw 404 if we are trying to process an url with an extension like .jpg
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $pathinfo = pathinfo(request()->url());

        if ((new IgnoreExtensions())->hasExtension(Arr::get($pathinfo, 'extension'))) {
            abort(404);
        }

        return $next($request);
    }
}
