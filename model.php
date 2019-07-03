<?php


function getFoodTruck($connexion){
    $requete = "SELECT * FROM .... LIMIT 50"; // METTRE LE NOM DE LA BDD
    $requete = $connexion->prepare($requete);

    if($requete->execute()) {
        return $requete->fetchAll(PDO::FETCH_ASSOC);// récupère un tableau avec des clés
    }else{
        return "Erreur requête sql";
    }
}


        
