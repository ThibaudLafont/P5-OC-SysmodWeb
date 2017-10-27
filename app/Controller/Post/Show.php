<?php
namespace App\Controller\Post;

//Uses
use App\Model\Table\Show as ShowTable;

/**
 * Class Show
 * @package App\Controller\Post
 *
 * Extension spécialisée de \Core\Controller\Twig servant de controller pour l'affichage de posts
 */
class Show extends \Core\Controller\Twig {

    /**
     * @var ShowTable $table
     */
    private $table;

    /**
     * @param \Twig_Environment $twig
     * @param ShowTable $table
     */
    public function __construct(\Twig_Environment $twig, ShowTable $table)
    {
        parent::__construct($twig);
        $this->setTable($table);
    }


    ////METHODS

    /**
     * Rends la vue listant l'ensemble des posts
     */
    public function list(){
        //Éléments du header
        $title = "Blog";
        $authors_num = $this->getTable()->authorsNumber()[0];
        $lastDate = $this->getTable()->lastInsertDate()->getDate();

        //Liste des posts
        $posts = $this->getTable()->all();

		$this->render('Public/List', compact('title', 'authors_num', 'lastDate', 'posts'));

	}

    /**
     * Rends la vue détail du post correspondant à l'id
     *
     * @param $id
     */
    public function show($id){
        //Récupération du post
        $post = $this->getTable()->find($id);

        //Vérification de l'existance du post demandé
        if($post !== false){
            $title = $post->getTitle();
            $this->render('Public/Show', compact('title', 'post'));
        }else{
            $this->notFound();
        }
    }


    ////SETTERS

    /**
     * @param ShowTable $table
     */
    public function setTable(ShowTable $table){
        $this->table = $table;
    }


    ////GETTERS

    /**
     * @return ShowTable
     */
    public function getTable(){
        return $this->table;
    }

}
