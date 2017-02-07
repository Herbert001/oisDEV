<!DOCTYPE html>
<!--
Copyright (C) Karsten Kluge 
This file is part of {project} 
-->
<html>
    <head>
       <title> DeTec UnitDataInfoSystem ALPHA #0.7.2</title>
        <meta name= "viewport" content = "width=device-width, initial-scale=1.0">
        <link href = "../inc/css/bootstrap.css" rel = "stylesheet">
        <link href = "../inc/css/styles.css" rel = "stylesheet">
        <link href = "../inc/css/font-awesome.min.css" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src ="../inc/js/bootstrap.js"></script>
    </head>
    <body>
        <?php
        if ($_GET["desc"] == 1) 
        {
        echo 'fetter teststring';
        $sort = 'DESC';
        }
        else
        {
        echo ' ISt nicht gesetzt';
        $sort = 'ASC';
        }
 
        require_once '../connectdb.php';
        //include '../header2.php';
        echo 'Test';
                                                                                //Aufruf alle Kunden
        $customer =("   SELECT cs_customer_name, cs_id
                        FROM customer
                        ORDER BY cs_id $sort
                        LIMIT 160");
      $result = $db->query($customer);
             
            echo '<table border="1">';
            echo '<tr><td><a href="Kundenausgabe.php?desc=1">Name:</td>';
            echo "<td><a href='Kundenausgabe.php?desc=2'>KD-Nummer:</a></td></tr>";
while ($zeile = mysqli_fetch_array($result))
{
  echo "<tr>";
  echo "<td>". $zeile['cs_customer_name'] . "</td>";
  echo "<td>". $zeile['cs_id'] . "</td>";
  echo "</tr>";
}
echo "</table>";
        
//Ausgabe Kundendaten
    
//            if ($result->num_rows)
//            {                                                                  //Name, Adresse, Ort
//            $rows = $result->fetch_all(MYSQLI_ASSOC);
                                                 // -- Table -->
    
//            echo "<h5 class='idshadow'>". $row['cs_customer_name'] . "<br />" ;
//            echo "<h5 class='idshadow'>". $row['cs_id'] . "<br />" ;
//  
    
       ?>
    
        
        
    </body>
</html>
