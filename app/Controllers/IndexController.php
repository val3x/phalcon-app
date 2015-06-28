<?php

namespace App\Controllers;

use App\Models\Item;
use App\Exceptions\ApiException;

class IndexController extends BaseController {

    public function indexAction($test = null)
    {
        $items = Item::find();

        throw new ApiException('fuck!');

        return $items;
    }

    public function testAction()
    {
        return 'holi';
    }
}

