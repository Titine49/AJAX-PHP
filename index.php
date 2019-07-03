<?php
include("model.php");
include("view.php");
include("connect.php");
include("includes/header.php");

if(isset($_GET["page"])) {
    $page = $_GET["page"];
    $types = getTypes($bdd);

    switch($page){
        case "home":
            echo displayHome($types);
            break;
        default:
            echo displayHome($types);
            break;
    }
} else {
    $types = getTypes($bdd);

    echo displayHome($types);
}

include("includes/footer.php");