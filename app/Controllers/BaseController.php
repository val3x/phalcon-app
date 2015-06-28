<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

abstract class BaseController extends Controller {
    /**
     * Store API's messages.
     *
     * @var array $messages
     **/
    private $messages = [];

    /**
     * Store API's errors.
     *
     * @var array $errors
     **/
    private $errors = [];

    /**
     * Set a new message for the API.
     *
     * @param string $message
     *
     * @return void
     ***/
    protected function setMessage($message)
    {
        $message = trim($message);

        if ( ! $message) {
            throw new Exception('A message is required!.');
        }

        $this->messages[] = $message;
    }

    /**
     * Get API's messages.
     *
     * @return array
     **/
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Set a new erro message for the API.
     *
     * @param string $error
     *
     * @return void
     ***/
    protected function setError($error)
    {
        $error = trim($error);

        if ( ! $error) {
            throw new Exception('An error message is required!.');
        }

        $this->errors[] = $error;
    }

    /**
     * Get API's eror messages.
     *
     * @return array
     **/
    public function getErrors()
    {
        return $this->errors;
    }
}
