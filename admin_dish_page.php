<?php
    require('connect-db.php');
    require('HooFoodReview_db.php');

    $Dishes = getDishes();
    $Ingredient_to_display = null;

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "Ingredients")
  {
    $DN = $_POST['dn'];
          $DH = $_POST['dh'];
          $message = getIngredientsMessage($DN, $DH);
          if($DishSort == "Sort by Dining Hall")
            $Dishes = getDishesDHSort();
          else if($DishSort == "Sort by Dish")
            $Dishes = getDishes();
          else if($DishSort == "Sort by Ethnicity")
            $Dishes = getDishesEthnicitySort();
          else if($DishSort == "Rating High to Low")
            $Dishes = getDishesRatingSort("DESC");
          else if($DishSort == "Rating Low to High")
            $Dishes = getDishesRatingSort("ASC");
          else if($DishSort == "O-Hill Options")
            $Dishes = getDishesByDH("O-Hill");
          else if($DishSort == "Newcomb Options")
            $Dishes = getDishesByDH("Newcomb");
          else if($DishSort == "Runk Options")
            $Dishes = getDishesByDH("Runk");
  }
  else if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "Sort by Dining Hall")
  {
    $Dishes = getDishesDHSort();
  }
  else if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "Sort by Dish")
  {
    $Dishes = getDishes();
  }
  else if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "Sort by Ethnicity")
  {
    $Dishes = getDishesEthnicitySort();
  }
  else if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "Rating High to Low")
  {
    $Dishes = getDishesRatingSort("DESC");
  }
  else if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "Rating Low to High")
  {
    $Dishes = getDishesRatingSort("ASC");
  }
  else if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "O-Hill Options")
  {
    $Dishes = getDishesByDH("O-Hill");
  }
  else if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "Newcomb Options")
  {
    $Dishes = getDishesByDH("Newcomb");
  }
  else if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "Runk Options")
  {
    $Dishes = getDishesByDH("Runk");
  }
  else if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "AddDish")
  {
    addDish($_POST['dish'], $_POST['dining_hall'], $_POST['ethnicity']);

    $ingredients_to_add = explode(',', $_POST['ingredients']);
    foreach($ingredients_to_add as $i):
      updateContains($_POST['dish'], $i);
    endforeach;
    $Dishes = getDishes();
  }
  else if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "Delete")
  {
    removeDish($_POST['dish_to_delete'], $_POST['dining_hall_to_delete']);
    $Dishes = getDishes();
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

    <script language="javascript">
        function ingredientsPopup() {
          var message = <?php echo json_encode($message); ?>;
          if(message != null){
            alert(message);
            <?php $message = null; ?>;
          }
        }
    </script>
</head> 

<!-- Tab stuff taken from https://www.w3schools.com/howto/howto_js_full_page_tabs.asp?msclkid=0750ebc7ae1311ec95c4ba22f2991121 -->

<?php 
if ($_SESSION['isAdmin'] == FALSE) {
?>
   <button class="tablink" onClick="location.href='diningHalls.php'" type="button">Dining Halls</button>
   <button class="tablink" onClick="location.href='dishes.php'" type="button">Dishes</button>
<?php 
}
else if ($_SESSION['isAdmin'] == TRUE) { 
?>
   <button class="tablink" onClick="location.href='admin_dh_page.php'" type="button">Dining Halls</button>
   <button class="tablink" onClick="location.href='admin_dish_page.php'" type="button">Dishes</button>
<?php
}
?>

<body onload="ingredientsPopup()">

<div class="container">
    <h1>Sort Options</h1>

<form name="mainForm" action="admin_dish_page.php" method="post">

<input type="submit" value="Sort by Dining Hall" name="btnAction" class="btn btn-dark"
        title="Sort by Dining Hall" />
<input type="submit" value="Sort by Dish" name="btnAction" class="btn btn-dark"
        title="Sort by Dish" />
<input type="submit" value="Sort by Ethnicity" name="btnAction" class="btn btn-dark"
        title="Sort by Ethnicity" />
<input type="submit" value="Rating High to Low" name="btnAction" class="btn btn-dark"
        title="Sort by Rating High to Low" />
<input type="submit" value="Rating Low to High" name="btnAction" class="btn btn-dark"
        title="Sort by Rating Low to High" />
<input type="submit" value="O-Hill Options" name="btnAction" class="btn btn-dark"
        title="Find O-Hill Food Options" />
<input type="submit" value="Newcomb Options" name="btnAction" class="btn btn-dark"
        title="Find Newcomb Food Options" />
<input type="submit" value="Runk Options" name="btnAction" class="btn btn-dark"
        title="Find Runk Food Options" />

<!--<input type="submit" value="Ingredients" name="btnAction" class="btn btn-primary" />-->
<button class="tablink" onClick="basicPopup('ingredient_page.php')" type="button" name="ing">Ingredients</button>
</form>
<hr/>

<div class="container">
  <h1>Add a Dish</h1>  

  <form name="mainAdminForm" action="admin_dish_page.php" method="post">
  <div class = "row mb-3 mx-3">
      Dish:
      <input type="text" class="form-control" name="dish" required />
  </div>
  <div class = "row mb-3 mx-3">
      Dining Hall:
      <input type="text" class="form-control" name="dining_hall" required />
  </div>
  <div class = "row mb-3 mx-3">
      Ethnicity:
      <input type="text" class="form-control" name="ethnicity" required />
  </div>
  <div class = "row mb-3 mx-3">
      Ingredients:
      <input type="text" class="form-control" name="ingredients" required />
  </div> 
  <input type="submit" value="AddDish" name="btnAction" class="btn btn-dark"
        title="insert a dish" />

</form>
<hr/>

<h1>Dishes</h1>
<!-- <div class="row justify-content-center">   -->
<table class="w3-table w3-bordered w3-card-4" style="width:90%">
  <thead>
  <tr style="background-color:#B0B0B0">
    <th width="10%">Dish</th>        
    <th width="10%">Dining Hall</th>        
    <th width="10%">Ethnicity</th>
    <th width="10%">Average Rating</th>
    <th width="10%">Ingredients</th>   
    <th width="10%">Delete</th>
  </tr>
  </thead>
  <?php foreach($Dishes as $Dish): ?>
    <tr>
    <td><?php echo $Dish['Dish_Name']; ?></td>
    <td><?php echo $Dish['DH_Name']; ?></td>
    <td><?php echo $Dish['Ethnicity']; ?></td>
    <td><?php echo $Dish['Avg_Rating']; ?></td>
  <td>
        <form action="admin_dish_page.php" method="post">
           <!--- <input type="submit" value="Ingredients" name="btnAction" class="btn btn-primary" /> --->
           <input type="hidden" name="dn" value="<?php echo $Dish['Dish_Name']?>" />
            <input type="hidden" name="dh" value="<?php echo $Dish['DH_Name']?>"/>
            <input type="submit" value="Ingredients" name="btnAction" class="btn btn-primary" />
        </form>
  </td>
  <td>
    <form action="admin_dish_page.php" method="post">
            <input type="submit" value="Delete" name="btnAction" class="btn btn-danger" />
            <input type="hidden" name="dish_to_delete" value="<?php echo $Dish['Dish_Name'] ?>"/>
            <input type="hidden" name="dining_hall_to_delete" value="<?php echo $Dish['DH_Name'] ?>"/>
        </form>
    </td>
  </tr>
  <?php endforeach; ?>
  </table>

  <script>
// JavaScript popup window function
	function basicPopup(url) {
popupWindow = window.open(url,'popUpWindow','height=300,width=700,left=50,top=50,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes')
$Ingredient_to_display = $_POST['ing'];
	}

</script>

</body> 
</html> 