<?php
namespace App\Controller\Post;

class Show extends \Core\Controller\Twig {

    private $table;

    public function __construct(\Twig_Environment $twig, \App\Model\Table\Show $table)
    {
        parent::__construct($twig);
        $this->setTable($table);
    }

    public function list(){
        //Éléments du header
        $title = "Blog";
        $authors_num = $this->getTable()->authorsNumber()[0];
        $lastDate = $this->getTable()->lastInsertDate()->getDate();

        //Liste des posts
        $posts = $this->getTable()->all();

		$this->render('list', compact('title', 'authors_num', 'lastDate', 'posts'));

	}

    public function show($id){
        //Récupération du post
        $post = $this->getTable()->find($id);

        //Vérification de l'existance du post demandé
        if($post !== false){
            $title = $post->getTitle();
            $this->render('show', compact('title', 'post'));
        }else{
            $this->notFound();
        }
    }

    public function getTable(){
        return $this->table;
    }
    
    public function setTable(\App\Model\Table\Show $table){
        $this->table = $table;
    }

}