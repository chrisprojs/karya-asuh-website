<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

$app->useStoragePath(env('APP_STORAGE', base_path() . '/storage'));

// Prevent caching of the package manifest
$app->singleton(
    Illuminate\Foundation\PackageManifest::class,
    function ($app) {
        return new Illuminate\Foundation\PackageManifest(
            new Illuminate\Filesystem\Filesystem,
            $app->basePath(),
            $app->basePath('vendor/composer/installed.json')
        );
    }
);

return $app;
