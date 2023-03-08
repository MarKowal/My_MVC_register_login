<?php

require '../vendor/autoload.php';

error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

//session start po error handlings żeby wyłapywaly błędy:
session_start();

$router = new Core\Router();


$router->add('', ['controller' => 'Home', 'action'=>'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('login', ['controller' => 'login', 'action'=>'new']);
$router->add('logout', ['controller' => 'login', 'action'=>'destroy']);

$router->dispatch($_SERVER['QUERY_STRING']);


?>