<?php

namespace App\Controllers\Admin;

use App\App;

class LogoutController
{
    public function index()
    {
        App::$session->logout('/login');
    }
}
