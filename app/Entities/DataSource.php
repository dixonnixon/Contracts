<?php
namespace Contracts\Entities;
abstract class DataSource 
{
    protected $ds;
    private static $persist;
    private static $src;

    function __construct(Entity $ent)
    {
        $this->ds = $ent;
        //checkEntity
        $object = $this->checkType(get_class($ent));
        // var_dump($object, (empty(self::$persist)));
        
        self::$src = "app/db/" . strtolower((string) ($object)) . ".txt";;
        $this->update();
        // var_dump(self::$src);
        $this->check();
        
        // var_dump("persist", self::$persist);
    }

    protected abstract function check();

    protected static function update()
    {
      echo "\r\nUpdate()\r\n";
      $content = file_get_contents(self::$src);
      self::$persist = &$content;
      // var_dump(self::$persist);
    }
    
    protected function getSrc()
    {
      return self::$src;
    }

    public function getPersists()
    {
      return self::$persist;
    }

    private function checkType($type)
    {
      $match = preg_split("/(?<name>\W+)/", $type);
      if(count($match) < 1) die("Wrong Class!!!!");
      return (string) array_pop($match);
    }

    public function __unset($prop)
    {
      unset($this->$prop);
    }

    // function getArray()
    // {
    //     return array($this->ds->surname, $this->ds->name, $this->ds->patronymic);
    // }

    // function getObject()
    // { 
    //   $class = new \stdClass();
    //   $class->surname = $this->surname; 
    //   $class->name = $this->name; 
    //   $class->patronymic = $this->patronymic; 
    //     return $class;
    // }

    

    // public function __toString()
    // {
    //     return get_class($this) . ": {$this->surname}";
    // }

    

    // public function __call($method, $arg)
    // {
    //   // if(!is_array($arg)) return false;
    //   if(!method_exists($this, $method)) return false;

    //   if($method == "bimbim")
    //   {
    //     return array_sum($arg);
    //   }
      
    //   return $this->$method();
    // }

    // function __set_state($arr)
    // {
    //   ///...!!!!
    //   return new Client($arr["surname"], $arr["number"], $arr["patronymic"]);
    // }

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