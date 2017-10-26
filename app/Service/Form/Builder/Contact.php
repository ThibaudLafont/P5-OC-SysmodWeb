<?php
namespace App\Service\Form\Builder;

//Uses
//fields
use Core\Model\Form\Field\Input;
use Core\Model\Form\Field\Text;
//validators
use Core\Service\Validator\NotNull;
use Core\Service\Validator\MaxLength;
use Core\Service\Validator\Email;
use \Core\Service\Validator\SelectedStrip;

/**
 * Class Contact
 * @package App\Service\Form\Builder
 */
class Contact extends \Core\Service\Form\Builder{

    /**
     * Voir doc \Core\Service\Form\Builder::build();
     */
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
					new MaxLength('Le nom doit faire moins de 55 caractères', 55),
                    new SelectedStrip('Balises HTML interdites', '')
				]
			 ]))
			 ->addField(new Input([
				'type'  => 'email',
				'label' => 'Votre mail *',
				'name'  => 'email',
				'maxLength' => 255,
				'validators' => [
					new NotNull('L\'email doit être renseigné'),
					new Email('L\'email n\'est pas valide'),
                    new SelectedStrip('Balises HTML interdites', '')
				]
			 ]))
			 ->addField(new Text([
				'label' => 'Votre message *',
				'name'  => 'content',
				'rows' => 7,
				'validators' => [
					new NotNull('Le message ne doit pas être vide'),
                    new SelectedStrip('Balises HTML interdites', '')
				]
			 ]));
	}

}