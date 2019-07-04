<?php

if(isset($_POST["search"]))
{
    include("connect.php");
    $search = $_POST["search"];

    $sql =
    "SELECT * FROM foodtrucks AS a
    INNER JOIN foodtrucks_foodtype AS b
    ON a.id = b.foodtruck
    INNER JOIN food_type AS c
    ON c.id = b.food_type
    WHERE ";

    for ($i = 0; $i < count($search); $i++)
    {
        if($i != 0)
        {
            $sql .= " OR ";
        }

        $sql .= "c.type=:type".$i;
    }

    $query = $db->prepare($sql);

    for ($i = 0; $i < count($search); $i++) {
        $var = utf8_decode($search[$i]);
        $query->bindValue(":type".$i, $var);
    }
    echo("<div class='ui items' style='padding: 8em 0;'>");
    echo("<h1 style='text-align: center; margin: 0 0 2em 0;'>Liste des food-trucks</h1>");
    if($query->execute()) {
        $query = $query->fetchAll(PDO::FETCH_ASSOC);
        $query = SortQuery($query);
        foreach($query as $result)
        {
            echo(
                "
                <div class='item'>
                    <div class='image'>
                        <img src='http://via.placeholder.com/400'>
                    </div>
                    <div class='content'>
                        <a class='header'>".utf8_encode($result["name"])."</a>
                        <div class='meta'>
                            <span>".$result["location"]. " |</span>  <div class='ui star large rating' data-rating='3'></div>
                        </div>
                        <div class='description'>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur urna odio, molestie vitae metus quis, laoreet facilisis nisi. Etiam tempus imperdiet sem, eu vestibulum nulla sollicitudin ut. Nulla nunc mi, dignissim eget dolor vitae, bibendum semper lorem. Quisque augue lacus, varius id accumsan ac, consectetur at sapien.</p>
                        </div>
                        <div class='extra'>
                            <div class='ui right floated'>
                                <a href='tel:".$result["phone"]."' class='ui icon button green' data-tooltip='".FormatPhone($result["phone"])."'>
                                    <i class='phone icon'></i>
                                </a>
                                <button class='ui icon button blue'>
                                    <i class='map icon'></i>
                                </button>
                            </div>
                        </div>
                        <div class='extra'>
                            Cuisine ".utf8_encode($result["type"])."
                        </div>
                    </div>
                </div>
                "
            );
        }
    }
    echo("</div>");
    echo("<script>");
    echo("$('.ui.rating').rating('disable');");
    echo("</script>");
}

function SortQuery($query){
    $array = array();

    foreach($query as $i) {
        if(isset($array[$i["name"]])){
            $array[$i["name"]]["type"] .= ", ".$i["type"];
        }
        else
            $array[$i["name"]] = $i;
    }

    return $array;
}

function FormatPhone($str) {
    if(strlen($str) == 10)
    {
        $res = substr($str, 0, 2) .'&nbsp;';
        $res .= substr($str, 2, 2) .'&nbsp;';
        $res .= substr($str, 4, 2) .'&nbsp;';
        $res .= substr($str, 6, 2) .'&nbsp;';
        $res .= substr($str, 8, 2) .'&nbsp;';
        return $res;
    }

    return $str;
}