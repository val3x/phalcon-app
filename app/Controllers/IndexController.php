<?php

namespace App\Controllers;

use App\Models\Item;

class IndexController extends BaseController {

    public function indexAction($test = null)
    {
        $items = Item::find();

        return $items;
    }

    public function testAction()
    {
        return 'holi';
    }
}

