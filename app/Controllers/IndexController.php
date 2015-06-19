<?php

namespace App\Controllers;

use App\Models\Guild;

class IndexController extends BaseController {

    public function indexAction($test = null)
    {
        $guilds = Guild::find();

        // return $guilds;

        echo 'D:';

        return ':D';
    }

    public function testAction()
    {
        return 'holi';
    }
}

