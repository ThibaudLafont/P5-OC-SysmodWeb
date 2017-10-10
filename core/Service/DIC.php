<?php
namespace Core\Service;

class DIC
{

    protected $registry  = [],
              $instances = [];

    public function set($key, Callable $resolver){
        if(!isset($this->registry[$key])) $this->registry[$key] = $resolver;
    }

    public function get($key){
        if(!isset($this->instances[$key])){
            $this->instances[$key] = $this->registry[$key]();
        }
        return $this->instances[$key];
    }

}