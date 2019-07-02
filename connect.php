<?php
define("HOST", "localhost");
define("DB", "projet");
define("USERNAME", "root");
define("PASSWORD", "");

define("DEBUG", true);

$bdd = new PDO("mysql:host=".HOST.";dbname=".DB, USERNAME, PASSWORD);

if(DEBUG) {
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
else {
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
}

if($bdd) echo("Ca marche");
else echo("cheeee");