<?php
namespace App\Service\Form\Builder;

use Core\Model\Form\Field\Input;
use Core\Model\Form\Field\Text;
use Core\Service\Validator\NotNull;
use Core\Service\Validator\MaxLength;
use Core\Service\Validator\Email;
use Core\Service\Form\Builder;

class Contact extends Builder{

	public function build(){
		$form = $this->getForm();
		$form->setValidatedMessage(
		        'success',
                'Le mail a bien été envoyé. Une réponse vous sera apportée sous 48h'
        );
		$form->addField(new Input([
				'label' => 'Votre nom *',
				'name'  => 'name',
				'maxLength' => 55,
				'validators' => [
					new NotNull('Le nom doit être renseigné'),
					new MaxLength('Le nom doit faire moins de 55 caractères', 55)
				]
			 ]))
			 ->addField(new Input([
				'type'  => 'email',
				'label' => 'Votre mail *',
				'name'  => 'email',
				'maxLength' => 255,
				'validators' => [
					new NotNull('L\'email doit être renseigné'),
					new Email('L\'email n\'est pas valide')
				]
			 ]))
			 ->addField(new Text([
				'label' => 'Votre message *',
				'name'  => 'content',
				'rows' => 7,
				'validators' => [
					new NotNull('Le message ne doit pas être vide')
				]
			 ]));
	}

}