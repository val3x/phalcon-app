<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader for composer.
|--------------------------------------------------------------------------
|
*/
require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Framework core.
|--------------------------------------------------------------------------
|
*/
require_once __DIR__.'/../bootstrap/app.php';

try {
    $app = new App\Application();
    $app->run();
} catch(Exception $e) {
    if ($app->getDi()->get('config')->debug === true) {
        echo '<pre>';
        echo 'Exception: ' . $e->getMessage();
        echo '<br><br>';
        echo 'File: ' . $e->getFile() . ' at line: ' . $e->getLine();
        echo '<br><br>';
        print_r($e->getTraceAsString());
        echo '</pre>';
    } else {
        echo 'Page Not Found.';
    }
}

function dd($var = null) {
    $backtrace = debug_backtrace();
    $firstTrace = current($backtrace);

    echo '<pre>';
    echo 'File: ' . $firstTrace['file'] . ', line: ' . $firstTrace['line'];
    var_dump($var);
    echo '</pre>';
    exit();
}
