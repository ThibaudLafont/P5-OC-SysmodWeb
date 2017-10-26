<?php
namespace App\Service;

/**
 * Class Autoloader
 * @package App\Service
 *
 * Execute des require dynamiquement grace au namespaces des class
 */
class Autoloader
{

    /**
     * Appelle la fonction autoload quand une classe est demandée et non définie
     */
    static function register(){
        spl_autoload_register(array(static::class, 'autoload'));
    }

    /**
     * Si la classe appartient au domaine personnel (cad * sauf /vendor), require dynamique
     *
     * @param $class
     */
    static function autoload($class){
        if(strpos($class, 'App\\') === 0 || strpos($class, 'Core\\') === 0)
        {
            $class = lcfirst($class);
            $class = str_replace('\\', '/', $class);
            require dirname(dirname(__DIR__)) . '/' . $class . '.php';
        }
    }

}