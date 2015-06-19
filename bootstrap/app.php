<?php

namespace App;

use Exception;

use Phalcon\Di;
use Phalcon\Loader;
use Phalcon\Http\Response;
use Phalcon\Mvc\Application as PhalconApplication;
use Phalcon\Mvc\Dispatcher;
// use Phalcon\Mvc\Router;
use Phalcon\Mvc\View;

use Phalcon\Events\Manager;

class Application extends PhalconApplication {
	public function __construct()
	{
		$this->services();
		$this->autoloader();
		$this->config();
	}


	public function dispatch()
	{
		echo $this->handle()->getContent();
	}

	private function services()
	{
		$di = new Di();

		$di->set('view', function () {
			$view = new View();
			// $view->setViewsDir('../apps/views/');

			return $view;
		});

		$di->set('dispatcher', function(){
		    $eventsManager = new Manager();

		    $eventsManager->attach('dispatch:afterExecuteRoute', function($event, $dispatcher) {
		        $returned = $event->getSource()->getReturnedValue();

		        $response = new Response();
	        	$response->setContent($returned);
	        	// $response->setHeader('Content-Type', 'application/json');
	        	// $response->setJsonContent($returned);

		        $event->getSource()->setReturnedValue($response);
		    });

			$dispatcher = new Dispatcher();
			$dispatcher->setDefaultNamespace('App\\Controllers\\');
		    $dispatcher->setEventsManager($eventsManager);

			return $dispatcher;
		});

		$di->set('response', function(){
			var_dump('in response');

			$response = new Response();

			return $response;
		});

		///////!!!!!!!!!!!!!!!!
		$di->set('modelsMetadata', function(){
			return new \Phalcon\Mvc\Model\Metadata\Memory();
		});

		$di->set('modelsManager', function(){
			return new \Phalcon\Mvc\Model\Manager();
		});

		$this->setDi($di);
	}

	private function autoloader()
	{
		$loader = new Loader();

		$loader->registerNamespaces(array(
			'App\\Controllers' => '../app/Controllers/',
			'App\\Models' => '../app/Models/'
		));

		$loader->register();
	}

	private function config()
	{
		$base_path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR;

		$files = [
			'app',
			'database',
			'routes',
		];

		foreach ($files as $file) {
			$$file = require $base_path . $file . '.php';
		}

		if ( ! isset($database)) {
			throw new Exception('Database file is not found in configuration.');
		}

		$di = $this->getDi();

		foreach ($database as $name => $db_config) {
			$name = 'db.' . $name;

			$di->set($name, function() use ($db_config) {
				$adapter = $db_config->adapter;

				return new $adapter($db_config->toArray());
			});
		}

		$di->set('config', function () use ($app) {
			return $app;
		});

		$di->set('router', function() use ($routes) {
			return $routes;
		});
	}
}
