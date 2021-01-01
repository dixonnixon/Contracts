<?php
require("Psr4Autoloader.php");
$loader = new Psr4AutoloaderClass();
$loader->register();
$loader->addNamespace('Contracts', 'app/');

use Contracts\File as File;
use Contracts\Search as Search;

// $f = new File(app/db/linux.words", 10);
// print_R($f->getPage());

$s = new Search("abb", "app/db/linux.words", 10);
$arr = $s->getPage();
for($i = 0; $i < count($arr); $i++)
{
    echo "{$arr[$i]}<br>";
}


echo $s;

?>