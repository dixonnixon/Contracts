<?php
namespace Contracts\Company;
use Contracts\Entities\DataSource as DataSource;
use Contracts\Worker\Identity as WorkerIdentity;

class Identity extends DataSource
{
    protected $number;
    protected function check()
    {
      $this->checkWorkers();
      
      $patternOld = "#([\d]+)\|{$this->ds->name}\|{$this->ds->address}#i";
      // var_dump($patternOld);
      $patternNew = "#([\d]+).+?$#i";
      $check = "{$this->ds->name}|{$this->ds->address}";
      
      if(strpos($this->getPersists(), $check) === false) //if self not in list but the others are present
        {
          $new = preg_match($patternNew, $this->getPersists(), $matchNew);
          if($new) 
          {
            $this->number = $matchNew[1] + 1;
          } else $this->number = 1;

          $fd = fopen($this->getSrc(), "a");
          $str = "{$this->number}|" 
              . "{$this->ds->name}|"
              . "{$this->ds->address}\r\n";
          fwrite($fd, $str);
          fclose($fd);
          self::update();
        }
        else 
        {
          $old = preg_match($patternOld, $this->getPersists(), $matchOld);
          if($old) $this->number = $matchOld[1] + 1;
        }
    }

    private function checkWorkers()
    {
      $workers = $this->ds->getWorkers();
      var_dump($workers);
      if(count($workers) > 1)
      {
        foreach($workers as $wrk)
        {
          new WorkerIdentity($wrk);
        }
      }
    }



}
?>