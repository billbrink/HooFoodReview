<?php
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
    case '/':                   // URL (without file name) to a default screen
      require 'base.php';
      break; 
    case '/base.php':     // if you plan to also allow a URL with the file name 
      require 'base.php';
      break;              
    case '/diningHalls.php':
      require 'diningHalls.php';
      break;
    case '/dishes.php':
        require 'dishes.php';
        break;
   default:
      http_response_code(404);
      exit('Not Found');
}  
?>