<?php

namespace App\Model\Entity;

class Post extends \Core\Model\Entity\Entity{
    private $id,
        $title,
        $author,
        $sum,
        $content,
        $date,
        $editDate,
        $image;

    public function __get($key){
        $method = 'get' . ucfirst($key);
        if(method_exists($this, $method)) return $this->method();
    }

    public function getId(){
        return $this->id;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getAuthor(){
        return $this->author;
    }
    public function getSum(){
        return $this->sum;
    }
    public function getContent(){
        return $this->content;
    }
    public function getImage(){
        return $this->image;
    }
    public function getDate(){
        return $this->frenchDateRewrite($this->date);
    }
    public function getEditDate(){
        if($this->editDate === null) return null;
        return $this->frenchDateRewrite($this->editDate);
    }
    public function getUrl(){
        $slug = strtolower($this->getTitle());
        $slug = str_replace(' ', '-', $slug);
        return "/blog/{$slug}";
    }

    public function setId($id){
        $this->id = $id;
    }
    public function setTitle($title){
        $this->title = $title;
    }
    public function setAuthor($author){
        $this->author = $author;
    }
    public function setSum($sum){
        $this->sum = $sum;
    }
    public function setContent($content){
        $this->content = $content;
    }
    public function setDate($date){
        $this->date = $date;
    }
    public function setEditDate($editDate){
        $this->editDate = $editDate;
    }
    public function setImage($image){
        $this->image = $image;
    }

    public function frenchDateRewrite($date){
        $date = new \DateTime($date);
        return $date->format('d/m/y à H\hi');
    }

}