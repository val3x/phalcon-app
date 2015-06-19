<?php

return new \Phalcon\Config([
    'default' => [
        'adapter'     => Phalcon\Db\Adapter\Pdo\Mysql::class,
        'host'        => '192.168.0.111',
        'username'    => 'elvis',
        'password'    => 'elviselvis',
        'dbname'      => 'ragnarok',
        'charset'     => 'utf8',
    ]
]);
