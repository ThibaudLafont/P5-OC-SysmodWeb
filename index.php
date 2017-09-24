<?php
define('ROOT', __DIR__);

require('app/Autoloader.php');
\App\Autoloader::register();
require('core/Autoloader.php');
\Core\Autoloader::register();

$controller = new App\Controller\PostController();

if(isset($_GET['p'])){
	if($_GET['p'] == 'show') $controller->show($_GET['id']);	
	elseif($_GET['p'] == 'list') $controller->list();
}

else $controller->list();
