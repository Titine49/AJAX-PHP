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
    echo("<div class='ui items'>");
    echo("<h1 style='text-align: center; margin: 0 0 2em 0;'>Liste des food-trucks</h1>");
    if($query->execute()) {
        $query = $query->fetchAll(PDO::FETCH_ASSOC);
        var_dump($query);
        foreach(array_unique($query, SORT_REGULAR) as $result)
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
                            <span>".$result["location"]." | ".$result["phone"]."</span>
                        </div>
                        <div class='description'>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur urna odio, molestie vitae metus quis, laoreet facilisis nisi. Etiam tempus imperdiet sem, eu vestibulum nulla sollicitudin ut. Nulla nunc mi, dignissim eget dolor vitae, bibendum semper lorem. Quisque augue lacus, varius id accumsan ac, consectetur at sapien.</p>
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
}

function SortQuery($query){
    
}