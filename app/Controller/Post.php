<?php
namespace App\Controller;

class Post extends \Core\Controller\Twig {

	public function index(){

        $formHandler = new \App\Service\Form\Handler\Contact(
            function($entity){
                vardump($entity); //Ici on placera l'action à effectuer
            });
        $formHandler->process();

        $form = $formHandler->getForm()->buildView();

        $this->render('index', compact('form'));

	}

	public function list(){

		$pdo = new \Core\Model\Db\PDO('labSQL', 'labBDD', 'root', 'pomme');
		$table = new \App\Model\Table\Post($pdo);

		$posts = $table->all();

		$this->render('list', compact('posts'));

	}

	public function show($id){

        $pdo = new \Core\Model\Db\PDO('labSQL', 'labBDD', 'root', 'pomme');
        $table = new \App\Model\Table\Post($pdo);

        $post = $table->find($id);

        $this->render('show', compact('post'));

    }

    public function add(){

        $pdo = new \Core\Model\Db\PDO('labSQL', 'labBDD', 'root', 'pomme');
        $table = new \App\Model\Table\Post($pdo);

        $formHandler = new \App\Service\Form\Handler\Post(
            function($entity)use($table){
                vardump($entity); //Ici on placera l'action à effectuer
//                $table->add($entity);
            });
        $formHandler->process();

        $form = $formHandler->getForm()->buildView();

        $this->render('Admin/index', compact('form'));
    }

}