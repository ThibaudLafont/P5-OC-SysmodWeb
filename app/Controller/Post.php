<?php
namespace App\Controller;

class Post extends \Core\Controller\Twig {

    private $table;

    public function __construct($table)
    {
        parent::__construct();
        $this->table = $table;
    }
    public function list(){

		$posts = $this->table->all();

		$this->render('list', compact('posts'));

	}

    public function show($id){

        $post = $this->table->find($id);

        $this->render('show', compact('post'));

    }


    public function index(){

        $formHandler = new \App\Service\Form\Handler\Contact();
        $formHandler->process();
        $form = $formHandler->getForm()->buildView();

        $this->render('index', compact('form'));

    }

    public function add(){

        $formHandler = new \App\Service\Form\Handler\Post\Add();
        $formHandler->process();
        $form = $formHandler->getForm()->buildView();

        $this->render('Admin/index', compact('form'));
    }
    public function edit($slug){

        $formHandler = new \App\Service\Form\Handler\Post\Edit($slug);
        $formHandler->process();

        $form = $formHandler->getForm()->buildView();

        $this->render('Admin/index', compact('form'));
    }
}