<?php

namespace App\Controllers;

use App\Models\Item;
use App\Exceptions\ApiException;

class IndexController extends ApiController {

    public function indexAction($test = null)
    {
        $items = Item::find();

        // throw new ApiException('fuck!');

        $this->setMessage(':D');
        $this->setError('D:');

        return $items;
    }

    public function testAction()
    {
        return 'holi';
    }
}

