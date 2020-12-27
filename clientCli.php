<?php
require("Psr4Autoloader.php");
$loader = new Psr4AutoloaderClass();
$loader->register();
$loader->addNamespace('Contracts', 'app/');
$loader->addNamespace('Contracts\\Entities', 'app/Entities/');

$loader->addNamespace('Contracts\\Client', 'app/Entities/Client/');
$loader->addNamespace('Contracts\\Worker', 'app/Entities/Worker/');
$loader->addNamespace('Contracts\\Company', 'app/Entities/Company/');



use Contracts\Client\Client as Client;
use Contracts\Worker\Worker as Worker;
use Contracts\Company\Company as Company;

use Contracts\Client\Identity as ClientIdentity;
use Contracts\Worker\Identity as WorkerIdentity;
use Contracts\Company\Identity as CompanyIdentity;


$co1 =  new Company("Velocity");
$co1->addWorker(new Worker("Пупкин", "Вася", "Леонидович"));
$co1->addWorker(new Worker("Fire", "Ball", "Dramma"));

$c = new ClientIdentity(new Client(
    "Федорова", "Игнесса", "Володимеровна", new CompanyIdentity($co1)
));
$w1 = new WorkerIdentity(new Worker(
    "Корнеев", "Иван", "Григорьевич"
));

$w2 = new WorkerIdentity(new Worker(
    "Синегайw", "София", "Николаевна"
));
$w4 = new WorkerIdentity(new Worker(
    "Сиsdsdнегайw", "София", "Николаевна"
));
$w5 = new WorkerIdentity(new Worker(
    "Сиsdsdнегайw", "София", "33"
));

// var_dump($c, $w1, $w2);
var_dump( $w1, $w2);
// use Contracts\Client;
// use Contracts\Worker;
// use Contracts\Identity;


// $c = new Client("Борисов", "Игорь", "Иванович");
// $w = new Worker("Борисов", "Игорь", "Иванович");
// // print_R($c);

// $p1 = new Identity($c);
// $p2 = new Identity($w);
// print_r($p1);


?>