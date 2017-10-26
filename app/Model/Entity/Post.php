<?php
namespace App\Model\Entity;

/**
 * Class Post
 * @package App\Model\Entity
 */
class Post extends \Core\Model\Entity\Entity{

    /**
     * @var Int|String $id
     * @var String     $title
     * @var String     $author
     * @var String     $sum
     * @var String     $content
     * @var Date       $date
     * @var Date       $editDate
     */
    private $id,
            $title,
            $author,
            $sum,
            $content,
            $date,
            $editDate;

    /**
     * Permet un appel plus propre dans les vues
     *
     * @param $key
     * @return mixed
     */
    public function __get($key){
        $method = 'get' . ucfirst($key);
        if(method_exists($this, $method)) return $this->method();
    }


    ////METHODS

    /**
     * @param $date
     * @return string
     */
    public function frenchDateRewrite($date){
        $date = new \DateTime($date);
        return $date->format('d/m/y à H\hi');
    }

    /**
     * Réécris le titre pour l'URL
     *
     * @return mixed|string
     */
    public function slugWrite(){
        $slug = strtolower($this->getTitle());
        $slug = $this->stripAccents($slug);
        $slug = str_replace(' ', '-', $slug);

        return $slug;
    }

    /**
     * Supprime les accents d'une chaine de caractères
     * Utilisé dans la générations des URLS
     *
     * @param String $str
     * @return String
     */
    public function stripAccents(String $str) {
        $str = str_replace(
            array(
                'à', 'â', 'á', 'À', 'Â', 'Á',
                'î', 'Î',
                'ô', 'ö', 'Ô', 'Ö',
                'ù', 'û', 'ú', 'Ù', 'Û', 'Ú',
                'é', 'è', 'ê', 'ë', 'É', 'È', 'Ê', 'Ë',
                'ç', 'Ç',
                '\''
            ),
            array(
                'a', 'a', 'a', 'a', 'a', 'a',
                'i', 'i',
                'o', 'o', 'o', 'o',
                'u', 'u', 'u', 'u', 'u', 'u',
                'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e',
                'c', 'c',
                ' '
            ), $str);

        return $str;
    }


    ////SETTERS

    /**
     * @param String $author
     */
    public function setAuthor(String $author){
        $this->author = $author;
    }

    /**
     * @param String $content
     */
    public function setContent(String $content){
        $this->content = $content;
    }

    /**
     * @param $date
     */
    public function setDate($date){
        $this->date = $date;
    }

    /**
     * @param $editDate
     */
    public function setEditDate($editDate){
        $this->editDate = $editDate;
    }

    /**
     * @param Int|String $id
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * @param String $sum
     */
    public function setSum(String $sum){
        $this->sum = $sum;
    }

    /**
     * @param String $title
     */
    public function setTitle(String $title){
        $this->title = $title;
    }


    ////GETTERS

    /**
     * @return String
     */
    public function getAuthor(){
        return $this->author;
    }

    /**
     * @return String
     */
    public function getContent(){
        return $this->content;
    }

    /**
     * @param  bool $french
     * @return string
     */
    public function getDate($french = true){
        if($french) $date = $this->frenchDateRewrite($this->date);
        else        $date = $this->date;
        return $date;
    }

    /**
     * @param bool $french
     * @return null|string
     */
    public function getEditDate($french = true){
        if($this->editDate === null) return null;
        if($french) $date = $this->frenchDateRewrite($this->editDate);
        else        $date = $this->editDate;
        return $date;
    }

    /**
     * Retourne l'URL vers la page de modification du post
     *
     * @return string
     */
    public function getEditUrl(){
        $id = $this->getId();

        $slug = $this->slugWrite();

        return "/admin/edit/{$id}/{$slug}";
    }

    /**
     * @return Int|null
     */
    public function getId(){
        if($this->id === '') return null;
        return $this->id;
    }

    /**
     * @return String
     */
    public function getSum(){
        return $this->sum;
    }

    /**
     * @return String
     */
    public function getTitle(){
        return $this->title;
    }

    /**
     * Retourne l'URL vers le détail du post
     *
     * @return string
     */
    public function getUrl(){
        $id = $this->getId();

        $slug = $this->slugWrite();

        return "/blog/{$id}/{$slug}";
    }

}
