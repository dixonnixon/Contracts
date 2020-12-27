<?php
namespace Contracts\Worker;
use Contracts\Entities\Entity as Entity;

class Worker extends Entity
{
    protected $surname;
    protected $name;
    protected $patronymic;
    private $hid;
    protected $age;
    private $price;

    // protected $getters = array("name", "surname", "patronymic", "number", "price");

    function __construct($surname, $un, $patronymic)
    {
      $this->surname = $surname;
      $this->name = $un;
      $this->patronymic = $patronymic;
      // print_r(get_object_vars($this));
    }

    function getObject()
      { 
        $class = new \stdClass();
        $class->surname = $this->surname; 
        $class->name = $this->name; 
        $class->patronymic = $this->patronymic; 
          return $class;
      }

    

}


?>