<?php
namespace App\Controller;

class PostController{

	protected $viewsPath = '/var/www/html/app/Views/',
			  $twig;

	public function __construct(){
		require_once '/var/www/html/vendor/autoload.php';
		$loader = new \Twig_Loader_Filesystem('app/Views'); // Dossier contenant les templates
		$twig = new \Twig_Environment($loader, array(
		  'cache' => false,
		  'debug' => true
		));
		$this->twig = $twig;
	}

	public function render($view, $variables){

		$view .= '.twig';
		echo $this->twig->render($view, $variables);

	}

	public function index(){

		$pdo = new \Core\Database\PdoDatabase('labSQL', 'labBDD', 'root', 'pomme');
		$table = new \App\Table\PostTable($pdo);
		$posts = $table->all();

		$this->render('index', compact('posts'));

	}

	public function show($id){

		$pdo = new \Core\Database\PdoDatabase('labSQL', 'labBDD', 'root', 'pomme');
		$table = new \App\Table\PostTable($pdo);
		$post = $table->find($id);

		$this->render('show', compact('post'));		

	}

}