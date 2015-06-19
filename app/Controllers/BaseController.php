<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

abstract class BaseController extends Controller {

	public function afterExecuteRoute($dispatcher)
	{
		// $returned = $dispatcher->getReturnedValue();


		// $response = new Response();
		// $response->setContent([':D']);

		// $dispatcher->setReturnedValue($response);
	}

}
