<?php
namespace Core\Service;

class DIC
{

    protected $registry  = [],
              $instances = [];

    public function set($key, $resolver){
        if(!isset($this->registry[$key])) $this->registry[$key] = $resolver;
    }

    public function get($key, $params = null){
        if(is_callable($this->registry[$key])){
            if(!isset($this->instances[$key])){
                if($params === null) {
                    $this->instances[$key] = $this->registry[$key]();
                }
                else {
                    if(!is_array($params)) $instance = call_user_func($this->registry[$key], $params);
                    else                  $instance = call_user_func_array($this->registry[$key], array_values($params));

                    $this->instances[$key] = $instance;
                }
            }
            return $this->instances[$key];
        }
        else{
            return $this->registry[$key];
        }
    }

    public function addDefinitions($path){
        $data = require($path);
        foreach($data as $k=>$v) $this->set($k, $v);
    }
}