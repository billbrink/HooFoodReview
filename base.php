<?php

$session_name = "login_sess";
session_name($session_name);
session_start();    // make sessions available

require('HooFoodReview_db.php');
//require('connect-db.php');

// client id: 741369040500-97fqjc6h24v7v04ibbgr0u38sk04r6nm.apps.googleusercontent.com
// client secret: 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

//set up our database connection for auth purposes

if (!isset($_SESSION['username1'])) {
   $username = 'login';
}
else {
   $username = $_SESSION['username1'];
}
$password = '';
$host = 'hoo-food-review:us-east4:hfr-db';
$dbname = 'HooFoodReview';
$dsn = "mysql:unix_socket=/cloudsql/hoo-food-review:us-east4:hfr-db;dbname=HooFoodReview";

try 
{
   $db = new PDO($dsn, $username, $password);
   
   // display a message to let us know that we are connected to the database 
}
catch (PDOException $e)     // handle a PDO exception (errors thrown by the PDO library)
{
   // Call a method from any object, use the object's name followed by -> and then method's name
   // All exception objects provide a getMessage() method that returns the error message 
   $error_message = $e->getMessage();        
   echo "<p>An error occurred while connecting to the database: $error_message </p>";
}
catch (Exception $e)       // handle any type of exception
{
   $error_message = $e->getMessage();
   echo "<p>Error message: $error_message </p>";
}


// $session_name = "login_sess";
// session_name($session_name);
// session_start();    // make sessions available
// // Session data are accessible from an implicit $_SESSION global array variable
// // after a call is made to the session_start() function.


// ?>




<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  
  <title>Hoo Food Review</title>    
</head>

<button class="tablink" onClick="location.href='diningHalls.php'" type="button">Dining Halls</button>
<button class="tablink" onClick="location.href='dishes.php'" type="button">Dishes</button>

<body>

  <div class="container">
    <h1>Hoo Food Review Login</h1>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
      Name: <input type="text" name="username" class="form-control" autofocus required /> <br/>
      Password: <input type="password" name="pwd" class="form-control" /> <br/>
      <input type="submit" value="Sign in" class="btn btn-light"  />   
    </form>
  </div>



<?php
// Define a function to handle failed validation attempts 
function reject($entry)
{
//    echo 'Please <a href="login.php">Log in </a>';
   exit();    // exit the current script, no value is returned
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && strlen($_POST['username']) > 0)
{
   $user = trim($_POST['username']);
   if (!ctype_alnum($user)) {  // ctype_alnum() check if the values contain only alphanumeric data
      reject('User Name');
   }
   if (isset($_POST['pwd']))
   {
      $pwd = trim($_POST['pwd']);
      if (!ctype_alnum($pwd)) {
         reject('Password');
      }
      else
      {
         foreach(getUsers() as $user_arr){
            if($user == $user_arr["user_computingID"]) {
               $hash_pwd = md5($pwd);
               if($hash_pwd == $user_arr["auth_string"]) {
                  $_SESSION['username1'] = $user;
                  // redirect the browser to another page using the header() function to specify the target URL
                  //header('Location: diningHalls.php/', TRUE, 301);
               }
            }
         }
         foreach(getAdmins() as $ad_arr){
            if($user == $ad_arr["admin_computingID"]) {
               $hash_pwd = md5($pwd);
               if($hash_pwd == $ad_arr["auth_string"]) {
                  $_SESSION['username1'] = $user;
                  // redirect the browser to another page using the header() function to specify the target URL
                  //header('Location: diningHalls.php/', true, 301);
               }
            }
         }
      }
   }
}

if(isset($_SESSION['username1'])) {
   echo("You are logged in as ");
   echo($_SESSION["username1"]); 

   <div class="container">
      <h1>Logout</h1>

  <form name="mainForm" action="dishes.php" method="post">

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
  </form>
  <hr/>

} else {
   echo("Please login");
}

?>


</body>
</html>
  