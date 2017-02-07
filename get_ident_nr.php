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
        <link href = "inc/css/font-awesome.min.css" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src ="inc/js/bootstrap.js"></script>
        <link href = "inc/css/styles3.css" rel = "stylesheet">



        
    </head>
<body>
<style type="text/css">
    #ausgabeText{display: none;}
</style>
<?php
include 'header2.php';
include 'inc/func/anzeige_func.php';
include 'inc/func/function.php';
  if(isset($_REQUEST['submit'], $_POST['identid']))                             // Abfrage ob Button gedrückt wurde und Variable vorhanden                         
  {
    $errorMessage = "<br>";
    $idnr=  clean($_POST['identid']);
    }else{
    echo "No way";
    exit;
  }
  if(empty($idnr))    
  { $error_no_id = "Es wurde keine ID eingegeben!" ;}
  else{
    // Abfrage der ID Nummer
    $id_ab = ("SELECT a.ident_id, a.u_id FROM unit a WHERE a.ident_id ='" . $idnr . "'");
    if ($result = $db->query($id_ab)) {                       //Abfrage ob ID existiert
      if ($result->num_rows) {                                //Wenn existiert dann holen
       $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($rows as $row) {
         $unit_num_id = intval($row['u_id']);                 // String in Zahl wandeln
        }}
        else{
        echo 'Diese ID ist nicht erfasst!';
        exit;
    }}
  ;}
 ?>       
<div class="jumbotron text-left">
  <div class="container">
  <h1 class="mod1">
      

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
                     WHERE a.u_id = '" . $unit_num_id . "' ");             //Erkennung ENDE, sollte die u_id liefern

if ($result = $db->query($query_check)) {                                   //Check ob Daten vorhanden
    if ($result->num_rows) {                                                //Wenn vorhanden
        $rows = $result->fetch_all(MYSQLI_ASSOC);                           //Daten holen
        foreach ($rows as $row) {                                           //Abfrage welche Spalte mit der ID gefüllt ist,
     if ($row['aircondition'] > NULL){                                      //wenn nicht NULL -> Abfrage und Ausgabe anpassen
  		$ac_query = 1;
	}else if($row['aircompressor'] > NULL){
  		$acr_query = 1;
	}else if ($row['chiller'] > NULL){
  		$ch_query = 1;
	}else if ($row['airdryer'] > NULL){
  		$ad_query = 1;
	}else {
  		$oth_query = 1;
}
}}};                     
get_unit_data_acr($unit_num_id);                                               //Funktion 2017010201 | hole Anlagendetails
customer_unit($unit_num_id);                                                  // Funktion 2017310101 | hole Kundendaten                                             
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


if ($result = $db->query($customer_unit)) {                                     //Abfrage Kundendaten
    if ($result->num_rows) {                                                    //Name, Adresse, Ort
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($rows as $row) {
          ?>
           <div class='row'>                                                   <!-- Ausgabe Kundenadresse Start -->
            <div class='col-md-3 col-xs-12'>
             <h4 class='idshadow'><?php echo $row['cs_customer_name']; ?><br />
             <h4 class='idshadow'><?php echo $row['cs_street']; ?><br />
             <h4 class='idshadow'><?php echo $row['cs_zip']. "&nbsp" . $row['ort'];             ?>
            </div>                                                              <!-- Ausgabe Kundenadresse Ende -->
            <div class ='col-md-offset-1 col-md-6 col-xs-offset-0 col-xs-12'>   <!-- Ausgabe Kontaktperson Start -->
             <div class='col-md-5 col-xs-12 pull-right' id='ausgabeText'>
             
                <h4 class='idshadow'><?php if (isset($row['Nachname']) ) {  echo "Ansprechpartner: ";}else{ echo "u";} ?><br /> 
                <h4 class='idshadow'><?php echo $row['Vorname']. " ". $row['Nachname']; ?><br />
                <?php istvorhd($row['Tel2']);
                 ?>
                    <h4 class='idshadow'><i class="fa fa-phone" aria-hidden="true"></i><?php echo " ".$row['Tel1']. "<br /><i class='fa fa-phone' aria-hidden='true'></i>" ." ". $row['Tel2']; ?><br />
                    <h4 class='idshadow'><i class="fa fa-at" aria-hidden="true"><?php echo " ".$row['Email']. "</i></h4>" ;?>
                                </div></div></div>
                    <div class = 'container text-left'>    
                        <div class='row' id='lowpadding'>
                            <div class='col-md-4 col-xs-6'> <h4 class='idshadow'> Kundennummer:&nbsp; <?php echo $row['cs_id'];?></h4></div>
                            <div class='col-md-4 col-xs-6'> <h4 class='idshadow' pull-right> Unitnummer:&nbsp; <?php echo $unit_num_id;?></h4></div>
                            <div class='col-md-4 col-xs-12'> <h4 class='idshadow' pull-right> IdentifikationsID:&nbsp; <?php echo $row['ident_id'];?></h4></div>
                        </div></div>
<?php
}
}else {echo "<h2 class='idshadow'>". $error_no_id. "<br />";}}

if ($result = $db->query($get_unit_data_acr)) {                                     //Abfrage Anlagendetails
    if ($result->num_rows >=1) {                                                    //Typ, Sernr etc
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($rows as $row){ 
   }}else{
echo "<h2 class='idshadow'>Fehler Datenbankabfrage <br />";}}
       

?>
</div>       
</div>
<script>
     $(function(){                                                              //SlideDown wenn Ansprechpartner vorhanden
        if($.trim($("#ausgabeText").html())==''){
         $("#ausgabeText").hide();
        }else { 
          $("#ausgabeText").slideDown(1200);
        }
        })
</script>   
<!-- **************************************************Ausgabe Anlagendaten *************************************** -->
<?php
if (!empty ($unit_num_id)){
  echo "Id  {$unit_num_id}  gesetzt Abfrage kann starten";
  
}else{
  echo " ID nicht gesetzt, Rest kann abgebrochen werden";
  exit;
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
                    if ($row['Hersteller'] != NULL) {
                        echo $row['Hersteller'];
                    } else {
                        echo 'NO DATA AVAILABLE';
                    }
                    ?> </div>
                    <!-- Ausgabe und Prüfung Hersteller Ende -->
            </li>
            <li class="list-group-item"><i class="fa fa-wpforms fa-fw" aria-hidden="true"></i>&nbsp;Typ:<div class=pull-right>
                    <!-- Ausgabe und Prüfung Typ Anfang -->
                    <?php
                    if ($row['Typ'] != NULL) {
                        echo $row['Typ'];
                    } else {
                        echo 'NO DATA AVAILABLE';
                    }
                    ?></div>
                    <!-- Ausgabe und Prüfung Typ Ende -->
            </li>

            <li class="list-group-item"><i class="fa fa-hashtag fa-fw" aria-hidden="true"></i>&nbsp;Ser. Nr.:<div class=pull-right> 
                    <!-- Ausgabe und Prüfung Seriennummer Anfang -->
                    <?php
                    if ($row['Seriennr'] != NULL) {
                        echo $row['Seriennr'];
                    } else {
                        echo 'NO DATA AVAILABLE';
                    }
                    ?></div>
                    <!-- Ausgabe und Prüfung Seriennummer Ende -->
            </li>

            <li class="list-group-item"><i class="fa fa-calendar-o fa-fw" aria-hidden="true"></i>&nbsp;Baujahr:<div class=pull-right>
                    <!-- Ausgabe und Prüfung Baujahr Anfang -->
                    <?php
                    if ($row['BJ'] != NULL) {
                        echo $row['BJ'];
                    } else {
                        echo 'NO DATA AVAILABLE';
                    }
                    ?></div>
                    <!-- Ausgabe und Prüfung Baujahr Ende -->
            </li>
            <li class="list-group-item"><i class="fa fa-bitbucket fa-fw" aria-hidden="true"></i>&nbsp;Kältemittel:<div class=pull-right>
                    <!-- Ausgabe und Prüfung Kältemittelbezeichung Anfang -->
                    <?php
                    if ($row['Frigen'] != NULL) {
                        echo $row['Frigen'];
                    } else {
                        echo 'NO DATA AVAILABLE';
                    }
                    ?></div>
                    <!-- Ausgabe und Prüfung Kältemittelbezeichung Ende -->
            </li>
            <li class="list-group-item"><i class="fa fa-balance-scale fa-fw" aria-hidden="true"></i>&nbsp;Füllmenge(kg):<div class=pull-right>
                    <!-- Prüfung und Ausgabe KM- Menge ANFANG -->
                    <?php
                    if ($row['Menge'] != NULL) {
                        echo $row['Menge'];
                    } else {
                        echo 'NO DATA AVAILABLE';
                    }
                    ?></div>
                    <!-- Prüfung und Ausgabe KM- Menge ENDE -->
            </li>
            <li class="list-group-item"><i class="fa fa-cogs fa-fw" aria-hidden="true"></i>&nbsp;Kälteleistung(kW):<div class=pull-right> 
                    <!-- Prüfung und Ausgabe Kälteleistung ANFANG -->
                    <?php
                    if ($row['Leistung'] != NULL) {
                        echo $row['Leistung'];
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
        
        <div class="panel-heading">Historie
        <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-tooltip="true" data-target="#modalstart" title="Neuer Eintrag" aria-label="NeuerEintrag">
      <i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>
    </button>
        </div>
        <div class="panel-body panel-height">
<?php
 /***********************
 * Ausgabe der Einträge
 ***********************/
$result_notes = ("SELECT * FROM historie WHERE u_id ='" . $unit_num_id . "'");
if ($result = $db->query($result_notes)){
  if ($result->num_rows){
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    foreach ($rows as $row){
      ?>
            
            <div class="col-md-6 notes_top clearfix"><h5> Eingetragen von: <?php  echo $row['name_short'];?> &nbsp;</h5></div>
            <div class="col-md-6 notes_top clearfix"><h5><?php echo $row['date_add'];?></h5> </div>
              <br /><br />
              <div class ="border_notes"><h5> <?php echo $row['notes']?></h5>
      <?php
    }
  }
}
//Ermittelt die Anzahl der Beiträge
$result_c = $db->query("SELECT COUNT(*) FROM historie WHERE u_id = '" . $unit_num_id . "'");
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

 ?>                                   </div>
    </div>                            </div>
    </div></div>
                          

<!-- +++++++++++++++++++++++++++Modal++++++++++++++++++++++ -->


<div class="modal fade" id="modalstart" tabindex="-1" role="dialog" aria-labelledby="meinModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="meinModalLabel">Neuen Eintrag hinzufügen</h3><br />
        <h5>Der Eintrag muss nach dem absenden noch vom Admin freigeschaltet werden!</h5>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
  
<form class="form-horizontal" data-toggle="validator" role="form" id ="form" name="form" action="send_formdata_neuerKunde2.php" method="POST" >
 
  <div class="form-group">
      <label for="kundnr" class="col-sm-2 control-label">Kundennummer
    <span class="asteriskField">*
    </span>
    </label>
    <div class="col-sm-10">
      <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-hashtag fa-fw"></i> 
       </div>  
        <input type="number" class="form-control" name="k_kdnr" id="kundnr" required="" data-required-error="Pflichtfeld" value="<?php echo $k_kdnr; ?>" autofocus="" placeholder="Kundennummer" />
      </div>



        </div>
      </div></form>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
        
      </div>
    </div>
  </div>
</div> </div></div>       

                       <?php include 'footer.php' ?>