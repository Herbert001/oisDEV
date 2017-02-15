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
include 'inc/func/function.php';
?>

<div class="jumbotron text-left">
    <div class="container">
        <h1 class="mod1">
            <?php
            $errorMessage1 = "Variable gesetzt";
            if (isset($_SESSION['uids'])) {
                 $unit_id = $_SESSION['uids'];
                 $_SESSION['usr_name'];
            } else {
                echo ("<h2 class='shadow'> Es wurde keine Anlagennummer übergeben! <br><br><br><br></h2>");
                echo "<div id= 'errorhandler'>KLOKKKK</div>";


            ?>
<form class="form-horizontal" data-toggle="validator" role="form" id ="form" name="form" action="get_ident_nr.php" method="GET" >
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
    </div> <?php }



// Abfrage welche Identifikationsnummer(n) gehören zu der u_id Ausgabe im Jumbotron
$idsFromUnit = ("SELECT a.id, a.u_id, a.ident_id, a.typ_id
FROM unit a
WHERE a.u_id = '" . $_SESSION['uids'] . "' AND a.u_visible = 1");


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

customer_unit_ds($unit_id);
if ($result = $db->query($customer_unit_ds)) {                                  //Ausgabe Kundendaten im Jumbotron
    if ($result->num_rows) {                                                    //Name, Adresse, Ort
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
            echo "<div class='col-md-4 col-xs-6'> <h4 class='idshadow pull-right'>IdentifikationsID: " ."<br />";}
        }}

        if ($result = $db->query($idsFromUnit)) {
          if ($result->num_rows) {
          $rows = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row) {
            echo  "&nbsp <a href='/get_ident_nr.php?identid=" .$row['ident_id']."&submit=' >" .$row['ident_id']. "</a><br />";  //Ausgabe der IDs auf der rechten Seite im Jumbotron
            }}
}?>
</div><br />
</div> </div> </div>

</div>
<?php
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 Bestimmung was für ein Typ von Anlage und demnach Abfragequery und Ausgabe der Daten bestimmen
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */

switch ($row['typ_id']) {
    case 1:
        echo "i ist gleich Kälteanlage";
        break;
    case 2:
        echo "i ist Druckluftkompressor Schraube";
        break;
    case 3:
        echo "i ist Klimaanlage AG";
        break;
    case 4:
        echo "i ist Klimaanlage IG";
        break;
    case 5:
        echo "i ist Druckluftkompressor Hubkolben";
        break;
    case 6:
        echo "i ist Drucklufttrockner";
        break;
    case 7:
        echo "i ist Kaltwassersatz";
        // Abfrage Details wenn Chiller
        $get_chiller =("SELECT a.ident_id, a.lastService AS Wartung, b.uIdentId, c.c_typ_id, c.c_sernr AS Seriennummer, c.c_build_year AS Baujahr,
          c.c_vdkf AS VDKF, d.id, d.c_description AS
          Bezeichnung, d.c_manufactor_nr,
          d.c_fr_load AS FMenge, d.c_power AS KLeistung, e.name AS Hersteller, f.fr_name AS Frigen
        FROM unit a JOIN unit_link_tab b ON a.ident_id = b.uIdentId
        JOIN chiller c ON c.id = b.cIdentId
        JOIN chiller_typ d ON c.c_typ_id = d.id
        JOIN manufactor e ON d.c_manufactor_id = e.id
        JOIN frigen f ON d.c_fr_id = f.fr_id
        WHERE a.ident_id = 'WM-NI2-1004'");
        if ($result = $db->query($get_chiller)) {
          if ($result->num_rows) {
          $rows = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row) {
              $bezeichnung     = $row['Bezeichnung'];
              $hersteller     = $row['Hersteller'];
              $seriennr       = $row['Seriennummer'];
              $baujahr        = $row['Baujahr'];
              $frigen         = $row['Frigen'];
              $fuellmenge     = $row['FMenge'];
              $kaelteleistung = $row['KLeistung'];
              $lastmaintenance= $row['Wartung'];
              $vdkf           = $row['VDKF'];


        }}};
        break;
    case 5:
        echo "i ist Lüftungsanlage";
        break;
}


?>
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
                        if ($hersteller != NULL) {
                            echo $hersteller;
                        } else {
                            echo 'NO DATA AVAILABLE';
                        }
                        ?> </div>
                        <!-- Ausgabe und Prüfung Hersteller Ende -->
                </li>
                                            <li class="list-group-item"><i class="fa fa-wpforms fa-fw" aria-hidden="true"></i>&nbsp;Typ:<div class=pull-right>
                                                    <!-- Ausgabe und Prüfung Typ Anfang -->
                                                    <?php
                                                    if ($bezeichnung != NULL) {
                                                        echo $bezeichnung;
                                                    } else {
                                                        echo 'NO DATA AVAILABLE';
                                                    }
                                                    ?></div>
                                                    <!-- Ausgabe und Prüfung Typ Ende -->
                                            </li>

                                            <li class="list-group-item"><i class="fa fa-hashtag fa-fw" aria-hidden="true"></i>&nbsp;Ser. Nr.:<div class=pull-right>
                                                    <!-- Ausgabe und Prüfung Seriennummer Anfang -->
                                                    <?php
                                                    if ($seriennr != NULL) {
                                                        echo $seriennr;
                                                    } else {
                                                        echo 'NO DATA AVAILABLE';
                                                    }
                                                    ?></div>
                                                    <!-- Ausgabe und Prüfung Seriennummer Ende -->
                                            </li>

                                            <li class="list-group-item"><i class="fa fa-calendar-o fa-fw" aria-hidden="true"></i>&nbsp;Baujahr:<div class=pull-right>
                                                    <!-- Ausgabe und Prüfung Baujahr Anfang -->
                                                    <?php
                                                    if ($baujahr) {
                                                        echo $baujahr;
                                                    } else {
                                                        echo 'NO DATA AVAILABLE';
                                                    }
                                                    ?></div>
                                                    <!-- Ausgabe und Prüfung Baujahr Ende -->
                                            </li>
                                            <li class="list-group-item"><i class="fa fa-bitbucket fa-fw" aria-hidden="true"></i>&nbsp;Kältemittel:<div class=pull-right>
                                                    <!-- Ausgabe und Prüfung Kältemittelbezeichung Anfang -->
                                                    <?php
                                                    if ($frigen != NULL) {
                                                        echo $frigen;
                                                    } else {
                                                        echo 'NO DATA AVAILABLE';
                                                    }
                                                    ?></div>
                                                    <!-- Ausgabe und Prüfung Kältemittelbezeichung Ende -->
                                            </li>
                                            <li class="list-group-item"><i class="fa fa-balance-scale fa-fw" aria-hidden="true"></i>&nbsp;Füllmenge:<div class=pull-right>
                                                    <!-- Prüfung und Ausgabe KM- Menge ANFANG -->
                                                    <?php
                                                    if ($fuellmenge != NULL) {
                                                        echo $fuellmenge;
                                                    } else {
                                                        echo 'NO DATA AVAILABLE';
                                                    }
                                                    ?></div>
                                                    <!-- Prüfung und Ausgabe KM- Menge ENDE -->
                                            </li>
                                            <li class="list-group-item"><i class="fa fa-cogs fa-fw" aria-hidden="true"></i>&nbsp;Kälteleistung:<div class=pull-right>
                                                    <!-- Prüfung und Ausgabe Kälteleistung ANFANG -->
                                                    <?php
                                                    if ($kaelteleistung != NULL) {
                                                        echo $kaelteleistung;
                                                    } else {
                                                        echo 'NO DATA AVAILABLE';
                                                    }
                                                    ?></div>
                                                    <!-- Prüfung und Ausgabe Kälteleistung ENDE -->
                                            </li>
                                            <li class="list-group-item"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>&nbsp;VDKF:<div class=pull-right>
                                                    <!-- Prüfung und Ausgabe VDKF ANFANG -->
                                                    <?php
                                                    if ($vdkf != NULL) {
                                                        echo $vdkf;
                                                    } else {
                                                        echo 'NO DATA AVAILABLE';
                                                    }
                                                    ?></div>
                                                    <!-- Prüfung und Ausgabe VDKF ENDE -->
                                            </li>
                                            <li class="list-group-item"><i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i>&nbsp;Wartungsvertrag:<div class=pull-right>
                                                    <!-- Prüfung und Ausgabe Wartungsvertrag ANFANG -->
                                                    <?php
                                                    if ($lastmaintenance!= NULL) {
                                                        echo $lastmaintenance;
                                                    } else {

                                                        echo "<span class='glyphicon glyphicon-remove'></span>";
                                                    }
                                                    ?></div>
                                                    <!-- Prüfung und Ausgabe Wartungsvertrag ENDE -->
                                            </li>
                                            <li class="list-group-item"><i class="fa fa-industry fa-fw" aria-hidden="true"></i>&nbsp;Letzte Wartung:<div class=pull-right>
                                                    <!-- Prüfung und Ausgabe Letzte Wartung ANFANG -->
                                                    <?php
                                                    if ($lastmaintenance != NULL) {
                                                        echo $$lastmaintenance;
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