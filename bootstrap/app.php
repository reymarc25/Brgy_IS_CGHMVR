<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

if (getenv('VERCEL')) {
    $storagePath = '/tmp/storage';
    $paths = [
        $storagePath,
        $storagePath.'/app',
        $storagePath.'/framework',
        $storagePath.'/framework/cache',
        $storagePath.'/framework/cache/data',
        $storagePath.'/framework/sessions',
        $storagePath.'/framework/testing',
        $storagePath.'/framework/views',
        $storagePath.'/logs',
    ];

    foreach ($paths as $path) {
        if (! is_dir($path)) {
            @mkdir($path, 0777, true);
        }
    }

    $app->useStoragePath($storagePath);
}

return $app;
