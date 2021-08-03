<?php

use Bullnet\Core\Config;

return
[
    'paths' => [
        'migrations' => APPLICATION_PATH . DS . 'Database' . DS . 'Migrations',
        'seeds' => APPLICATION_PATH . DS . 'Database' . DS . 'Seeds',
        'bootstrap' => 'bootstrap.php'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'production_db',
            'user' => 'root',
            'pass' => '',
            'port' => '3306',
            'charset' => 'utf8',
        ],

        'development' => [
            'adapter' => 'mysql',
            'host' => Config::get('LOCAL_DATABASE_HOST'),
            'name' => Config::get('LOCAL_DATABASE_NAME'),
            'user' => Config::get('LOCAL_DATABASE_USERNAME'),
            'pass' => Config::get('LOCAL_DATABASE_PASSWORD'),
            'port' => Config::get('LOCAL_DATABASE_PORT'),,
            'charset' => Config::get('LOCAL_DATABASE_CHARSET'),
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'testing_db',
            'user' => 'root',
            'pass' => '',
            'port' => '3306',
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
