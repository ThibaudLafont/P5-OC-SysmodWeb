<?php
namespace Core\Form\Entity;

class Entity{

	public function __construct($datas = []){
		if(!empty($datas)){
			$this->hydrate($datas);
		}
	}

	public function hydrate($options){
		foreach($options as $k => $v){
			$method = 'set' . ucfirst($k);
			if(method_exists($this, $method)){
				$this->$method($v);
			}
		}
	}

}