<?php
namespace App\Service;

class Autoloader
{

    static function register(){
        spl_autoload_register(array(static::class, 'autoload'));
    }

    static function autoload($class){
        if(strpos($class, 'App\\') === 0 || strpos($class, 'Core\\') === 0)
        {
            $class = lcfirst($class);
            $class = str_replace('\\', '/', $class);
            require dirname(dirname(__DIR__)) . '/' . $class . '.php';
        }
    }

}