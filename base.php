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
   $_SESSION['isAdmin'] = FALSE;
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
                  $_SESSION['isAdmin'] = FALSE;
                  // redirect the browser to another page using the header() function to specify the target URL
               }
            }
         }
         foreach(getAdmins() as $ad_arr){
            if($user == $ad_arr["admin_computingID"]) {
               $hash_pwd = md5($pwd);
               if($hash_pwd == $ad_arr["auth_string"]) {
                  $_SESSION['username1'] = $user;
                  $_SESSION['isAdmin'] = TRUE;
                  // redirect the browser to another page using the header() function to specify the target URL
               }
            }
         }
      }
      if(isset($_SESSION['username1'])) {
         echo("You are logged in as ");
         echo($_SESSION["username1"]); 
         header('Location: base.php');
         exit;
      } else {
         echo("Please login");
         header('Location: base.php');
         exit;
      }
   }
}
?>


</body>
</html> 