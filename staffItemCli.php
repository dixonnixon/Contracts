<?php
require("Psr4Autoloader.php");
$loader = new Psr4AutoloaderClass();
$loader->register();
$loader->addNamespace('Contracts', 'app/');
$loader->addNamespace('Contracts', 'app/');
$loader->addNamespace('Contracts\\Entities', 'app/Entities/');

use Contracts\Pages;


var_dump(get_declared_interfaces());


?>