<?php 

echo "<script type = 'text/javascript'>
    import { getAuth, createUserWithEmailAndPassword } from 'firebase/auth';

    const auth = getAuth();
    createUserWithEmailAndPassword(auth, email, password)
     .then((userCredential) => {
        // Signed in 
        const user = userCredential.user;
        // ...
    })
    .catch((error) => {
        const errorCode = error.code;
        const errorMessage = error.message;
        // ..
  });
</script>";

    require('connect-db.php');
    require('HooFoodReview_db.php');

    $dish = null;
    $Ingredients = getIngredients();
?>

<!DOCTYPE html>
<html>
<html lang="en">
<link href="tab_styles.css" rel="stylesheet" />
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>

<!-- Please update doc name when we come up with something better than base -->

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Basic web app for interacting with Hoo Food Review">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Hoo Food Review</title>
</head> 

<!-- Tab stuff taken from https://www.w3schools.com/howto/howto_js_full_page_tabs.asp?msclkid=0750ebc7ae1311ec95c4ba22f2991121 -->




<body>

<h1>Dietary Information</h1>
<!-- <div class="row justify-content-center">   -->
<table class="w3-table w3-bordered w3-card-4" style="width:90%">
  <thead>
  <tr style="background-color:#B0B0B0">
    <th width="25%">Dish</th>        
    <th width="50%">Ingredients</th>        
    <th width="10%">Nuts</th>
    <th width="10%">Vegan</th>
    <th width="10%">Gluten Free</th> 
    <th width="10%">Shellfish</th>
    <th width="10%">Dairy Free</th>
    <th width="10%">Vegetarian</th>   
  </tr>
  </thead>
  <?php foreach($Ingredients as $I): ?>
    <?php $cur_dish = $I['Dish_Name']; ?>
    <?php if($I['Dish_Name'] != $dish){ ?>
    <tr>
    <td><?php
    if($I['Dish_Name'] != $dish){
        echo $I['Dish_Name'];
    }
     ?></td>
    <td><?php $Ingredient = null;
    if($I['Dish_Name'] != $dish){
    foreach($Ingredients as $IIN): 
        if($IIN['Dish_Name'] == $cur_dish && $Ingredient == null){
            $Ingredient = $IIN['Ingredient_Name'];
        }
        elseif($IIN['Dish_Name'] == $cur_dish && $Ingredient != null){
            $Ingredient = $Ingredient.", ".$IIN['Ingredient_Name'];
        }
    endforeach;
        echo $Ingredient;} ?></td>
    <td><?php $nuts = "No";
    if($I['Dish_Name'] != $dish){
        foreach($Ingredients as $IN):
            if($IN['Dish_Name'] == $cur_dish){
                if($IN['Nuts']){
                    $nuts = "Yes";
                }
            }
    endforeach;
    echo $nuts;
    }
     ?></td>
    <td><?php $vegan = "No";
    if($I['Dish_Name'] != $dish){
        foreach($Ingredients as $IN):
            if($IN['Dish_Name'] == $cur_dish){
                if($IN['Vegan']){
                    $vegan = "Yes";
                }
            }
    endforeach;
    echo $vegan;
    }
    ?></td>
    <td><?php $gf = "No";
    if($I['Dish_Name'] != $dish){
        foreach($Ingredients as $IN):
            if($IN['Dish_Name'] == $cur_dish){
                if($IN['Gluten_Free']){
                    $gf = "Yes";
                }
            }
    endforeach;
    echo $gf;
    }
    ?></td>
    <td><?php $sf = "No";
    if($I['Dish_Name'] != $dish){
        foreach($Ingredients as $IN):
            if($IN['Dish_Name'] == $cur_dish){
                if($IN['Shellfish']){
                    $sf = "Yes";
                }
            }
    endforeach;
    echo $sf;
    }
     ?></td>
    <td><?php $df = "No";
    if($I['Dish_Name'] != $dish){
        foreach($Ingredients as $IN):
            if($IN['Dish_Name'] == $cur_dish){
                if($IN['Dairy_Free']){
                    $df = "Yes";
                }
            }
    endforeach;
    echo $df;
    }
     ?></td>
    <td><?php $vegetarian = "No";
    if($I['Dish_Name'] != $dish){
        foreach($Ingredients as $IN):
            if($IN['Dish_Name'] == $cur_dish){
                if($IN['Vegetarian']){
                    $vegetarian = "Yes";
                }
            }
    endforeach;
    echo $vegetarian;
    }
    ?></td>
  </tr>
  <?php $dish = $I['Dish_Name']; ?>
  <?php } ?>
  <?php endforeach; ?>
  </table>

</body> 
</html> 