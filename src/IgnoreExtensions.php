<?php

namespace Accentinteractive\LaravelIgnoreExtensions;

class IgnoreExtensions
{

    public function hasExtension(?string $extension = null)
    {
        if (empty($extension)) {
            return false;
        }

        $search = preg_quote(config('laravel-ignore-extensions.extensions_not_to_process'), '/');
        $search = str_replace('\|', '|', $search);
        preg_match('/(' . $search . ')/i', $extension, $matches);

        if (empty($matches)) {
            return false;
        }

        return true;
    }
}
