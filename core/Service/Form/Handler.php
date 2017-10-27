<?php
namespace Core\Service\Form;

//Uses
use Core\Model\Entity\Entity;

/**
 * Class Handler
 *
 * Permet une gestion dynamique du formulaire (POST, GET)
 * Fonctionne comme un factory
 *
 * Permet de définir :
 *      1- L'entité avec laquelle hydrater le formulaire en GET
 *      2- Les valeurs de post à récupérer en cas de soumission
 *      3- L'action à effectuer si le formulaire est soumis et que les données sont valides
 *
 */
abstract class Handler
{

    /**
     * @var String                $name Nom du handler dans App\Service
     * @var \Core\Model\Form\Form $form Instance construite d'un formulaire
     */
    protected $name,
              $form;


    ////ABSTRACT

    /**
     * Fonction à executer en cas de données valides
     *
     * @param Entity $entity
     */
    public abstract function execute($entity);

    /**
     * Entité à fournir à form si requete POST
     *
     * @return Entity $entity
     */
    public abstract function entityPost();


    ////METHODS

    /**
     * Construit une entité hydratée à partir du tableau s'il est fourni
     *
     * @param  array $entity_params Tableau à clé indiquant les valeurs pour les attributs de l'entité
     * @return Entity
     */
    public function buildEntity($entity_params = []){
        $entity_class = '\App\Model\Entity\\' . $this->getName();
        return new $entity_class($entity_params);
    }

    /**
     * Entité à fournir à form si requete GET
     *
     * @return Entity $entity
     */
    public function entityGet()
    {
        $entity = $this->buildEntity();
        return $entity;
    }

    /**
     * Crée un nouveau tableau dans lequel il insère la valeur POST si elle existe et '' autrement.
     *
     * @param  array $datas tableau contenant les noms des inputs à récupérer
     * @return array        au format demandé par Entity->hydrate
     */
    public function post2EntityParams(Array $datas){
        $fields = [];
        foreach($datas as $key){
            $fields[$key] = isset($_POST[$key]) ? $_POST[$key] : '';
        }
        return $fields;
    }

    /**
     * Génère l'entité en fonction de POST ou GET, l'injecte au formulaire
     * Si POST : Lance la validation
     * Si POST+valid : execute l'action définie
     */
    public function process(){
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            $entity = $this->entityGet();
        }else{
            $entity = $this->entityPost();
        }

        $this->setForm($entity);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($this->getForm()->validate()){
                $this->execute($entity);
            }
        }
    }


    ////SETTERS

    /**
     * Crée, hydrate et stocke un formulaire à l'aide du Service\Builder
     *
     * @param Entity  $entity
     */
    public function setForm(Entity $entity)
    {
        $builder_class = '\App\Service\Form\Builder\\' . $this->getName();
        $formBuilder = new $builder_class($entity);

        $formBuilder->build();
        $form = $formBuilder->getForm();

        $this->form = $form;
    }

    /**
     * Récupère dynamiquement le nom du Service\Handler et l'assigne à l'instance
     */
    public function setName(){
        $class = get_class($this); //Récupération du nom de la classe

        $needle_pos = strpos($class, 'Handler\\'); //Définition de la position du début du nom
        $needle_length = strlen('Handler\\');
        $start = $needle_pos+$needle_length;

        $name = substr($class, $start); //Troncature de chaine en fonction de la position du nom

        $end = strpos($name, '\\'); //On gère le cas où le Handler a hérité d'une autre classe abstraite que $this
        if($end) $name = substr($name, 0, $end);

        $this->name = $name;
    }


    ////GETTERS

    /**
     * @return \Core\Model\Form\Form
     */
    public function getForm(){
        return $this->form;
    }

    /**
     * @return String
     */
    public function getName(){
        if($this->name === null) $this->setName();
        return $this->name;
    }

}
