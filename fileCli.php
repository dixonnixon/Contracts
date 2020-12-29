<?php
require("Psr4Autoloader.php");
$loader = new Psr4AutoloaderClass();
$loader->register();
$loader->addNamespace('Contracts', 'app/');

use Contracts\File as File;

$f = new File(10, "app/db/linux.words");
$f->getPage();
?>