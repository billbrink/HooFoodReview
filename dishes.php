<?php
    require('connect-db.php');
    require('HooFoodReview_db.php');

    $Dishes = getDishes();

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "Ingredients")
  {
  }
}
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

<button class="tablink" onClick="location.href='diningHalls.php'" type="button">Dining Halls</button>
<button class="tablink" onClick="location.href='dishes.php'" type="button">Dishes</button>

<body>

<h1>Dishes</h1>
<!-- <div class="row justify-content-center">   -->
<table class="w3-table w3-bordered w3-card-4" style="width:90%">
  <thead>
  <tr style="background-color:#B0B0B0">
    <th width="10%">Dish</th>        
    <th width="10%">Dining Hall</th>        
    <th width="10%">Ethnicity</th>
    <th width="10%">Average Rating</th>
    <th width="10%">Rate</th> 
    <th width="10%">Ingredients</th>   
  </tr>
  </thead>
  <?php foreach($Dishes as $Dish): ?>
    <tr>
    <td><?php echo $Dish['Dish_Name']; ?></td>
    <td><?php echo $Dish['DH_Name']; ?></td>
    <td><?php echo $Dish['Ethnicity']; ?></td>
    <td><?php echo $Dish['Avg_Rating']; ?></td>
    <td>
        <form action="dishes.php" method="post">
            <input type="submit" value="Rate" name="btnAction"
            class="btn btn-primary" />
  </td>
  <td>
        <form action="dishes.php" method="post">
            <input type="submit" value="Ingredients" name="btnAction"
            class="btn btn-primary" />
  </td>
  </tr>
  <?php endforeach; ?>
  </table>

</body> 
</html> 
