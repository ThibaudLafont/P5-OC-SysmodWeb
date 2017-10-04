<?php
namespace App\Controller;

class Post extends \Core\Controller\Twig {

    private $table;

    public function __construct($table)
    {
        parent::__construct();
        $this->table = $table;
    }

    public function index(){

        $formHandler = new \App\Service\Form\Handler\Contact(
            function($entity){
                vardump($entity); //Ici on placera l'action à effectuer
            }
        );
        $form = $formHandler->getView();

        $this->render('index', compact('form'));

	}

	public function list(){

		$posts = $this->table->all();

		$this->render('list', compact('posts'));

	}

	public function show($id){

        $post = $this->table->find($id);

        $this->render('show', compact('post'));

    }

    public function add(){

	    $table = $this->table;
        $formHandler = new \App\Service\Form\Handler\Post(
            function($entity) use ($table){
                vardump($entity); //Ici on placera l'action à effectuer
            }
        );
        $form = $formHandler->getView();

        $this->render('Admin/index', compact('form'));
    }

}