<?php

namespace App\Views;

use App\App;
use Core\View;

class Navigation extends View
{
    public function render($template_path = ROOT . '/app/templates/nav.tpl.php')
    {
        return parent::render($template_path);
    }

    public function __construct()
    {
        parent::__construct($this->generate());
    }

    /**
     * Generates a navigation array with the designated parameters
     *
     * @return void
     */
    public function generate()
    {
        $nav_array = [App::$router::getUrl('home') => 'Home'];

        if (App::$session->getUser()) {
            if (App::$session->getUser()['role'] === 'admin') {
                return $nav_array + [
                    App::$router::getUrl('add') => 'Add New',
                    App::$router::getUrl('orders') => 'Orders',
                    App::$router::getUrl('users') => 'Users',
                    App::$router::getUrl('logout') => 'Logout',
                ];
            } elseif (App::$session->getUser()['role'] === 'user') {
                return $nav_array + [
                    App::$router::getUrl('orders') => 'Orders',
                    App::$router::getUrl('logout') => 'Logout',
                ];
            }
        } else {
            return $nav_array + [
                App::$router::getUrl('login') => 'Login',
                App::$router::getUrl('register') => 'Register',
            ];
        }
    }
}
