<?php 

require_once 'autoload.php';

$router = new Router;
$router->prepare();

$controller = Controller::factory($router::$controller_name);

//Untested Behavior	 
// FIXME: Too ugly, just to work
$name   =  !empty($router::$controller_name) ? $router::$controller_name : 'home';
$action =  !empty($router::$method_name) ? $router::$method_name : 'index';	

$controller->set_name($name);
$controller->set_action($action);


Caller::controller($controller,$router::$method_name,$router::$arguments);

?>