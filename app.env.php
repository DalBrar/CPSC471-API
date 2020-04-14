<?php

// Definitions
define('BASE_PATH', dirname(realpath(__FILE__))."/");
define('LIBS',			BASE_PATH . "mvc/libs/");
define('MODELS',		BASE_PATH . "mvc/models/");
define('VIEWS',			BASE_PATH . "mvc/views/");
define('CONTROLLERS',	BASE_PATH . "mvc/controllers/");
define('PATH', substr($_SERVER['REQUEST_URI'], 4));
define('API', "https://dalbrar.dev/cpsc471/");

// includes
require_once LIBS . 'ErrorPage.php';
require_once LIBS . 'Router.php';
require_once LIBS . 'Controller.php';
require_once LIBS . 'Database.php';
require_once MODELS . 'GenericShowModel.php';
require_once CONTROLLERS . 'AdminController.php';
require_once CONTROLLERS . 'GenericController.php';
require_once CONTROLLERS . 'UserController.php';

?>