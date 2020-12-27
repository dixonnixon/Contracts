<?php
namespace Contracts\Client;
use Contracts\Entities\Entity as Entity;
class Client extends Entity
{
    protected $surname;
    protected $name;
    protected $patronymic;
    protected $company;
    private $hid;
    protected $age;
    private $price;

    function __construct($surname, $un, $patronymic, $company)
    {
      $this->surname = $surname;
      $this->name = $un;
      $this->patronymic = $patronymic;
      $this->company = $company;
      $this->age = 4;
    }

    

    private function tes2t()
    {
      echo "Вызов закрытого метода test()";
    }

    

}
?>