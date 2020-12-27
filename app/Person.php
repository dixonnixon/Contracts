<?php
namespace Contracts;
abstract class Person extends Entity
{
    protected $person;

    function __construct(Entity $ent)
    {
        $this->person = $ent;
        $this->check(get_class($ent));
    }

    function getArray()
    {
        return array($this->surname, $this->name, $this->patronymic);
    }

    function getObject()
    { 
      $class = new \stdClass();
      $class->surname = $this->surname; 
      $class->name = $this->name; 
      $class->patronymic = $this->patronymic; 
        return $class;
    }

    public function __unset($prop)
    {
      unset($this->$prop);
    }

    public function __toString()
    {
        return get_class($this) . ": {$this->surname}";
    }

    public function __call($method, $arg)
    {
      if(!is_array($arg)) return false;
      if(!method_exists($this, $method)) return false;

      if($method == "bimbim")
      {
        return array_sum($arg);
      }
      
      $this->$method();
    }

    function __set_state($arr)
    {
      return new Client($arr["surname"], $arr["number"], $arr["patronymic"]);
    }

    // public function __call($method, $arg)
    // {
    //   var_dump("calling method $method \r\n");
    //   if(!is_array($arg)) return false;
    //   if(!method_exists($this, $method)) return false;
      
    //   if($method == "checkIdentity")
    //     $this->checkIdentity($arg[0]);
      
    // }
}


?>