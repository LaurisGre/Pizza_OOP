<?php

namespace App\Controllers\Base;

use App\App;

class AdminController
{
    protected $redirected = '/';

    public function __construct()
    {
        if (App::$session->getUser()['role'] !== 'admin') {
            header("Location: $this->redirected");
            exit();
        }
    }
}