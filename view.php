<?php

function displayHome($types){
    $content = "<select class='ui fluid normal search dropdown' id='search' multiple=''>";
    foreach($types as $type) {
        $content .= "<option value='".utf8_encode($type["type"])."'>".utf8_encode($type["type"])."</option>";
    }
    $content .= "</select>";
    $content .= "<button id='searchBtn' class='ui button teal'>Trouvez moi un Food Truck !</button>";
    return $content;
}