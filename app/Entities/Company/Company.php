<?php
namespace Contracts\Company;
use Contracts\Entities\Entity as Entity;
use Contracts\Worker\Worker as Worker;
class Company extends Entity
{
    protected $name;
    protected $address;

    private $workers = array();

    function __construct($name, $address = "")
    {
        $this->name = $name;
        $this->address = $address;
    }

    function getWorkers()
    {
        return $this->workers;
    }

    function addWorker(Worker $worker)
    {
        $this->workers[] = $worker;
        // if(!empty)
    }

}
?>