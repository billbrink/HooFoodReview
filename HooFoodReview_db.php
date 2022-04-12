<?php

$dishIngredient = null;

function getDHHours($dh)
{
    global $db;

    $query = "select * from Hours where DH_Name = :dh Order By num ASC";

    $statement = $db->prepare($query);
    $statement->bindValue(":dh", $dh);
    $statement->execute();

    $results = $statement->fetchAll();

    $statement->closeCursor();


    return $results;
}

function getDHLocation($dh)
{

    global $db;

    $query = "select Location from Dining_Hall where DH_Name = :dh";

    $statement = $db->prepare($query);
    $statement->bindValue(":dh", $dh);
    $statement->execute();

    $results = $statement->fetch();

    $statement->closeCursor();


    return $results;

}

function getDishes()
{
    global $db;

    $query = "select * from Dish";

    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();

    $statement->closeCursor();


    return $results;

}

function getDishesDHSort()
{
    global $db;

    $query = "select * from Dish Order By DH_Name";

    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();

    $statement->closeCursor();


    return $results;

}

function getDishesEthnicitySort()
{
    global $db;

    $query = "select * from Dish Order By Ethnicity";

    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();

    $statement->closeCursor();


    return $results;

}

function getDishesRatingSort($order)
{
    global $db;

    if ($order == "DESC")
    {
        $query = "select * from Dish Order By Avg_Rating DESC";
    }
    else if ($order == "ASC")
    {
        $query = "select * from Dish Order By Avg_Rating ASC";
    }
   

    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();

    $statement->closeCursor();


    return $results;

}

function getDishesByDH($dh)
{

    global $db;

    $query = "select * from Dish where DH_Name = :dh";

    $statement = $db->prepare($query);
    $statement->bindValue(":dh", $dh);
    $statement->execute();

    $results = $statement->fetchAll();

    $statement->closeCursor();


    return $results;

}

function getIngredients()
{
    global $db;

    $query = "select * from Contains Natural Join Ingredient Order By Dish_Name";

    $statement = $db->prepare($query);
    $statement->bindValue(":dish", $dish);
    $statement->execute();

    $results = $statement->fetchAll();

    $statement->closeCursor();


    return $results;

}

?>