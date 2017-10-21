<?php
//tmp
function vardump($variable){

    echo '<pre>';
    var_dump($variable);
    echo '</pre>';

}

//ROOT path
define('ROOT', __DIR__);

//Autoloaders persos
require(ROOT . '/app/Autoloader.php');
\App\Autoloader::register();
require(ROOT . '/core/Autoloader.php');
\Core\Autoloader::register();

//Autoloader Composer
require_once ROOT . '/vendor/autoload.php';

//Appel du DIC et chargement de la config
$dic = new \Core\Service\DIC();
$dic->addDefinitions(ROOT . '/config/config.php');

//Chargement du router et des routes
$router = new \Core\Service\Router();

$router->route('/^\/\/?$/', function() use ($dic){
    $controller = $dic->get('Controller\Blog');
	$controller->index();
});
$router->route('/^\/blog\/?$/', function() use ($dic){
    $controller = $dic->get('Controller\Post\Show');
	$controller->list();
});
$router->route('/^\/blog\/(\d)\/.+\/?$/', function($id) use ($dic){
    $controller = $dic->get('Controller\Post\Show');
	$controller->show($id);
});
$router->route('/^\/admin\/add\/?$/', function() use ($dic){
    $dic->get('Controller\Post\Add');
});
$router->route('/^\/admin\/edit\/(\d)\/.+\/?$/', function($id) use ($dic){
    $dic->get('Controller\Post\Edit', $id);
});

//Execution du router
try{
    $router->execute($_SERVER['REQUEST_URI']);
}catch(\Exception $e){
    echo'notfound';
}

