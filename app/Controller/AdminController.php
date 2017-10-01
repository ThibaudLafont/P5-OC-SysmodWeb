<?php
namespace App\Controller;

class AdminController{

	protected $viewsPath = '/var/www/html/app/Views',
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

	public function processAjout(){

		if(!empty($_POST)){

			$titre   = isset($_POST['titre'])   ? $_POST['titre']   : '';
			$auteur  = isset($_POST['auteur'])  ? $_POST['auteur']  : '';
			$chapo   = isset($_POST['chapo'])   ? $_POST['chapo']   : '';
			$contenu = isset($_POST['contenu']) ? $_POST['contenu'] : '';

			$entity = new \App\Form\Entity\PostEntity([
				'titre'  => $titre, 
				'auteur' => $auteur,
				'chapo'  => $chapo,
				'contenu'=> $contenu
			]);

			$formBuilder = new \App\Form\Builder\PostBuilder($entity);
			$formBuilder->build();
			$form = $formBuilder->getForm();

			if($form->isValid()){
				//On ajoute l'article à la BDD
				
				//On passe un message flash à index
				$_SESSION['ContactForm']['flash'] = 'success';
			}else{
				//On passe un message flash à index
				$_SESSION['ContactForm']['flash'] = 'alert';
				//On passe une entité à la session
				$_SESSION['ContactForm']['entity'] = serialize($entity);
			}
			header('Location: /admin');
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
					'content' => 'L\'article a bien été ajouté'
				];
			}
			unset($_SESSION['ContactForm']);
		}

		//Si entity n'a pas été défini (pas de traitement du form ou form valide)
		if(!isset($entity)){
			$entity = new \App\Form\Entity\PostEntity();
		}

		//On construit le formulaire
		$formBuilder = new \App\Form\Builder\PostBuilder($entity);
		$formBuilder->build();
		$form = $formBuilder->getForm();

		//Si le formulaire a été soumis mais contient des erruers, on les récupère
		if(isset($flash)){
			if($flash['type'] === 'alert'){
				$form->isValid();
			}
		}
		$this->render('Admin/index', compact('form', 'flash'));
	}

    public function notFound(){
        header('HTTP/1.0 404 Not Found');
        die('Page introuvable');
    }


}