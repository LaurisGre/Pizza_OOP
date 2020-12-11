<?php

use Core\Router;

Router::add('home', '/', '\App\Controllers\HomeController');
Router::add('login', '/login', '\App\Controllers\LoginController');
Router::add('register', '/register', '\App\Controllers\RegisterController');
Router::add('install', '/install', '\App\Controllers\InstallController');

Router::add('add', '/add', '\App\Controllers\Admin\AddController');
Router::add('edit', '/edit', '\App\Controllers\Admin\EditController');
Router::add('orders', '/orders', '\App\Controllers\Admin\OrdersController');
Router::add('users', '/users', '\App\Controllers\Admin\UsersController');
Router::add('logout', '/logout', '\App\Controllers\Admin\LogoutController');
