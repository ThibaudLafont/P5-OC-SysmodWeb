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

	public function processContact(){
		if(!empty($_POST)){

			$name    = isset($_POST['name'])    ? $_POST['name']    : '';
			$mail    = isset($_POST['mail'])    ? $_POST['mail']    : '';
			$content = isset($_POST['content']) ? $_POST['content'] : '';

			$entity = new \Core\Form\Entity\ContactEntity([
				'name'    => $name, 
				'mail'    => $mail,
				'content' => $content
			]);

			$formBuilder = new \Core\Form\Builder\ContactBuilder($entity);
			$formBuilder->build();
			$form = $formBuilder->getForm();

			if($form->isValid()){
				//On envoie le message
				
				//On passe un message flash à index
				$_SESSION['ContactForm']['flash'] = 'success';
			}else{
				//On passe un message flash à index
				$_SESSION['ContactForm']['flash'] = 'alert';
				//On passe une entité à la session
				$_SESSION['ContactForm']['entity'] = serialize($entity);
			}
			header('Location: /');
		}else{
			$this->notFound();
		}
	}

	public function index(){
		//Si on affiche la page suite au traitement du formulaire
		if(isset($_SESSION['ContactForm'])){
			if($_SESSION['ContactForm']['flash'] === 'alert'){
				$flash = [
					'type'    => 'alert',
					'content' =>'Le formulaire contient des erreurs'
				];
				$entity = unserialize($_SESSION['ContactForm']['entity']); 
			}else{
				$flash = [
					'type'    => 'success',
					'content' => 'Le mail a bien été envoyé'
				];
			}
			unset($_SESSION['ContactForm']);
		}

		//Si entity n'a pas été défini (pas de traitement du form ou form valide)
		if(!isset($entity)){
			$entity = new \Core\Form\Entity\ContactEntity();
		}

		//On construit le formulaire
		$formBuilder = new \Core\Form\Builder\ContactBuilder($entity);
		$formBuilder->build();
		$form = $formBuilder->getForm();

		//Si le formulaire a été soumis mais contient des erruers, on les récupère
		if(isset($flash)){
			if($flash['type'] === 'alert'){
				$form->isValid();
			}
		}

		$this->render('index', compact('form', 'flash'));

	}

	public function list(){

		$pdo = new \Core\Database\PdoDatabase('labSQL', 'labBDD', 'root', 'pomme');
		$table = new \App\Table\PostTable($pdo);

		$posts = $table->all();

		$this->render('list', compact('posts'));

	}

	public function show($id){

		$pdo = new \Core\Database\PdoDatabase('labSQL', 'labBDD', 'root', 'pomme');
		$table = new \App\Table\PostTable($pdo);
		
		$post = $table->find($id);

		$this->render('show', compact('post'));		

	}

    public function notFound(){
        header('HTTP/1.0 404 Not Found');
        die('Page introuvable');
    }


}