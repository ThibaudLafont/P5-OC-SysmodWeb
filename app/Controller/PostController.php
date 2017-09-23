<?php
namespace App\Controller;

class PostController{

	protected $viewsPath = '/var/www/html/app/Views/';

	public function render($view, $variables, $template = 'default'){

		$viewPath = $this->viewsPath . $view . '.php';
		ob_start();
			extract($variables);
			require($viewPath);
		$content = ob_get_clean();


		$templatePath = $this->viewsPath . $template . '.php';
		require($templatePath);
		
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