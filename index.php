<?php

require('app/Autoloader.php');
\App\Autoloader::register();
require('core/Autoloader.php');
\Core\Autoloader::register();

$controller = new App\Controller\PostController();

if(empty($_GET['p'])) $controller->index();
if($_GET['p'] == 'show'){
	$controller->show($_GET['id']);	
}