<?php
require("Psr4Autoloader.php");
$loader = new Psr4AutoloaderClass();
$loader->register();
$loader->addNamespace('Contracts', 'app/');

use Contracts\Contract;
use Contracts\Worker;

function run() 
{
  for($i = 0; $i < 10; $i++)
  {

    switch(rand(1, 2))
    {
      case 1:
        $arr[] = new Contract(time(), time() + 30*24*60*60, "Описание",
          "10000",
          "Игорь",
          "Борисов",
          "Иванович",
          "Иван",
          "Корнеев",
          "Григорьевич"
        );
        break;
      case 2:
        $arr[] = new Worker("Корнеев", "Иван", "Григорьевич");
        break;
    }
    

  }

  print_r($arr[0]->getAge());
}


$ob = new Contract(time() - 60*60*24*365 * 3, time() + 30*24*60*60, "Описание",
"10000",
"Игорь",
"Борисов",
"Иванович",
"Иван",
"Корнеев",
"Григорьевич"
);
print_r($ob->getAge());





?>