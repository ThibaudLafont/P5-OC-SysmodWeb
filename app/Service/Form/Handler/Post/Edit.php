<?php
namespace App\Service\Form\Handler\Post;

//Uses
//Table
use App\Model\Table\Admin;
use App\Model\Table\Show;

/**
 * Class Edit
 * @package App\Service\Form\Handler\Post
 */
class Edit extends \App\Service\Form\Handler\Post\Post
{
    /**
     * @var Int Id du post à éditer
     */
    private $id;

    /**
     * Edit constructor.
     * @param Admin $admin
     * @param Show  $show
     * @param Int   $id
     */
    public function __construct(Admin $admin, Show $show, $id){
        parent::__construct($admin);
        $this->setTable('show', $show);
        $this->id = $id;
    }


    ////METHODS

    /**
     * @param Post $entity
     */
    public function execute($entity)
    {
        $this->getTable('admin')->edit($entity);

        $url = $entity->getUrl();
        header('Location: ' . $url);
    }

    /**
     * Ici on redéfini la fonction parente pour hydrater le form avec les données du post à éditer
     *
     * @return \App\Model\Entity\Post
     */
    public function entityGet()
    {
        $id = $this->id;

        $entity = $this->getTable('show')->find($id);

        if(!$entity) header('Location: /404/');
        else return $entity;
    }

}
