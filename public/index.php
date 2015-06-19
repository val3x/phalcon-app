<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels nice to relax.
|
*/
require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/
require_once __DIR__.'/../bootstrap/app.php';

try {
	$app = new App\Application();
	$app->dispatch();
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
