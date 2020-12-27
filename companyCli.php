<?php
require("Psr4Autoloader.php");
$loader = new Psr4AutoloaderClass();
$loader->register();
$loader->addNamespace('Contracts', 'app/');

$loader->addNamespace('Contracts\\Entities', 'app/Entities/');

$loader->addNamespace('Contracts\\Company', 'app/Entities/Company/');

use Contracts\Company\Company as Company;

use Contracts\Company\Identity as CompanyIdentity;

$co1 =  new Company("Velocity");
$co1->addWorker(new Worker("Пупкин", "Вася", "Леонидович"));
$co1->addWorker(new Worker("Fire", "Ball", "Dramma"));

$c = new ClientIdentity(new Client(
    "Федорова", "Игнесса", "Володимеровна", new CompanyIdentity($co1)
));


$co1 =  new Company("Velocity");
$co1->addWorker(new Worker("Пупкин", "Вася", "Леонидович"));
$co1->addWorker(new Worker("Fire", "Ball", "Dramma"));

$c = new ClientIdentity(new Client(
    "Федорова", "Игнесса", "Володимеровна", new CompanyIdentity($co1)
));


?>