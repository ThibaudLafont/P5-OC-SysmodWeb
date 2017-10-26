<?php
namespace Core\Model\Entity;

/**
 * Class Entity
 *
 * Sert de base à toute entité
 */
abstract class Entity{

    /**
     * Execute $this->hydrate si des données sont fournies
     *
     * @param array $datas Valeurs pour les attributs de l'entité
     */
    public function __construct(Array $datas = []){
        if(!empty($datas)) $this->hydrate($datas);
    }

    /**
     * Assigne dynamiquement les valeurs aux attributs de l'entité
     *
     * @param array $datas Valeurs pour les attributs de l'entité
     */
    public function hydrate(Array $datas){
        foreach($datas as $k => $v){
            $method = 'set'.ucfirst($k);
            if(method_exists($this, $method)) $this->$method($v);
        }
    }

}
