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

function getIngredients($dish_name, $dh)
{
    global $db;

    $query = "select * from Contains natural join Dish where Dish_Name = :dn and DH_Name = :dh";

    $statement = $db->prepare($query);
    $statement->bindValue(":dn", $dish_name);
    $statement->bindValue(":dh", $dh);
    $statement->execute();

    $results = $statement->fetchAll();

    $statement->closeCursor();


    return $results;

}

function getIngredientsMessage($dn, $dh) 
{
    $Ingredients = getIngredients($dn, $dh);
    $Nuts = 0;
    $Vegan = 0;
    $GlutenFree = 0;
    $ShellFish = 0;
    $DairyFree = 0;
    $Vegetarian = 0;
    $message = "Ingredients in "; 
    $message .= $dn;
    $message .= " at ";
    $message .= $dh;
    $message .= "\n";
    
    foreach($Ingredients as $i):
        $message .= "\t";
        $message .= $i['Ingredient_Name'];
        $message .= "\n";

        if($i['Nuts'] == 1)
            $Nuts = 1;
        if($i['Vegan'] == 1)
            $Vegan = 1;
        if($i['Gluten_Free'] == 1)
            $GlutenFree = 1;
        if($i['Shellfish'] == 1)
            $ShellFish = 1;
        if($i['Dairy_Free'] == 1)
            $DairyFree = 1;
        if($i['Vegetarian'] == 1)
            $Vegetarian = 1;
    endforeach;
    
    $message .= "\nAllergies\n";

    if($Nuts == 1 || $Shellfish == 1 || $DairyFree == 0) {
        if($Nuts == 1)
            $message .= "\tNuts\n";
        if($Shellfish == 1)
            $message .= "\tShellfish\n";
        if($Dairy_Free == 0)
            $message .= "\tDairy\n";
    }
    else
        $message .= "\tNone!\n";
    
    $message .= "\nDietary Restrictions\n";

    if($Vegan == 0 || $GlutenFree == 0 || $Vegetarian == 0) {
        if($Vegan == 0)
            $message .= "\tNot Vegan\n";
        if($GlutenFree == 0)
            $message .= "\tNot Gluten Free\n";
        if($Vegetarian == 0)
            $message .= "\tNot Vegetarian\n";
    }
    else
        $message .= "\tNone!\n";

    return $message;
}
?>