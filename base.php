<?php 
    require('connect-db.php');
?>

<!DOCTYPE html>
<html>
<html lang="en">
<link href="tab_styles.css" rel="stylesheet" />

<!-- Please update doc name when we come up with something better than base -->

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Basic web app for interacting with Hoo Food Review">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Hoo Food Review</title>
</head> 

<!-- Tab stuff taken from https://www.w3schools.com/howto/howto_js_full_page_tabs.asp?msclkid=0750ebc7ae1311ec95c4ba22f2991121 -->

<button class="tablink" onClick="location.href='diningHalls.php'" type="button">Dining Halls</button>
<button class="tablink" onclick="location.href='dishes.php'" type="button">Dishes</button>

<div id="Dining Halls" class="tabcontent">
    <h3>Dining Halls</h3>
    <p>fill this in with dining hall tables</p>
</div>

<div id="Dishes" class="tabcontent">
    <h3>Dishes</h3>
    <p>fill this in with dishes tables</p>
</div>

<body>
</body> 
</html> 


