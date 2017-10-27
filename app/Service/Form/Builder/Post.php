<?php
namespace App\Service\Form\Builder;

//Uses
//fields
use \Core\Model\Form\Field\Input;
use \Core\Model\Form\Field\Text;
//validators
use \Core\Service\Validator\NotNull;
use \Core\Service\Validator\MaxLength;
use \Core\Service\Validator\SelectedStrip;

/**
 * Class Post
 * @package App\Service\Form\Builder
 */
class Post extends \Core\Service\Form\Builder{

    /**
     * Voir doc \Core\Service\Form\Builder::build();
     */
	public function build(){
		$form = $this->getForm();
		$form->addField(new Input([
				'name'  => 'id',
                'type'  => 'hidden'
			 ]))
            ->addField(new Input([
                'label' => 'Le titre',
                'name'  => 'title',
                'maxLength' => 55,
                'validators' => [
                    new NotNull('Le titre doit être renseigné'),
                    new MaxLength('Le titre doit faire moins de 55 caractères', 55),
                    new SelectedStrip('Balises HTML interdites', '')
                ]
            ]))
			 ->addField(new Input([
				'label' => 'L\'auteur',
				'name'  => 'author',
				'maxLength' => 55,
				'validators' => [
					new NotNull('L\'auteur doit être renseigné'),
					new MaxLength('Le nom de l\'auteur doit faire moins de 55 caractères', 55),
                    new SelectedStrip('Balises HTML interdites', '')
				]
			 ]))
			 ->addField(new Text([
				'label' => 'Le chapô',
				'name'  => 'sum',
				'rows' => 4,
				'validators' => [
					new NotNull('Le chapô ne doit pas être vide'),
					new MaxLength('Le chapô doit faire moins de 250 caractères', 250),
                    new SelectedStrip('Balises HTML interdites', '')
				]
			 ]))
			 ->addField(new Text([
				'label' => 'L\'article',
				'name'  => 'content',
				'rows' => 15,
				'validators' => [
					new NotNull('Le contenu ne doit pas être vide'),
                    new SelectedStrip('Seules les balises h3, p, ul et ol sont autorisées', '<h3><p><ul><ol>')
				]
			 ])
         );
	}

}
