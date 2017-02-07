<html>
    <head>
        <title>Formulartest</title>
    </head>
    <body>

<?php
require 'connectdb.php';
include 'inc/func/anzeige_func.php';
require 'inc/func/function.php';

if(isset($_REQUEST['submit']))
{
$errorMessage = "<br>";
    
$vorname=      clean($_POST['cp_first_name']);
$selectname=     clean($_POST['selectname']);
}
      else {
        echo Fehler;
      };
  echo $vorname ."<br />";    
  echo $selectname;
  
  ?>
      
  </body>
</html>