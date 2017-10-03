<?php
namespace Core\Model\Entity;

abstract class Entity{

    public function __construct($datas = []){
        if(!empty($datas)) $this->hydrate($datas);
    }
    public function hydrate($datas){
        foreach($datas as $k => $v){
            $method = 'set'.ucfirst($k);
            if(method_exists($this, $method)) $this->$method($v);
        }
    }

}