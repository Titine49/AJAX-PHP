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
        //var_dump($query);
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
                            <span>".$result["location"]. " | Cuisine ".utf8_encode($result["type"])." |</span>  <div class='ui star large rating' data-max-rating='5' data-rating='".$result["rating"]."'></div>
                        </div>
                        <div class='description'>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur urna odio, molestie vitae metus quis, laoreet facilisis nisi. Etiam tempus imperdiet sem, eu vestibulum nulla sollicitudin ut. Nulla nunc mi, dignissim eget dolor vitae, bibendum semper lorem. Quisque augue lacus, varius id accumsan ac, consectetur at sapien.</p>
                        </div>
                        <div class='extra'>
                            <div class='ui right floated'>
                                <a href='tel:".$result["phone"]."' class='ui icon button green' data-tooltip='".FormatPhone($result["phone"])."'>
                                    <i class='phone icon'></i>
                                </a>
                                <button class='ui icon button blue displayMap'>
                                    <i class='map icon'></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class='mapSection ui text color white' id='mapSection".$result["id"]."' style='display: none;'>
                        MAP
                    </div>
            ");
        }
    }
    echo("</div>");
    echo("<script>");
    echo("$('.ui.rating').rating('disable');");
    echo("
        $('.displayMap').on('click', function(e){
        $('.mapSection').slideUp();
        $(this).parent().parent().parent().parent().next().toggle();
        console.log('click');});
        
        function initMap() {
            // The location of Uluru
            var uluru = {lat: -25.344, lng: 131.036};
            // The map, centered at Uluru
            var map = new google.maps.Map(
                document.getElementById('mapSection'), {zoom: 4, center: uluru});
                // The marker, positioned at Uluru
                var marker = new google.maps.Marker({position: uluru, map: map});
            }
            ");
            echo("</script>");
            echo("<script async defer
            src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBmY8EDXSnzouNZOc6ahY9P4ZTeAxNw9eU&callback=initMap'>
            </script>");
}

function SortQuery($query){
    $array = array();

    foreach($query as $i) {
        if(isset($array[$i["name"]])){
            $array[$i["name"]]["type"] .= ", ".$i["type"];
        }
        else{
            $array[$i["name"]] = $i;}
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