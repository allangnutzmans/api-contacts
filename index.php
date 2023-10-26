<?php

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('VIEW_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);

//require ROOT_PATH . 'vendor/autoload.php';
require ROOT_PATH . 'src/Controller.php';
//require ROOT_PATH . 'template';

$route = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];     //=action


if ($route == '/contact'){
    include ROOT_PATH . 'methods/Get.php';
    $controller = new \main\src\Controller();
    $controller->runMethod($method);
} else {
    include ROOT_PATH . 'controller/GetController.php';
}


