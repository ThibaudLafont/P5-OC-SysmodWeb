<?php
namespace App\Controller\Post;

class Show extends \Core\Controller\Twig {

    private $table;

    public function __construct(\Twig_Environment $twig, \App\Model\Table\Show $table)
    {
        parent::__construct($twig);
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

}