<?php
namespace Core\Service;

/**
 * Class Router
 * @package Core\Service
 *
 * Router basé sur un système de regex
 */
class Router{

    /**
     * @var array $routes Contient les regex et leur resolver
     */
    private $routes = array();


    ////METHODS

    /**
     * Permet l'execution en série de $this->routes() d'après un fichier retournant un tableau
     *
     * @param $path Chemin vers le fichier
     */
    public function addDefinitions($path){
        $routes = require($path);
        if(is_array($routes)){
            foreach($routes as $k => $v){
                $this->route($k, $v);
            }
        }
    }

    /**
     * Recherche si la clé $uri correpond à un regex du tableau et si oui execute le resolver associé
     *
     * @param $uri URL soumise
     * @return mixed
     *
     * @throws \Exception
     */
    public function execute($uri) {
        foreach ($this->routes as $pattern => $callback) {
            if (preg_match($pattern, $uri, $params) === 1) {
                array_shift($params);
                return call_user_func_array($callback, array_values($params));
            }
        }
        throw new \Exception('No matching route');
    }

    /**
     * Ajoute une entrée à $this->routes;
     *
     * @param ReGex    $pattern
     * @param Callable $callback
     */
    public function route($pattern, Callable $callback) {
        $this->routes[$pattern] = $callback;
    }
    
}
