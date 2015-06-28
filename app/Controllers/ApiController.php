<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

abstract class ApiController extends Controller {
    /**
     * API's response status.
     *
     * @var boolean $status
     **/
    private $status = true;

    /**
     * API's status code.
     *
     * More information: http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html
     *
     * @var int $status_code
     **/
    private $status_code = 200;

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
     * Set the status for the API.
     *
     * @param boolean $status
     *
     * @return void
     **/
    protected final function setStatus(boolean $status)
    {
        $this->status = $message;
    }

    /**
     * Get the status for the API.
     *
     * @return boolean
     **/
    public final function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the status code for the API.
     *
     * @param boolean $status
     *
     * @return void
     **/
    protected final function setCode(int $status_code)
    {
        $this->status_code = $status_code;
    }

    /**
     * Get the status code for the API.
     *
     * @return int
     **/
    public final function getCode()
    {
        return $this->status_code;
    }

    /**
     * Set a new message for the API.
     *
     * @param string $message
     *
     * @return void
     **/
    protected final function setMessage($message)
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
    public final function getMessages()
    {
        return $this->messages;
    }

    /**
     * Set a new erro message for the API.
     *
     * @param string $error
     *
     * @return void
     **/
    protected final function setError($error)
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
    public final function getErrors()
    {
        return $this->errors;
    }
}
