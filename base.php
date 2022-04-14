// client id: 741369040500-97fqjc6h24v7v04ibbgr0u38sk04r6nm.apps.googleusercontent.com
// client secret: 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


<?php

$username = 'no_privs';
$password = '';
$host = 'hoo-food-review:us-east4:hfr-db';
$dbname = '';
$dsn = "mysql:unix_socket=/cloudsql/hoo-food-review:us-east4:hfr-db;dbname=HooFoodReview";

?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  
  <title>Hoo Food Review</title>    
</head>

<body>

  <div class="container">
    <h1>Hoo Food Review Login</h1>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
      Name: <input type="text" name="username" class="form-control" autofocus required /> <br/>
      Password: <input type="password" name="pwd" class="form-control" required /> <br/>
      <input type="submit" value="Sign in" class="btn btn-light"  />   
    </form>
  </div>


<?php session_start();    // make sessions available
// Session data are accessible from an implicit $_SESSION global array variable
// after a call is made to the session_start() function.
?>

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
      echo ('user fail');
   }
   if (isset($_POST['pwd']))
   {
      $pwd = trim($_POST['pwd']);
      if (!ctype_alnum($pwd)) {
         reject('Password');
         echo ('pass fail');
      }
      else
      {
         // set session attributes
         $_SESSION['username'] = $user;
         
         $hash_pwd = md5($pwd);
//          $hash_pwd = password_hash($pwd, PASSWORD_DEFAULT);
//          $hash_pwd = password_hash($pwd, PASSWORD_BCRYPT);
         
         $_SESSION['pwd'] = $hash_pwd;
         
         // redirect the browser to another page using the header() function to specify the target URL
         header('Location: diningHalls.php');
      }
   }
}

?>


</body>
</html>
  