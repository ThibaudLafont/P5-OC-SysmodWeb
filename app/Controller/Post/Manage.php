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

    public function add(\App\Service\Form\Handler\Post\Add $handler){
        $this->manage('Ajouter un article', $handler);
    }
    public function edit(\App\Service\Form\Handler\Post\Edit $handler){
        $this->manage('Modifier un article', $handler);
    }

    public function manage($title, \Core\Service\Form\Handler $handler){
        $handler->process();
        $form = $handler->getForm()->buildView();
        $this->render('Admin/index', compact('title', 'form'));
    }

}