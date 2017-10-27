<?php
return
[
    '/^\/\/?$/' => function(){
        $controller = $this->getDic()->get('Controller\Blog');
        $controller->index();
    },
    '/^\/blog\/?$/' => function(){
        $controller = $this->getDic()->get('Controller\Post\Show');
        $controller->list();
    },
    '/^\/blog\/(\d+)\/.+\/?$/' => function($id){
        $controller = $this->getDic()->get('Controller\Post\Show');
        $controller->show($id);
    },
    '/^\/admin\/add\/?$/' => function(){
        $this->getDic()->get('Controller\Post\Add');
    },
    '/^\/admin\/edit\/(\d+)\/.+\/?$/' => function($id){
        $this->getDic()->get('Controller\Post\Edit', $id);
    },
];
