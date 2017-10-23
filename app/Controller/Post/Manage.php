<?php
/**
 * Created by PhpStorm.
 * User: thib
 * Date: 10/10/17
 * Time: 17:54
 */

namespace App\Controller\Post;


class Manage extends \Core\Controller\Twig
{

    public function add(\App\Service\Form\Handler\Post\Add $handler,  \App\Model\Table\Show $table){
        //Traitement form
        $handler->process();

        //Récup el. entete de page
        $title = 'Ajouter un article';
        $lastDate = $table->lastInsertDate()->getDate();

        //recup de la vue du form
        $form = $handler->getForm()->buildView(); //Récup de la vue du form

        //Render
        $this->render('Admin/add', compact('title', 'lastDate', 'form'));
    }

    public function edit(\App\Service\Form\Handler\Post\Edit $handler){
        //Traitement form
        $handler->process();

        //Récup el. entete de page
        $title = '"' . $entity->getTitle() . '"';
        $entity = $handler->getForm()->getEntity();

        //Récupération de la vue du formulaire
        $form = $handler->getForm()->buildView();

        //Render
        $this->render('Admin/edit', compact('title', 'entity', 'form'));
    }

}