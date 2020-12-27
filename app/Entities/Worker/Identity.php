<?php
namespace Contracts\Worker;
use Contracts\Entities\DataSource as DataSource;

class Identity extends DataSource
{
    protected $number;
    protected function check()
    {
        $patternOld = "#([\d]+)\|{$this->ds->surname}\|{$this->ds->name}\|{$this->ds->patronymic}#i";
        $patternNew = "#([\d]+).+?$#i";

        $check = "{$this->ds->surname}|{$this->ds->name}|{$this->ds->patronymic}";
        
        if(strpos($this->getPersists(), $check) === false) //if self not in list but the others are present
        {
          $new = preg_match($patternNew, $this->getPersists(), $matchNew);

          if($new) 
          {
            $this->number = $matchNew[1] + 1;
          } else $this->number = 1;

          $fd = fopen($this->getSrc(), "a");
          $str = "{$this->number}|" 
              . "{$this->ds->surname}|"
              . "{$this->ds->name}|"
              . "{$this->ds->patronymic}\r\n";
          fwrite($fd, $str);
          fclose($fd);
          self::update();
        }
        else 
        {

          $old = preg_match($patternOld, $this->getPersists(), $matchOld);
          // echo "\r\nMach Old: ";
          // print_r($matchOld);
          if($old) $this->number = $matchOld[1] + 1;
        }
    }

    function getAge()
    {
        return $this->ds->age;
    }
}


?>