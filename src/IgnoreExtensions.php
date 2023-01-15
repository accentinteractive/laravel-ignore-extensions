<?php

namespace Accentinteractive\LaravelIgnoreExtensions;

class IgnoreExtensions
{

    public function hasExtension(?string $url = null)
    {
        $search = preg_quote(config('laravel-ignore-extensions.extensions_to_be_ignored'), '/');
        $search = str_replace('\|', '|', $search);
        preg_match('/(.*)\.(' . $search . ')$/i', $url, $matches);

        if (empty($matches)) {
            return false;
        }

        return true;
        return true;
    }
}
