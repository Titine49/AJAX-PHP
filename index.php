<?php
include("connect.php");
include("model.php");
include("view.php");

include("includes/header.php");

$pageContent = "";

if(isset($_GET["page"]))
{
    $page = $_GET["page"];
    $types = GetFoodTypes($db);

    switch($page)
    {
        case "home":
        DisplayHome($types);
        break;
        
        default:
        DisplayHome($types);
        break;
    }
}
else
{
    $types = GetFoodTypes($db);
    $pageContent = DisplayHome($types);
}

echo $pageContent;

include("includes/footer.php");