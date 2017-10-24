<?php
return
    [
        'Controller\Post\Add' => function(){
            $controller = $this->get('Controller\Post\Manage');

            $table = $this->get('Table\Show');
            $handler = $this->get('Handler\Add');

            $controller->add($handler, $table);
        },
        'Controller\Post\Edit' => function($slug){
            $controller = $this->get('Controller\Post\Manage');
            $controller->edit($this->get('Handler\Edit', $slug));
        }
    ];