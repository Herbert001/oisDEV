<?php
session_start();
if (empty($_SESSION['usr_id'])) {
                       header("Location: index.php?uid=". $_SESSION['uids'] ."");
                       exit; 
                       }else
                           {
                            //echo "stringjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj";
                            //echo  var_dump ($_SESSION['uids']);
                            }
?>
<!doctype html>
<html>
    <head>
        <title> DeTec UnitDataInfoSystem ALPHA #0.7.2</title>
        <meta name= "viewport" content = "width=device-width, initial-scale=1.0">
        <link href = "inc/css/bootstrap.css" rel = "stylesheet">
        <link href = "inc/css/styles.css" rel = "stylesheet">
        <link href = "inc/css/font-awesome.min.css" rel="stylesheet" />
        <script src= "https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src ="inc/js/bootstrap.js"></script>
    </head>
<body>


<?php
  include 'header2.php';//require 'connectdb.php';Connect ist im header2.php
?>        
            
<div class="jumbotron text-left">
    <div class="container">
        <h1 class="mod1">
            <?php
            if (isset($_SESSION['uids'])) {
                 $_SESSION['uids'];
                 $_SESSION['usr_name'];
            } else {
                echo ("<h2 class=shadow> Es wurde keine Anlagennummer übergeben! <br><br><br><br></h2>");  
            ?>
<form class="form-horizontal" data-toggle="validator" role="form" id ="form" name="form" action="get_ident_nr.php" method="POST" >    
  <div class='form-group'>
    <label for='contact' class='col-sm-2 control-label'></label>
      <div class='col-sm-4'>
        <div class='input-group'>
        <div class='input-group-addon'>
          <i class='fa fa-barcode fa-fw' aria-hidden='true'></i>
        </div>
          <input type='text' class='form-control' name='identid' id='identnummer' placeholder='Ident ID' />
        </div>
      </div>
<button type="submit" name="submit" id="submit" class="btn btn-outline-primary">Give it to me</button>
  </div>
</form>
    </div> <?php } ?>                      
                                                                               <!-- Erkennung welcher Typ von Anlage! Kälte, Klima, Druckluft, etc.
                                                                                //Abfrage welche Spalte in unit_link_tab fuer die angegebene u_id
                                                                                ///belegt ist, damit die Ausgabe je nach unit angepasst werden kann. -->
<?php 
$query_check =("SELECT a.u_id, b.aircondition, b.aircompressor, b.chiller, b.airdryer 
                     FROM unit AS a                                             
                     LEFT JOIN unit_link_tab AS b
                     ON a.u_id = b.aircondition
                     OR a.u_id = b.aircompressor
                     OR a.u_id = b.chiller
                     OR a.u_id = b.airdryer
                     WHERE a.u_id = '" . $_SESSION['uids'] . "' ");             //Erkennung ENDE, sollte die u_id liefern
                                  
                                                                                // Abfrage Unit welcher Kunde START
$customer_unit =("SELECT a.u_id, a.ident_id, b.u_id, b.cs_id, c.cs_id, c.cs_customer_name, c.cs_street, c.cs_zip, d.ort
FROM unit a                                                                     
JOIN unit_link_customer b
ON a.u_id = b.u_id
JOIN customer c 
ON b.cs_id = c.cs_id
JOIN ort_plz d
ON c.cs_zip = d.Plz
WHERE a.u_id = '" . $_SESSION['uids'] . "' ");                                  // Abfrage ENDE
                                                
                                                                                // Abfrage Historie
$historie =("SELECT a.id, a.u_id, b.u_id, b.date_add, b.notes, b.name_short, d.cat_name
              FROM unit AS a 
              LEFT JOIN historie AS b
              ON a.u_id = b.u_id
              LEFT JOIN user AS c
              ON c.name_short = b.name_short
              LEFT JOIN category AS d
              ON b.category = d.catkey
              WHERE a.u_id = '" . $_SESSION['uids'] . "' ORDER BY b.date_add DESC LIMIT 2 ");
                                                                                // ENDE Historie


if ($result = $db->query($customer_unit)) {                 //Ausgabe Kundendaten
    if ($result->num_rows) {                                //Name, Adresse, Ort
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($rows as $row) {
            echo "<h2 class='idshadow'>". $row['cs_customer_name'] . "<br />" ;
            echo "<h4 class='idshadow'>". $row['cs_street'] . "<br />";
            echo "<h4 class='idshadow'>". $row['cs_zip']. "&nbsp" . $row['ort'] ;
            echo "<br />" . "<br />" . "<br /> </div>";
            echo "<div class = 'container text-left'>"; 
            echo "<div class='row'>";
            echo "<div class='col-md-4 col-xs-6'> <h4 class='idshadow'> Kundennummer:&nbsp" .$row['cs_id'] . "</div>";
            echo "<div class='col-md-4 col-xs-6'> <h4 class='idshadow pull-right'>Unitnummer: " . $_SESSION['uids']. "</div>";
            echo "<div class='col-md-4 col-xs-6'> <h4 class='idshadow pull-right'>IdentifikationsID: " . $row['ident_id']. "</div>";
            echo "</div> </div>";
}}}?> 
</div>    
    
<div class= "container">
<div class= "row">
    <div class="col-md-5">
        <div class="panel panel-success paneltop">
            <div class="panel-heading">Anlagendaten<br /><h4 class="panel-title">short facts</h4>
            </div>

            <ul class="list-group">
                <li class="list-group-item"><i class="fa fa-building-o fa-fw" aria-hidden="true"></i>&nbsp;Hersteller:<div class=pull-right> 
                        <!-- Ausgabe und Prüfung Hersteller Anfang -->
                        <?php
                        if ($row['name'] != NULL) {
                            echo $row['name'];
                        } else {
                            echo 'NO DATA AVAILABLE';
                        }
                        ?> </div>
                        <!-- Ausgabe und Prüfung Hersteller Ende -->
                </li>
                                            <li class="list-group-item"><i class="fa fa-wpforms fa-fw" aria-hidden="true"></i>&nbsp;Typ:<div class=pull-right>
                                                    <!-- Ausgabe und Prüfung Typ Anfang -->
                                                    <?php
                                                    if ($row['t_typ'] != NULL) {
                                                        echo $row['t_typ'];
                                                    } else {
                                                        echo 'NO DATA AVAILABLE';
                                                    }
                                                    ?></div>
                                                    <!-- Ausgabe und Prüfung Typ Ende -->
                                            </li>

                                            <li class="list-group-item"><i class="fa fa-hashtag fa-fw" aria-hidden="true"></i>&nbsp;Ser. Nr.:<div class=pull-right> 
                                                    <!-- Ausgabe und Prüfung Seriennummer Anfang -->
                                                    <?php
                                                    if ($row['u_serial'] != NULL) {
                                                        echo $row['u_serial'];
                                                    } else {
                                                        echo 'NO DATA AVAILABLE';
                                                    }
                                                    ?></div>
                                                    <!-- Ausgabe und Prüfung Seriennummer Ende -->
                                            </li>

                                            <li class="list-group-item"><i class="fa fa-calendar-o fa-fw" aria-hidden="true"></i>&nbsp;Baujahr:<div class=pull-right>
                                                    <!-- Ausgabe und Prüfung Baujahr Anfang -->
                                                    <?php
                                                    if ($row['u_year'] != NULL) {
                                                        echo $row['u_year'];
                                                    } else {
                                                        echo 'NO DATA AVAILABLE';
                                                    }
                                                    ?></div>
                                                    <!-- Ausgabe und Prüfung Baujahr Ende -->
                                            </li>
                                            <li class="list-group-item"><i class="fa fa-bitbucket fa-fw" aria-hidden="true"></i>&nbsp;Kältemittel:<div class=pull-right>
                                                    <!-- Ausgabe und Prüfung Kältemittelbezeichung Anfang -->
                                                    <?php
                                                    if ($row['fr_name'] != NULL) {
                                                        echo $row['fr_name'];
                                                    } else {
                                                        echo 'NO DATA AVAILABLE';
                                                    }
                                                    ?></div>
                                                    <!-- Ausgabe und Prüfung Kältemittelbezeichung Ende -->
                                            </li>
                                            <li class="list-group-item"><i class="fa fa-balance-scale fa-fw" aria-hidden="true"></i>&nbsp;Füllmenge:<div class=pull-right>
                                                    <!-- Prüfung und Ausgabe KM- Menge ANFANG -->
                                                    <?php
                                                    if ($row['u_fr_load'] != NULL) {
                                                        echo $row['u_fr_load'];
                                                    } else {
                                                        echo 'NO DATA AVAILABLE';
                                                    }
                                                    ?></div>
                                                    <!-- Prüfung und Ausgabe KM- Menge ENDE -->
                                            </li>
                                            <li class="list-group-item"><i class="fa fa-cogs fa-fw" aria-hidden="true"></i>&nbsp;Kälteleistung:<div class=pull-right> 
                                                    <!-- Prüfung und Ausgabe Kälteleistung ANFANG -->
                                                    <?php
                                                    if ($row['u_capacity'] != NULL) {
                                                        echo $row['u_capacity'];
                                                    } else {
                                                        echo 'NO DATA AVAILABLE';
                                                    }
                                                    ?></div>
                                                    <!-- Prüfung und Ausgabe Kälteleistung ENDE -->
                                            </li>
                                            <li class="list-group-item"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>&nbsp;VDKF:<div class=pull-right>
                                                    <!-- Prüfung und Ausgabe VDKF ANFANG -->
                                                    <?php
                                                    if ($row['u_vdkfnr'] != NULL) {
                                                        echo $row['u_vdkfnr'];
                                                    } else {
                                                        echo 'NO DATA AVAILABLE';
                                                    }
                                                    ?></div>
                                                    <!-- Prüfung und Ausgabe VDKF ENDE -->
                                            </li>
                                            <li class="list-group-item"><i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i>&nbsp;Wartungsvertrag:<div class=pull-right>
                                                    <!-- Prüfung und Ausgabe Wartungsvertrag ANFANG -->
                                                    <?php
                                                    if ($row['u_contract'] != NULL) {
                                                        echo $row['u_contract'];
                                                    } else {

                                                        echo "<span class='glyphicon glyphicon-remove'></span>";
                                                    }
                                                    ?></div>
                                                    <!-- Prüfung und Ausgabe Wartungsvertrag ENDE -->
                                            </li>
                                            <li class="list-group-item"><i class="fa fa-industry fa-fw" aria-hidden="true"></i>&nbsp;Letzte Wartung:<div class=pull-right>
                                                    <!-- Prüfung und Ausgabe Letzte Wartung ANFANG -->
                                                    <?php
                                                    if ($row['c_last_maintenance'] != NULL) {
                                                        echo $row['c_last_maintenance'];
                                                    } else {

                                                        echo "<span class='glyphicon glyphicon-remove'></span>";
                                                    }
                                                    ?></div>
                                                    <!-- Prüfung und Ausgabe Letzte Wartung ENDE -->
                                            </li>
                                            <li class="list-group-item">---------:</li>
                                        </ul>
                                    </div>
                                </div>
                                
                                                               

                                <div class="col-md-offset-1 col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Historie</div>
                                        <div class="panel-body panel-height">
<?php
 /***********************
 * Ausgabe der Einträge
 ***********************/
 
//Ermittelt die Anzahl der Beiträge
$result_c = $db->query("SELECT COUNT(*) FROM historie WHERE u_id = '" . $_SESSION['uids'] . "'");
$row = $result_c->fetch_row();
echo '#: ', $row[0]; 
 
//Berechne alles notwendige für die Blätterfunktion
$entrysPerPage = 3;                                                             // Artikel pro Seite
$pages = ceil($row[0]/$entrysPerPage);                                          // Berechne wieviel Seiten
echo $pages;                                                                    // Anzahl Seiten
                                                                                // Erste Seite
echo "<p><a href='./'>".'[Start]'."</a> ";
// For Schleife für Seitendurchlauf
for ($i = 1; $i <= $pages; $i++) {
    echo "<a href='?page=".$i."'>Seite ".$i."</a> ";
}
// Letzt Seite
echo "<a href='?page=$pages'>".'[Ende]'."</a></p>";

echo '</div>';

// Nach Anschluß alle Aufgaben, SQL Verbindung schließen
$db->close();

 ?></div>                                     </div>
                                </div>

                            </div>
                        </div>          

                       <?php include 'footer.php' ?>