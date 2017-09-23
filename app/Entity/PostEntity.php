<?php

namespace App\Entity;

class PostEntity{

	private $_id,
			$_titre,
			$_contenu,
			$_dateAjout,
			$_dateModif,
			$_image;

	public function __set($key, $value){
		$attr = '_'.$key;
		if(property_exists($this, $attr)){
			$this->$attr = $value;
		}
	}

	public function __get($key){

		$method = 'get'.ucfirst($key);
		if(method_exists($this, $method)){
			return $this->$method();
		}

		$attr = '_'.$key;
		if(property_exists($this, $attr)){
			return $this->$attr;
		}

		return null;
	}

	public function getExtrait($slice = 240){
		return substr($this->_contenu, 0, $slice) . '...';
	}

	public function getUrl(){
		return "?p=show&id={$this->_id}";
	}

	public function getDateAjout(){
		return $this->frenchDateRewrite($this->_dateAjout);
	}

	public function frenchDateRewrite($date){
		$date = new \DateTime($date);
		return $date->format('d/m/y à H\hi');
	}

}