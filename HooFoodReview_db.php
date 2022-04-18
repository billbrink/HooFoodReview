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

function setDHHours($id, $dh, $day, $open, $close)
{
    global $db;

    $query = "insert into Update_Dining_Hall values (0, :id, :dh, :day, :open, :close)";

    $statement = $db->prepare($query);
    $statement->bindValue(":id", $id);
    $statement->bindValue(":dh", $dh);
    $statement->bindValue(":day", $day);
    $statement->bindValue(":open", $open);
    $statement->bindValue(":close", $close);
    $statement->execute();

    $statement->closeCursor();
}

function addIngredient($iname, $nut, $vegan, $gf, $shell, $df, $veg)
{
    global $db;

    $query = "insert into Ingredient values (:iname, :nut, :vegan, :gf, :shell, :df, :veg)";
    $statement->bindValue(":iname", $iname);
    $statement->bindValue(":nut", $nut);
    $statement->bindValue(":vegan", $vegan);
    $statement->bindValue(":gf", $gf);
    $statement->bindValue(":shell", $shell);
    $statement->bindValue(":df", $df);
    $statement->bindValue(":veg", $veg);
    $statement->execute();

    $statement->closeCursor();
}

function addDish($dish, $dh, $eth)
{
    global $db;

    $query = "insert into Dish values (:dish, :dh, null, :eth)";

    $statement = $db->prepare($query);
    $statement->bindValue(":dish", $dish);
    $statement->bindValue(":dh", $dh);
    $statement->bindValue(":eth", $eth);
    $statement->execute();

    $statement->closeCursor();
}

function updateContains($dish, $i)
{
    global $db;

    $query = "insert into Contains values (:dish, :i)";

    $statement = $db->prepare($query);
    $statement->bindValue(":dish", $dish);
    $statement->bindValue(":i", $i);
    $statement->execute();

    $statement->closeCursor();
}

function removeDish($dish, $dh)
{
    global $db;

    $query = "delete from Dish where Dish_Name = :dish and DH_Name = :dh";

    $statement = $db->prepare($query);
    $statement->bindValue(":dish", $dish);
    $statement->bindValue(":dh", $dh);
    $statement->execute();

    $statement->closeCursor();
}

function addRemoveUser($id, $act, $admin, $uname, $uid)
{
    global $db;

    $query = "insert into Add_Remove values (0, :id, :act, :admin, :uname, :uid)";
    $statement = $db->prepare($query);
    $statement->bindValue(":id", $id);
    $statement->bindValue(":act", $act);
    $statement->bindValue(":admin", $admin);
    $statement->bindValue(":uname", $uname);
    $statement->bindValue("uid", $uid);
    $statement->execute();

    $statement->closeCursor();
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

function getUsers() {
    global $db;
    $query = "select * from User";
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

function getAdmins() {

    global $db;

    $query = "select * from Admin";

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

function getAllIngredients(){
    global $db;

    $query = "select * from Ingredient";

    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();

    $statement->closeCursor();


    return $results;

}

function getIngredients($dish_name, $dh)
{
    global $db;

    $query = "select * from Contains natural join Dish natural join Ingredient where Dish_Name = :dn and DH_Name = :dh";

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
    $Vegan = 1;
    $GlutenFree = 1;
    $ShellFish = 0;
    $DairyFree = 1;
    $Vegetarian = 1;

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
        if($i['Vegan'] == 0)
            $Vegan = 0;
        if($i['Gluten_Free'] == 0)
            $GlutenFree = 0;
        if($i['Shellfish'] == 1)
            $ShellFish = 1;
        if($i['Dairy_Free'] == 0)
            $DairyFree = 0;
        if($i['Vegetarian'] == 0)
            $Vegetarian = 0;
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


function getUserRates($username, $dish, $dh) {
    global $db;

    $query = "select * from Rates where user_computingID = :u and Dish_Name = :dn and DH_Name = :dh";

    $statement = $db->prepare($query);
    $statement->bindValue(":u", $username);
    $statement->bindValue(":dn", $dish);
    $statement->bindValue(":dh", $dh);
    
    $statement->execute();

    $result = $statement->fetch();

    $statement->closeCursor();

    return $result;
}

function updateUserRate($username, $dish, $dh, $newRate) {
    global $db;

    $query1 = "select * from Rates where user_computingID = :u and Dish_Name = :dn and DH_Name = :dh";
    $statement1 = $db->prepare($query1);
    $statement1->bindValue(":u", $username);
    $statement1->bindValue(":dn", $dish);
    $statement1->bindValue(":dh", $dh);

    $statement1->execute();

    $result = $statement1->fetch();

    $statement1->closeCursor();

    $query2 = "";
    $statement2 = null;

    if($result == null) {
        $query2 = "insert into Rates values(:u, :dn, :dh, :nr)";
        $statement2 = $db->prepare($query2);
        $statement2->bindValue(":u", $username);
        $statement2->bindValue(":dn", $dish);
        $statement2->bindValue(":dh", $dh);
        $statement2->bindValue(":nr", $newRate);
        $statement2->execute();
        $statement2->closeCursor();
    }
    else {
        $query2 = "update Rates set Rating = :nr where user_computingID = :u and Dish_Name = :dn and DH_Name = :dh";
        $statement2 = $db->prepare($query2);
        $statement2->bindValue(":u", $username);
        $statement2->bindValue(":dn", $dish);
        $statement2->bindValue(":dh", $dh);
        $statement2->bindValue(":nr", $newRate);
        $statement2->execute();
        $statement2->closeCursor();
    }
}
?>