<?php
namespace Core\Service\Form;

//Uses
use Core\Model\Entity\Entity;
use Core\Model\Form\Form;

/**
 * Class Builder
 *
 * Permet une construction au cas par cas des formulaire
 * Concrètement permet :
 *      1- Créer et hydrater le formulaire avec une entité
 *      2- Effectuer des addFields dans la fonction build
 *
 * Dependency : \Core\Model\Entity\Entity
 *              \Core\Model\Form\Form
 */
abstract class Builder{

    /**
     * @var \Core\Model\Form\Form
     */
	protected $form;

    /**
     * Crée un formulaire à partir de l'entité fournie
     *
     * @param \Core\Model\Entity\Entity $entity
     */
	public function __construct(Entity $entity){

		$this->setForm(new Form($entity));

	}


	////ABSTRACT

    /**
     * Construit le formulaire (ajout input, définition message d'erreur du formulaire)
     */
	public abstract function build();


	////SETTERS

    /**
     * @param \Core\Model\Form\Form $form
     */
	private function setForm(Form $form){
		$this->form = $form;
	}


	////GETTERS

    /**
     * @return \Core\Model\Form\Form
     */
	public function getForm(){
		return $this->form;
	}

}