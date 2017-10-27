<?php
namespace App\Controller\Post;

//Uses
use App\Model\Table\Show;
use App\Service\Form\Handler\Post\Add;
use App\Service\Form\Handler\Post\Edit;

/**
 * Class Manage
 * @package App\Controller\Post
 *
 * Extension spécialisée de \Core\Controller\Twig servant de controller pour l'ajout et la modification de post
 */
class Manage extends \Core\Controller\Twig
{

    ////METHODS

    /**
     * @param Add $handler
     * @param Show $table
     */
    public function add(Add $handler, Show $table){
        //Traitement form
        $handler->process();

        //Récup el. entete de page
        $title = 'Ajouter un article';
        $lastDate = $table->lastInsertDate()->getDate();

        //recup de la vue du form
        $form = $handler->getForm()->buildView(); //Récup de la vue du form

        //Render
        $this->render('Admin/Add', compact('title', 'lastDate', 'form'));
    }

    /**
     * @param Edit $handler
     */
    public function edit(Edit $handler){
        //Traitement form
        $handler->process();

        //Récup el. entete de page
        $entity = $handler->getForm()->getEntity();
        $title = '"' . $entity->getTitle() . '"';

        //Récupération de la vue du formulaire
        $form = $handler->getForm()->buildView();

        //Render
        $this->render('Admin/Edit', compact('title', 'entity', 'form'));
    }

}
