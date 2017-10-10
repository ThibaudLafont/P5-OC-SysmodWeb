<?php
return
[
    '/^\/\/?$/' =>
        function(){
            $this->app->index();
        },
    '/^\/blog\/?$/' =>
        function(){
            $this->app->list();
        },
    '/^\/blog\/(.+)\/?$/' =>
        function($slug){
            $this->app->show($slug);
        },
    '/^\/admin\/?$/' =>
        function(){
            $this->app->add('post');
        },
    '/^\/admin\/edit\/(.+)\/?$/' =>
        function($slug){
            $this->app->edit($slug);
        }
];