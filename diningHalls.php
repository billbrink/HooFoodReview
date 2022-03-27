<!DOCTYPE html>
<html>
<html lang="en">
<link href="tab_styles.css" rel="stylesheet" />

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
<h1>O-Hill</h1>
<!-- <div class="row justify-content-center">   -->
<table class="w3-table w3-bordered w3-card-4" style="width:90%">
  <thead>
  <tr style="background-color:#B0B0B0">
    <th width="25%">Day of the Week</th>        
    <th width="25%">Open Time</th>        
    <th width="25%">Close Time</th> 
  </tr>
  </thead>

  <hr/>

  <h2>Newcomb</h2>
<!-- <div class="row justify-content-center">   -->
<table class="w3-table w3-bordered w3-card-4" style="width:90%">
  <thead>
  <tr style="background-color:#B0B0B0">
    <th width="25%">Day of the Week</th>        
    <th width="25%">Open Time</th>        
    <th width="25%">Close Time</th> 
  </tr>
  </thead>
  <hr/>

  <h3>Runk</h3>
<!-- <div class="row justify-content-center">   -->
<table class="w3-table w3-bordered w3-card-4" style="width:90%">
  <thead>
  <tr style="background-color:#B0B0B0">
    <th width="25%">Day of the Week</th>        
    <th width="25%">Open Time</th>        
    <th width="25%">Close Time</th> 
  </tr>
  </thead>
<hr/>

</body> 

</html> 