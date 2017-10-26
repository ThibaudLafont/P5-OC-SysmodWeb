<?php
namespace Core\Service;

/**
 * Class DIC
 * @package Core\Service
 *
 * Container d'injection de dépendances
 *
 * Permet :
 *      Une injection de dépendances propre et centralisée, donc des objets plus faciles à faire évoluer et à maintenir
 *      Une configuration rapide en cas de changement d'environnement
 */
class DIC
{

    /**
     * @var array $registry  Contient les fonctions à résoudre pour obtenir la variable voulue
     * @var array $instances Contient le résultat des fonctions de $registry qui ont déjà été appelées
     */
    protected $registry  = [],
              $instances = [];


    ////METHODS

    /**
     * Permet de réaliser des gets sur l'instance à partir d'un fichier retournant un tableau à clé
     *
     * @param $path Chemin vers un fichier
     */
    public function addDefinitions($path){
        $data = require($path);
        foreach($data as $k=>$v) $this->set($k, $v);
    }

    /**
     * Retourne le résultat ou la valeur ayant pour clé $key
     *
     * @param String $key    Clé recherchée
     * @param Array  $params Paramètres pour résoudre la fonction (optionnel)
     * @return mixed
     */
    public function get(String $key, $params = null){
        if(is_callable($this->registry[$key])){
            if(!isset($this->instances[$key])){
                if($params === null) {
                    $this->instances[$key] = $this->registry[$key]();
                }
                else {
                    if(!is_array($params)) $instance = call_user_func($this->registry[$key], $params);
                    else                  $instance = call_user_func_array($this->registry[$key], array_values($params));

                    $this->instances[$key] = $instance;
                }
            }
            return $this->instances[$key];
        }
        else{
            return $this->registry[$key];
        }
    }

    /**
     * Ajoute une entrée au tableau registry
     *
     * @param String $key
     * @param void   $resolver
     */
    public function set(String $key, $resolver){
        if(!isset($this->registry[$key])) $this->registry[$key] = $resolver;
    }

}
