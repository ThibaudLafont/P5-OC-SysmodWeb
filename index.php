<?php
session_start();
define('ROOT', __DIR__);

function vardump($variable){

	echo '<pre>';
	var_dump($variable);
	echo '</pre>';

}

require('app/Autoloader.php');
\App\Autoloader::register();
require('core/Autoloader.php');
\Core\Autoloader::register();

$router = new \Core\Router\Router();

$router->route('/^\/\/?$/', function(){
	$controller = new App\Controller\PostController();	
	$controller->index();
});
$router->route('/^\/send-contact-mail\/?$/', function(){
	$controller = new App\Controller\PostController();	
	$controller->processContact();
});
$router->route('/^\/blog\/?$/', function(){
	$controller = new App\Controller\PostController();	
	$controller->list();
});
$router->route('/^\/blog\/(.+)\/?$/', function($slug){
	$controller = new App\Controller\PostController();	
	$controller->show($slug);
});
$router->route('/^\/admin\/?$/', function(){
	$controller = new App\Controller\AdminController();	
	$controller->index();
});
$router->route('/^\/admin\/ajouter-article\/?$/', function(){
	$controller = new App\Controller\AdminController();
	$controller->processAjout();
});
$router->route('/^\/admin\/edit-article-(.+)\/?$/', function($slug){
	$controller = new App\Controller\PostController();	
	$controller->show($slug);
});


try{
	$router->execute($_SERVER['REQUEST_URI']);	
}catch(\Exception $e){
	$controller = new \App\Controller\PostController();
	$controller->notFound();
}