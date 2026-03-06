<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

if (getenv('VERCEL')) {
    $cacheRoot = '/tmp/bootstrap/cache';

    if (! is_dir($cacheRoot)) {
        @mkdir($cacheRoot, 0777, true);
    }

    putenv("APP_SERVICES_CACHE={$cacheRoot}/services.php");
    putenv("APP_PACKAGES_CACHE={$cacheRoot}/packages.php");
    putenv("APP_CONFIG_CACHE={$cacheRoot}/config.php");
    putenv("APP_ROUTES_CACHE={$cacheRoot}/routes-v7.php");
    putenv("APP_EVENTS_CACHE={$cacheRoot}/events.php");
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
