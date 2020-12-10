<?php

define('ROOT', __DIR__);
define('DB_FILE', ROOT . '/app/data/db.json');

// Core
require 'core/functions/html.php';
require 'core/functions/form/validators.php';

// App
require 'app/functions/form/validators.php';

// Composer 
require 'vendor/autoload.php';

// Router
require 'app/config/routes.php';
