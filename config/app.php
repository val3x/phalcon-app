<?php

return new \Phalcon\Config([
    /**
     * When is enabled:
     *     - display errors
     *     - display json responses prettyfied
     *
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
	     * Allow this methods for HTTP requests
	     **/
	    'methods' => [
	    	'GET',
	    	'POST',
	    	'PUT',
	    	'DELETE'
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
	    ]
    ]
]);
