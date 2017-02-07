<?php

require 'connectdb.php';

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <!-- Bootstrap and Fontawesome, CSS-->
    <link href="inc/css/bootstrap.min.css" rel="stylesheet">
    <link href = "inc/css/styles.css" rel = "stylesheet">
    <link href = "inc/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    
   <?php
   $idnr = "WM-NI2-1004";
   $id_ab = ("SELECT a.ident_id FROM unit a WHERE a.ident_id =.{$idnr}");
    var_dump ($id_ab);
    if ($resultat = $db->query("SELECT a.ident_id FROM unit a WHERE a.ident_id = '" . $idnr . "'")) {
  // Antwort der Datenbank in ein Objekt übergeben und
  // mithilfe der while-Schleife durchlaufen
      //var_dump($resultat);
  while($daten = $resultat->fetch_object() ){
    echo "ID: ". $daten->ident_id;
    //echo "Name der Stadt: " . $daten->name;
    } } ;
    
    
    
    
    
    
    
                        ?>
    
</body>
   
   
   
   
   
   

 