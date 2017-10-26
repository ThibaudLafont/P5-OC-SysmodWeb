<?php
//ROOT PATH
///////////
define('ROOT', dirname(__DIR__));


//AUTOLOADERS
/////////////
require(ROOT . '/app/Service/Autoloader.php'); //Perso
\App\Service\Autoloader::register();

require_once ROOT . '/vendor/autoload.php';    //Composer


//DIC
/////
$dic = new \Core\Service\DIC();

$dic->addDefinitions(ROOT . '/config/DIC/config.php');   //Variables d'environnement
$dic->addDefinitions(ROOT . '/config/DIC/class.php');    //Classes
$dic->addDefinitions(ROOT . '/config/DIC/method.php');   //Appel méthodes classe nécessitant dépendance


//ROUTER
////////
$router = $dic->get('Router');

$router->addDefinitions(ROOT . '/config/Router/routes.php');  //Ajout des routes

$router->execute($_SERVER['REQUEST_URI']);                    //Execution du router
