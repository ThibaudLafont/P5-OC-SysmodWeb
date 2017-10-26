<?php
namespace Core\Model\Form;

//Uses
use Core\Model\Entity\Entity;
use Core\Model\Form\Field\Field;

/**
 * Class Form
 * @package Core\Model\Form
 *
 * Permet la création et la validation de formulaires modulables
 *
 * Dependency : Core\Model\Entity\Entity
 *              Core\Model\Form\Field\Field
 */
class Form{

    /**
     * @var Instance  $entity           \Core\Model\Entity\Entity
     * @var Array     $fields           Rempli d'instances de \Core\Model\Form\Field\Field
     * @var bool|null $isValid          Null si pas de validation demandée, autrement true si valid ou false sinon
     * @var Array     $validatedMessage Tableau contenant les messages généraux à afficher en cas de succès/erreur
     * @var TagHTML   $surround         Balise par défault utilisée pour séparer les champs
     */
    private $entity,
            $fields = [],
            $isValid,
            $validatedMessage =
            [
                'error'   => 'Il y a des erreurs dans le formulaire',
                'success' => 'Le formulaire a bien été soumis'
            ],
            $surround = 'p';

    /**
     * Utilise $this->setEntity
     *
     * @param Entity $entity
     */
    public function __construct(Entity $entity){
        $this->setEntity($entity);
    }


    ////METHODS

    /**
     * Ajoute un champs au formulaire
     *
     * @param  Field $field
     * @return Form  $this  Permet l'utilisation du design pattern Fluent
     */
    public function addField(Field $field){
        $getter = 'get' . ucfirst($field->getName());
        $field->setValue($this->getEntity()->$getter());
        $this->fields[] = $field;
        return $this;
    }

    /**
     * Construit et retourne la vue du formulaire dynamiquement (avec/sans erreur générale)
     * Demande en fait à chaque champs de construire sa vue, et les assemble
     *
     * @return HTML
     */
    public function buildView(){
        $html = '';

        $html .= $this->getValidatedMessage();

        foreach($this->fields as $field){
            $html .= $this->surround($field->buildModule());
        }

        return $html;
    }

    /**
     * Encadre le contenu fourni par la balise définie en attribut $surround
     *
     * @param  HTML $html Contenu HTML à encadrer
     * @return HTML string
     */
    private function surround($html){
        $tag = $this->surround;
        $html = "<{$tag}>{$html}</{$tag}>";
        return $html;
    }

    /**
     * Lance un a un les tests de validation des champs
     * !!! Les champs eux même lancent les tests des différents \Service\Validators qu'ils stockent !!!
     *
     * @return bool
     */
    public function validate(){
        $valid = true;
        foreach($this->fields as $field){
            if(!$field->validate()) $valid = false;
        }
        $this->setValid($valid);
        return $valid;
    }


    ////SETTERS

    /**
     * @param Entity $entity
     */
    public function setEntity(Entity $entity){
        $this->entity = $entity;
    }

    /**
     * @param bool $valid
     */
    public function setValid(Bool $valid){
        if(is_bool($valid)) $this->isValid = $valid;
    }

    /**
     * @param String $type    La situation dans laquelle afficher le message [success|error]
     * @param String $message Le message à afficher
     */
    public function setValidatedMessage(String $type, String $message){
        $valid_type = ['success', 'error'];
        if(in_array($type, $valid_type)) $this->validatedMessage[$type] = $message;
    }


    ////GETTERS

    /**
     * @return Entity
     */
    public function getEntity(){
        return $this->entity;
    }

    /**
     * Retourne bool si demande de validation préalable, null sinon
     *
     * @return bool|null
     */
    public function isValid(){
        return $this->isValid;
    }

    /**
     * Si la validation a été demandée, retourne le message adapté (error/success)
     * Retourne '' sinon
     *
     * @return HTML|''
     */
    public function getValidatedMessage(){
        $valid = $this->isValid();
        if(!is_null($valid)){
            if($valid === false) $key = 'error';
            else $key = 'success';
            return "<p class=\"form_{$key}\">{$this->validatedMessage[$key]}</p>";
        }
        return '';
    }

}
