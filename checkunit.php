<?php session_start();
$_sesuid = $_SESSION['uids'];
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
         <title> DeTec UnitDataInfoSystem ALPHA #0.7.2</title>
        <meta name= "viewport" content = "width=device-width, initial-scale=1.0">
        <link href = "inc/css/bootstrap.css" rel = "stylesheet">
        <link href = "inc/css/styles.css" rel = "stylesheet">
        <link href = "inc/css/font-awesome.min.css" rel="stylesheet" />
        <link href = "https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
        <link rel = "icon" href="/favicon.ico"/>
    </head>
        
    
    <body>
        <?php
        require 'header2.php';
        require 'connectdb.php';
        include 'func/anzeige_func.php';
        

    $query_check = ("SELECT a.u_id, b.aircondition, b.aircompressor, b.chiller, b.airdryer
                     FROM unit AS a
                     LEFT JOIN unit_link_tab AS b
                     ON a.u_id = b.aircondition OR a.u_id = b.aircompressor OR a.u_id = b.chiller OR a.u_id = b.airdryer
                     WHERE a.u_id = 4711");
        
        if ($result = $db->query($query_check)) {                               //Abfrage welche Spalte in unit_link_tab fuer die angegebene u_id
                        if ($result->num_rows) {                                //belegt ist, damit die Ausgabe je nach unit angepasst werden kann.
                            $rows = $result->fetch_all(MYSQLI_ASSOC);
                            foreach ($rows as $row) {
                            }     
                            }
                        }
                                                                                // Fallunterscheidung START
                        if ($row['aircondition'] > 0){
                            $query_a =  selectfunc_aircondition($_sesuid);      //SELECT erfolgt ueber function, query wird nach Fallunterscheidung
                             if ($result = $db->query($query_a))
                             {                                                  //angesprochen und ausgeführt
                                if ($result->num_rows)
                                {
                                $rows = $result->fetch_all(MYSQLI_ASSOC);
                                foreach ($rows as $row) 
                                {
                                echo "<br /> <br /> <br /> <br /> <br /> <br />";
                                echo $row['ac_ag_serial_nr'] . "<br />" ;
                                }
                                }   
                             }
                            echo "aircondition ist nicht 0";
                            }
                            else if($row['aircompressor'] > 0){
                                echo "aircompressor ist nicht 0";
                                }
                                elseif($row['chiller'] > 0){
                                    echo "chiller ist nicht 0";
                                    } 
                                    elseif($row['airdryer'] > 0){
                                    echo "airdryer ist nicht 0";
                                    } 
                                    else{
                                        echo "<script> alert('Abfrage führte zu keinem Datensatz');</script>";
                                        }
 ?>
    
    <script src = "https://code.jquery.com/jquery-1.9.1.js"></script>
    <script src ="inc/js/bootstrap.js"></script>

    
    </body>
</html>
