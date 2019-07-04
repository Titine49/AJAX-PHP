<?php

function GetFoodTypes($db)
{
    $sql = "SELECT * FROM food_type";
    $query = $db->prepare($sql);

    if($query->execute())
    {
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    return "ERROR";
}