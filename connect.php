<?php

// déclaration en local
define('SERVER' ,"localhost");
define('USER' ,"root");
define('PASSWORD' , "");
define('BASE' ,"cefii"); // A VOIR SI A MODIFIER OU NON

// connection et récupération

try{
    $connexion = new PDO("mysql:host=".SERVER.";dbname=".BASE, USER, PASSWORD);
}
catch(Exception $e){
    echo "Echec de la connexion".$e->getMessage();
}