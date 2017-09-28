<?php
namespace Core\Form\Builder;

use Core\Form\Field\InputField;
use Core\Form\Field\TextField;
use Core\Form\Validator\NotNullValidator;
use Core\Form\Validator\MaxLengthValidator;
use Core\Form\Validator\EmailValidator;

class ContactBuilder extends Builder{

	public function build(){
		$form = $this->getForm();
		$form->addField(new InputField([
				'label' => 'Votre nom',
				'name'  => 'name',
				'maxLength' => 55,
				'validators' => [
					new NotNullValidator('Le nom doit être renseigné'),
					new MaxLengthValidator('Le nom doit faire moins de 55 caractères', 55)
				]
			 ]))
			 ->addField(new InputField([
				'type'  => 'email',
				'label' => 'Votre mail',
				'name'  => 'mail',
				'maxLength' => 255,
				'validators' => [
					new NotNullValidator('L\'email doit être renseigné'),
					new EmailValidator('L\'email n\'est pas valide')
				]
			 ]))
			 ->addField(new TextField([
				'label' => 'Votre message',
				'name'  => 'content',
				'cols' => 45,
				'rows' => 15,
				'validators' => [
					new NotNullValidator('Le message ne doit pas être vide')
				]
			 ]));
	}

}