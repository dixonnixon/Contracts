<?php
namespace Contracts;
class Client extends Entity
{
    protected $surname;
    protected $name;
    protected $number;
    protected $patronymic;
    private $hid;
    protected $age;
    private $price;

    function __construct($surname, $un, $patronymic)
    {
      $this->surname = $surname;
      $this->name = $un;
      $this->patronymic = $patronymic;
      $this->age = 4;
    }

    

    private function tes2t()
    {
      echo "Вызов закрытого метода test()";
    }

    

}
?>