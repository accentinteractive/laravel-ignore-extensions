# Return 404 on all URLs that have certain extensions

[![Latest Version on Packagist](https://img.shields.io/packagist/v/accentinteractive/laravel-ignore-extensions.svg?style=flat-square)](https://packagist.org/packages/accentinteractive/laravel-ignore-extensions)
[![Total Downloads](https://img.shields.io/packagist/dt/accentinteractive/laravel-ignore-extensions.svg?style=flat-square)](https://packagist.org/packages/accentinteractive/laravel-ignore-extensions)
![GitHub Actions](https://github.com/accentinteractive/laravel-ignore-extensions/actions/workflows/main.yml/badge.svg)

If your application has a fallback route like `Route::get({slug})`, call to non-existent assets are processed by Laravel - causing strain on your server. If a lot of assets are not presenent (like on a staging server) this can even bring your application to a grinding halt.

This package contains middleware that aborts the request if it contains certain extensions, that you set in your .env file.

## Installation

Step 1: Install the package via composer:

```bash
composer require accentinteractive/laravel-ignore-extensions
```

Step 2: Make sure to register the Middleware. 

To use it on all requests, add it as the first option to the `web` section under `$middlewareGroups` in file app/Http/Kernel.php.
```php
protected $middlewareGroups = [
    'web' => [
        Accentinteractive\LaravelIgnoreExtensions\Http\Middleware\DoNotProcessExtensions::class,
    ],
];
```

To use it on specific requests, add it to any group or to the `protected $middleware` property in file app/Http/Kernel.php.

```php
protected $middleware = [
        Accentinteractive\LaravelIgnoreExtensions\Http\Middleware\DoNotProcessExtensions::class,
    ];
```


Step 3: Optionally publish the config file with:

```
php artisan vendor:publish --provider="Accentinteractive\LaravelIgnoreExtensions\LaravelIgnoreExtensionsServiceProvider" --tag="config"
```

## Usage

The package uses auto discover. The package uses a middleware class that does the checking and aborting.

## Config settings

### Setting extensions that should return a 404

You can set the extensions to check for in the published config file, or by setting this values in .env. It defaults to 'jpg|gif|png|jpeg|txt|html|pdf|css|js'

```apacheconf
EXTENSIONS_NOT_TO_PROCESS='jpg|gif|png|jpeg|txt|html|pdf|css|js
```

### Testing

```bash
vendor/bin/phpunit tests
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email joost@accentinteractive.nl instead of using the issue tracker.

## Credits

-   [Joost van Veen](https://github.com/accentinteractive)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
