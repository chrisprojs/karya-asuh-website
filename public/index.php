<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Ensure the cache and log directories are set to writable temporary directories
$cachePath = '/tmp/cache';
$logPath = '/tmp/laravel.log';

// Ensure the cache directory exists and is writable
if (!is_dir($cachePath)) {
    mkdir($cachePath, 0755, true);  // Create cache directory with proper permissions
}

// Check if the cache directory is writable
if (!is_writable($cachePath)) {
    throw new Exception("The directory {$cachePath} is not writable.");
}

// Change the Laravel log path to the temporary directory
putenv('LOG_PATH=' . $logPath);

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
