<?php

require_once 'src/Router.php';

define('VIEW_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR .'view' . DIRECTORY_SEPARATOR);
define('CONTROLLER', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR);

$route = new Router();

