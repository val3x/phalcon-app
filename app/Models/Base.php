<?php

namespace App\Models;

use Phalcon\Mvc\Model;

abstract class Base extends Model {

    public function initialize()
    {
        $this->setConnectionService('db.default');
    }

    public function beforeCreate()
    {
        $this->created = date('Y-m-d H:i:s');
    }

    public function beforeUpdate()
    {
        $this->modified = date('Y-m-d H:i:s');
    }

}
