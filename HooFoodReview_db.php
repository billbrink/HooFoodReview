<?php

function getDHHours($dh)
{
    global $db;

    $query = "select * from Hours where DH_Name = :dh";

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

?>