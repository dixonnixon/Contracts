<?php
require("Psr4Autoloader.php");
$loader = new Psr4AutoloaderClass();
$loader->register();
$loader->addNamespace('Contracts\\Worker', 'app/Entities/Worker/');
$loader->addNamespace('Contracts\\Entities', 'app/Entities/');


use Contracts\Worker\Worker as Worker;

$w = new Worker("Борисов", "Игорь", "Иванович");
// print_r($w );

$w1 = new Worker("Корнеев", "Иван", "Григорьевич");
// print_r($w1 );

$w2 = new Worker("Борисов", "Игорь", "Иванович");

// print_r($w2 );


if(isset($w->surname)) var_dump(true, $w->surname); // true
if(isset($w->surnamesss)) var_dump(true, $w->surnamesss); // true
if(isset($w->name)) var_dump(true, $w->name); // true

function checkProperty($class, $prop)
{
  if(property_exists($class, $prop))
    return "Член $class::$prop существует\r\n";
  else
    echo "Член $class::$prop не существует\r\n";
}

// if(property_exists("Worker", "price"))
//   echo "Член Worker::price существует<br>";
// else
//   echo "Член Worker::price не существует<br>";
print_r(checkProperty("Worker", "price"));
print_r(checkProperty($w, "priddce"));
print_r(checkProperty($w, "age"));

$vars = get_class_vars("Worker");
print_R($vars);
$vars = get_object_vars($w->getObject());
print_R($vars);

$w->name = "gg";
// unset($w->name);
// $z = $w->bimbim(1,2,3);
// $e = $w->tes2t();
print_r($w);
// print_r($z);
print_r(get_class_methods($w));
var_dump("$w");

$str = var_export($w, true);

// print_r($str);

// eval("print_r( ".$str."->getArray());");

// // print_r($w->age);
// print_r($w->age);
print_r($w->age);

?>