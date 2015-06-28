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

use App\Exception\ApiException;

class Application extends PhalconApplication {
    public function __construct()
    {
        $this->services();
        $this->autoloader();
        $this->config();
    }


    public function run()
    {
        echo $this->handle()->getContent();
    }

    private function services()
    {
        $di = new Di();


        // Store the api messages
        $di->set('messages', function($input = null) {
            return $input;
        });

        $di->set('view', function () {
            $view = new View();
            // $view->setViewsDir('../apps/views/');

            return $view;
        });

        $di->set('dispatcher', function() use ($di) {
            $eventsManager = new Manager();

            $eventsManager->attach('dispatch:afterExecuteRoute', function($event, $dispatcher) use ($di) {
                // dd($event->getSource()->getActiveController()->getMessages());
                // dd(get_class_methods($event->getSource()->getActiveController()));
                // dd(get_class_methods($event->getSource()));
                // dd($event->getData());
                // dd($event->getSource());

                $source = $event->getSource();
                $returned = $source->getReturnedValue();

                if (is_object($returned)) {
                    if ( ! method_exists($returned, 'toArray')) {
                        throw new ApiException('The returned value can not be parsed, try it manual.');
                    }

                    $returned = $returned->toArray();
                }

                $configs = $di->get('config');

                $response = new Response();

                if ($configs->api->cors->enabled) {
                    $response->setHeader('Access-Control-Allow-Origin', $configs->api->cors->hosts);
                }

                foreach ($configs->api->headers as $name => $value) {
                    $response->setHeader($name, $value);
                }

                $json_options = 0;

                if ($configs->debug) {
                    $json_options = JSON_PRETTY_PRINT;
                }

                foreach ($configs->json->options as $option) {
                    $json_options |= $option;
                }

                $activeController = $source->getActiveController();

                $status = $activeController->getStatus();
                $errors = $activeController->getErrors();
                $messages = $activeController->getMessages();
                $status_code = $activeController->getCode();

                $data = [
                    'status' => $status,
                    'status_code' => $status_code,
                    'errors' => $errors,
                    'messages' => $messages,
                    'data' => $returned
                ];

                $response->setJsonContent($data, $json_options);

                $event->getSource()->setReturnedValue($response);
            });

            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('App\\Controllers\\');
            $dispatcher->setEventsManager($eventsManager);

            return $dispatcher;
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
        // $loader = new Loader();

        // $loader->registerNamespaces(array(
        //     'App\\Controllers' => '../app/Controllers/',
        //     'App\\Models' => '../app/Models/'
        // ));

        // $loader->register();
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
