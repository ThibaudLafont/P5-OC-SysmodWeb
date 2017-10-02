<?php
namespace App\Controller;

class Post extends \Core\Controller\Twig {

	public function processContact(){
		if(!empty($_POST)){

			$name    = isset($_POST['name'])    ? $_POST['name']    : '';
			$email    = isset($_POST['email'])    ? $_POST['email']    : '';
			$content = isset($_POST['content']) ? $_POST['content'] : '';

			$entity = new \App\Model\Entity\Contact([
				'name'    => $name, 
				'email'    => $email,
				'content' => $content
			]);

			$formBuilder = new \App\Service\Form\Builder\Contact($entity);
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
					'content' => 'Le email a bien été envoyé'
				];
            }
            unset($_SESSION['ContactForm']);
        }

        //Si entity n'a pas été défini (pas de traitement du form ou form valide)
		if(!isset($entity)){
			$entity = new \App\Model\Entity\Contact();
		}

		//On construit le formulaire
		$formBuilder = new \App\Service\Form\Builder\Contact($entity);
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

		$pdo = new \Core\Model\Db\PDO('labSQL', 'labBDD', 'root', 'pomme');
		$table = new \App\Model\Table\Post($pdo);

		$posts = $table->all();

		$this->render('list', compact('posts'));

	}

	public function show($id){

        $pdo = new \Core\Model\Db\PDO('labSQL', 'labBDD', 'root', 'pomme');
        $table = new \App\Model\Table\Post($pdo);

        $post = $table->find($id);

        $this->render('show', compact('post'));

    }


}