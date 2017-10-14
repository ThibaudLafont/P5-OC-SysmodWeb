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
        $this->manage('Ajouter un article', 'Admin/add', $handler);
    }
    public function edit(\App\Service\Form\Handler\Post\Edit $handler){
        $this->manage('Modifier un article', 'Admin/edit', $handler);
    }

    public function manage($title, $view,\Core\Service\Form\Handler $handler){
        $handler->process();
        $form = $handler->getForm()->buildView();
        $this->render($view, compact('title', 'form'));
    }

}