<?php
namespace Phppot;
use \Phppot\DataSource;
require("DataSource.php")

?>

<?php session_start();    // make sessions available
// Session data are accessible from an implicit $_SESSION global array variable
// after a call is made to the session_start() function.
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  
  <title>Hoo Food Review</title>    
</head>

<form name="frmUser" method="post" action="">

	<div class="message"><?php if($message!="") { echo $message; } ?></div>
		<table border="0" cellpadding="10" cellspacing="1" width="500" align="center" class="tblLogin">
			<tr class="tableheader">
			<td align="center" colspan="2">Enter Login Details</td>
			</tr>
			<tr class="tablerow">
			<td>
			<input type="text" name="userName" placeholder="User Name" class="login-input"></td>
			</tr>
			<tr class="tablerow">
			<td>
			<input type="password" name="password" placeholder="Password" class="login-input"></td>
			</tr>
			<tr class="tableheader">
			<td align="center" colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
			</tr>
		</table>
</form>

<?php

$message = "";
if (count($_POST) > 0) {
    //echo "hi mom";
    $isSuccess = 0;
    require_once __DIR__ . '/DataSource.php';
    echo("hello");
    $db = new DataSource();
    echo("yoooo");
    $query = 'select * from user where User= ?';
    //echo "hi u";
    $paramType = 's';
    $paramValue = array(
        $_POST["userName"]
    );
    $result = $db->select($query, $paramType, $paramValue);
    echo("ligmaballz");

    if (! empty($result)) {
        echo "hi dad";
        $hashedPassword = $result[0]["password"];
        if (password_verify($_POST["password"], $hashedPassword)) {
            $isSuccess = 1;
        }
    }
    if ($isSuccess == 0) {
        $message = "Invalid Username or Password!";
    } else {
        header("Location:  ./dishes.php");
    }
}
?>