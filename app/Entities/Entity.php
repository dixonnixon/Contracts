<?php
namespace Contracts\Entities;
abstract class Entity
{
    function __get($prop)
    {
    //     // var_dump(get_object_vars($this), $prop, in_array($prop, $this->getters));
    //     // var_dump((isset($this->$prop)), "Called " . $prop);
    //     if(isset($this->$prop))
    //     {
            return $this->$prop;
    //     };
    //     return false;
    }
    function __set($prop, $val)
    {
        // var_dump("Private access");
        // if(in_array($prop))
        // {
        if(isset($this->$prop))
            $this->$prop = $val;
        // }
    }

    function __isset($index)
    {
        // var_dump($index);
        return isset($this->$index);
    }

    public function __toString()
    {
        return get_class($this) . ": {$this->surname}";
    }
}



?>