<?php
namespace App\Controller;

class Admin extends \Core\Controller\Twig {

	public function processAjout(){

		if(!empty($_POST)){

			$title   = isset($_POST['title'])   ? $_POST['title']   : '';
			$author  = isset($_POST['author'])  ? $_POST['author']  : '';
			$sum   = isset($_POST['sum'])   ? $_POST['sum']   : '';
			$content = isset($_POST['content']) ? $_POST['content'] : '';

			$entity = new \App\Model\Entity\Post([
				'title'  => $title,
				'author' => $author,
				'sum'  => $sum,
				'content'=> $content
			]);

			$formBuilder = new \App\Service\Form\Builder\Post($entity);
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
			$entity = new \App\Model\Entity\Post();
		}

		//On construit le formulaire
		$formBuilder = new  \App\Service\Form\Builder\Post($entity);
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


}