<?php
namespace App\Form\Entity;

class PostEntity extends \Core\Form\Entity\Entity{

	private $titre,
			$auteur,
			$chapo,
			$contenu;

	public function setTitre($titre){
		$this->titre = $titre;
	}
	public function setAuteur($auteur){
		$this->auteur = $auteur;
	}
	public function setChapo($chapo){
		$this->chapo = $chapo;
	}
	public function setContenu($contenu){
		$this->contenu = $contenu;
	}

	public function getTitre(){
		return $this->titre;
	}
	public function getAuteur(){
		return $this->auteur;
	}
	public function getChapo(){
		return $this->chapo;
	}
	public function getContenu(){
		return $this->contenu;
	}
}