<?php

return new \Phalcon\Config([
    /**
     * When is enabled:
     *     - display errors
     *     - display json responses prettyfied
     **/
    'debug' => true,


    /**
     * General API's configurations
     **/
    'api' => [
        /**
         * Enable or disable Cross-site HTTP requests
         **/
        'cors' => [
            'enabled' => true,
            'hosts' => '*'
        ],

        /**
         * API's headers
         *
         * By default the application add:
         *     - Content-Type: application/json
         *     - Access-Control-Allow-Origin: * (if cors is enabled).
         *     - Access-Control-Allow-Methods: GET, POST, PUT, DELETE
         *
         * If you want to overwrite any header, this is your section.
         *
         **/
        'headers' => [
            'Content-Type' => 'application/json',
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE'
        ],
    ],

    /**
     * JSON response configurations
     **/
    'json' => [
        /**
         * JSON encode options.
         * 
         * JSON_PRETTY_PRINT option is pre-seted if debig is enabled.
         * 
         * More information: http://php.net/manual/en/json.constants.php
         **/
        'options' => [
            JSON_NUMERIC_CHECK
        ],
        'depth' => 512
    ]
]);
