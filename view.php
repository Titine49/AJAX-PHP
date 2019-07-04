<?php

function DisplayHome($options)
{
    $content = "<div class='ui container' style='padding: 16em 0;'>";
    $content .= "<h1 style='margin: 0 0 2em 0; color: white;'>Chercher un Food-Truck</h1>";
    $content .= "<select class='ui fluid search normal dropdown' id='searchBar' multiple=''>";

    foreach($options as $option)
    {
        $content .= "<option value='".utf8_encode($option["type"])."'>".utf8_encode($option["type"])."</option>";
    }

    $content .= "</select>";
    $content .= "<button id='btnSearch' class='ui green button big' style='margin-top: 32px;'>Trouve moi un Food-Truck !</button>";

    $content .= "</div>";
    $content .= "</div>"; // FERMETURE DU SEGMENT DU HEADER (IL NE CONTIENT QUE LA BARRE DE RECHERCHE)
    return $content;
}