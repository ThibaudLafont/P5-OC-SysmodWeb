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

        $title = "Blog";

		$this->render('list', compact('title', 'posts'));

	}

    public function show($id){

        $post = $this->table->find($id);

        //Vérification de l'existance du post demandé
        if($post !== false){
            $title = $post->getTitle();
            $this->render('show', compact('title', 'post'));
        }else{
            $this->notFound();
        }

    }

}