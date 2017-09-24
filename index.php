<?php
define('ROOT', __DIR__);

require('app/Autoloader.php');
\App\Autoloader::register();
require('core/Autoloader.php');
\Core\Autoloader::register();

$router = new \Core\Router\Router();

$router->route('/^\/blog\/?$/', function(){
	$controller = new App\Controller\PostController();	
	$controller->list();
});
$router->route('/^\/blog\/(.+)\/?$/', function($slug){
	$controller = new App\Controller\PostController();	
	$controller->show($slug);
});

try{
	$router->execute($_SERVER['REQUEST_URI']);	
}catch(\Exception $e){
	$controller = new \App\Controller\PostController();
	$controller->list(); //While home page does not exists
	// $controller->notFound();
}