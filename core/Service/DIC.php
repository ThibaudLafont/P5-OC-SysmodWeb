<?php
/**
 * Created by PhpStorm.
 * User: thib
 * Date: 04/10/17
 * Time: 18:13
 */

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