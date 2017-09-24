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

	public function getId(){
		return $this->_id;
	}

	public function getTitre(){
		return $this->_titre;
	}

	public function getContenu(){
		return $this->_contenu;
	}

	public function getExtrait($slice = 240){
		return substr($this->_contenu, 0, $slice) . '...';
	}

	public function getImage(){
		return $this->_image;
	}

	public function getDateAjout(){
		return $this->frenchDateRewrite($this->_dateAjout);
	}

	public function getDateModif(){
		if($this->_dateAjout === null) return null;
		return $this->frenchDateRewrite($this->_dateAjout);
	}
	
	public function getUrl(){
		return "?p=show&id={$this->_id}";
	}

	public function frenchDateRewrite($date){
		$date = new \DateTime($date);
		return $date->format('d/m/y à H\hi');
	}


}