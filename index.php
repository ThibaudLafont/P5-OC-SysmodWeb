<?php

function vardump($variable){

    echo '<pre>';
    var_dump($variable);
    echo '</pre>';

}

define('ROOT', __DIR__);

require('app/Autoloader.php');
\App\Autoloader::register();
require('core/Autoloader.php');
\Core\Autoloader::register();

$dic = \App\Service\DIC::getInstance();
$dic->setController();

$controller = $dic->get('Controller');

$router = new \Core\Service\Router();
$router->route('/^\/\/?$/', function() use ($controller){
	$controller->index();
});
$router->route('/^\/blog\/?$/', function() use ($controller){
	$controller->list();
});
$router->route('/^\/blog\/(.+)\/?$/', function($slug) use ($controller){
	$controller->show($slug);
});
$router->route('/^\/admin\/?$/', function() use ($controller){
	$controller->add();
});
$router->route('/^\/admin\/edit\/(.+)\/?$/', function($slug) use ($controller){
    $controller->edit($slug);
});


try{
	$router->execute($_SERVER['REQUEST_URI']);	
}catch(\Exception $e){
	$controller->notFound();
}