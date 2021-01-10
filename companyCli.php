<?php
error_reporting(E_ALL);
require("Psr4Autoloader.php");
$loader = new Psr4AutoloaderClass();
$loader->register();
$loader->addNamespace('Contracts', 'app/');

$loader->addNamespace('Contracts\\Entities', 'app/Entities/');
$loader->addNamespace('Contracts\\Worker', 'app/Entities/Worker/');
$loader->addNamespace('Contracts\\Client', 'app/Entities/Client/');

$loader->addNamespace('Contracts\\Company', 'app/Entities/Company/');

use Contracts\Company\Company as Company;
use Contracts\Worker\Worker as Worker;
use Contracts\Client\Client as Client;

use Contracts\Company\Identity as CompanyIdentity;
use Contracts\Client\Identity as ClientIdentity;


$co1 =  new Company("Velocity");
$co1->addWorker(new Worker("Пупкин", "Вася", "Леонидович"));
$co1->addWorker(new Worker("Fire", "Ball", "Dramma"));


$c = new ClientIdentity(new Client(
    "Федорова", "Игнесса", "Володимеровна", new CompanyIdentity($co1)
));


$co1 =  new Company("Velocity");
$co1->addWorker(new Worker("Пупкин", "Вася", "Леонидович"));
$co1->addWorker(new Worker("Fire", "Ball", "Dramma"));
$co1->addWorker(new Worker("Fire", "Ball", "Comma"));

$c = new ClientIdentity(new Client(
    "Федорова", "Игнесса", "Володимеровна", new CompanyIdentity($co1)
));

echo "<pre>";
print_r($c);
echo "</pre>";

?>