# Laravel Article Manager Package

This package provides you with a simple tool to set up a new package and it will let you focus on the development of the package instead of the boilerplate.

## Installation

Via Composer

```bash
$ composer require piripasa/article-manager
```

If you do not run Laravel 5.5 (or higher), then add the service provider in `config/app.php`:

```php
Piripasa\ArticleManager\ArticleManagerServiceProvider::class,
```

If you do run the package on Laravel 5.5+, [package auto-discovery](https://medium.com/@taylorotwell/package-auto-discovery-in-laravel-5-5-ea9e3ab20518) takes care of the magic of adding the service provider.

Afterwards, publish the migrations and views so you can customize as needed.

```bash
$ php artisan vendor:publish --provider="Piripasa\ArticleManager\ArticleManagerServiceProvider"
```

### Tests
Currently, no tests have been written but that should be very soon.
