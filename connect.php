<?php
define("HOST", "localhost");
define("USERNAME", "root");
define("PWD", "");
define("DB", "projet");
define("DEBUG", true);

$db = new PDO("mysql:host=".HOST.";dbname=".DB, USERNAME, PWD);

if(DEBUG) $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
else $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);