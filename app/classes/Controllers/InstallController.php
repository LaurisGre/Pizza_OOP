<?php

namespace App\Controllers;

use App\App;

class InstallController
{
    public function index()
    {
        session_destroy();

        App::$db->dropTable('users');
        App::$db->createTable('users');
        App::$db->insertRow('users', [
            'email' => 'a@a.com',
            'password' => 'a',
            'full_name' => 'adminislovas',
            'role' => 'admin'
        ]);
        App::$db->dropTable('pizzas');
        App::$db->createTable('pizzas');
        App::$db->dropTable('orders');
        App::$db->createTable('orders');
        App::$db->save();
    }
}
