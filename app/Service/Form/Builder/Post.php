<?php
namespace App\Service\Form\Builder;

//On charge les fields
use \Core\Model\Form\Field\Input;
use \Core\Model\Form\Field\Text;
//On charge les validators
use \Core\Service\Validator\NotNull;
use \Core\Service\Validator\MaxLength;

class Post extends \Core\Service\Form\Builder\Builder{

	public function build(){
		$form = $this->getForm();
		$form->addField(new Input([
				'label' => 'Le titre',
				'name'  => 'title',
				'maxLength' => 255,
				'validators' => [
					new NotNull('Le nom doit être renseigné'),
					new MaxLength('Le nom doit faire moins de 55 caractères', 255)
				]
			 ]))
			 ->addField(new Input([
				'label' => 'L\'Auteur',
				'name'  => 'author',
				'maxLength' => 55,
				'validators' => [
					new NotNull('L\'auteur doit être renseigné'),
					new MaxLength('Le nom de l\'auteur doit faire moins de 55 caractères', 55)
				]
			 ]))
			 ->addField(new Text([
				'label' => 'Le chapô',
				'name'  => 'sum',
				'cols' => 45,
				'rows' => 4,
				'validators' => [
					new NotNull('Le chapô ne doit pas être vide'),
					new MaxLength('Le chapô doit faire moins de 250 caractères', 250)
				]
			 ]))
			 ->addField(new Text([
				'label' => 'L\'article',
				'name'  => 'content',
				'cols' => 45,
				'rows' => 20,
				'validators' => [
					new NotNull('Le contenu ne doit pas être vide')
				]
			 ]));
	}

}