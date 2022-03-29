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


?>