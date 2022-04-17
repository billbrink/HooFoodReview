<?php 
    require('connect-db.php');
    require('HooFoodReview_db.php');

    $Ingredients = getAllIngredients();
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
    <th width="25%">Ingredient</th>        
    <th width="10%">Nuts</th>
    <th width="10%">Vegan</th>
    <th width="10%">Gluten Free</th> 
    <th width="10%">Shellfish</th>
    <th width="10%">Dairy Free</th>
    <th width="10%">Vegetarian</th>   
  </tr>
  </thead>
  <?php foreach($Ingredients as $I): ?>
    <tr>
    <td><?php echo $I['Ingredient_Name']; ?></td>
    <td><?php echo $I['Nuts']; ?></td>
    <td><?php echo $I['Vegan']; ?></td>
    <td><?php echo $I['Gluten_Free']; ?></td>
    <td><?php echo $I['Shellfish']; ?></td>
    <td><?php echo $I['Dairy_Free']; ?></td>
    <td><?php echo $I['Vegetarian']; ?></td>
  </tr>
  <?php endforeach; ?>
  </table>

</body> 
</html> 