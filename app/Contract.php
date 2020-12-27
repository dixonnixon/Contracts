<?php
namespace Contracts;
class Contract extends Entity
{
    private $begin;
    private $end;
    private $price;
    private $desc;
    protected $age;
    
    public $client;
    public $employee;

    // protected $getters = array("begin", "end", "price", "desc");


    function __construct($begin, $end, $desc, $price,
        $clientName, $clientSurN, $clientPatron,    
        $employeeName, $employeeSurN, $employeePatron 
    )
    {
        $this->begin = $begin;
        $this->end = $end;
        $this->desc = $desc;
        $this->price = $price;

        $this->client = new Identity(new Client($clientSurN, $clientName, $clientPatron));
        $this->client->surname = trim($clientSurN);
        $this->client->setPatronymic = $clientPatron;
        // var_dump(substr($this->client->patronymic, 0, 2));

        $this->employee =  new Identity(new Worker($employeeSurN, $employeeName, $employeePatron));
        $this->employee->setSurname = $employeeSurN;
        $this->employee->setPatronymic = $employeePatron;
        
        $fd = fopen("app/db/contract.txt", "a");
        $str = "{$this->client->number}|".
            "{$this->employee->number}|".
            "{$this->begin}|".
            "{$this->end}|".
            "{$this->desc}|".
            "{$this->price}\r\n";
        fwrite($fd, $str);
        fclose($fd);
    }

    function getAge()
      {
        $dif = time() - $this->begin;
        $currentAge = $this->employee->age *  60*60*24*365 + $dif;
        return $currentAge;
      }

      function __get($prop)
      {
        if($prop == "age") {
            return $this->getAge();
        }
        else return parent::__get($prop);
      }
}




?>