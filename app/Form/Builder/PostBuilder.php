<?php
namespace App\Form\Builder;

use Core\Form\Field\InputField;
use Core\Form\Field\TextField;
use Core\Form\Validator\NotNullValidator;
use Core\Form\Validator\MaxLengthValidator;

class PostBuilder extends \Core\Form\Builder\Builder{

	public function build(){
		$form = $this->getForm();
		$form->addField(new InputField([
				'label' => 'Le titre',
				'name'  => 'titre',
				'maxLength' => 255,
				'validators' => [
					new NotNullValidator('Le nom doit être renseigné'),
					new MaxLengthValidator('Le nom doit faire moins de 55 caractères', 255)
				]
			 ]))
			 ->addField(new InputField([
				'label' => 'L\'Auteur',
				'name'  => 'auteur',
				'maxLength' => 55,
				'validators' => [
					new NotNullValidator('L\'auteur doit être renseigné'),
					new MaxLengthValidator('Le nom de l\'auteur doit faire moins de 55 caractères', 55)
				]
			 ]))
			 ->addField(new TextField([
				'label' => 'Le chapô',
				'name'  => 'chapo',
				'cols' => 45,
				'rows' => 4,
				'validators' => [
					new NotNullValidator('Le chapô ne doit pas être vide'),
					new MaxLengthValidator('Le chapô doit faire moins de 250 caractères', 250)
				]
			 ]))
			 ->addField(new TextField([
				'label' => 'L\'article',
				'name'  => 'contenu',
				'cols' => 45,
				'rows' => 20,
				'validators' => [
					new NotNullValidator('Le contenu ne doit pas être vide')
				]
			 ]));
	}

}