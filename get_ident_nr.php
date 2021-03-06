<?php
session_start();
if (empty($_SESSION['usr_id'])) {
   header("Location: index.php?uid=". $_SESSION['uids'] ."");
   exit;
   }else{
     echo " Sie sind mit der SessionID " . session_id() ." angemeldet!";
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

  if(isset($_REQUEST['submit'], $_GET['identid']))                             // Abfrage ob Button gedrückt wurde und Variable vorhanden
  {
    $errorMessage = "<br>";
    $idnr=  clean($_GET['identid']);
                                                                                 //  $idnr = Übermittelte Anlagenbezeichnung aus Dataunitsmall.php
    }else{                                                                      // wenn nach Anlagen gesucht wird.
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


<?php
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

get_unit_data_acr($unit_num_id);                                               //Funktion 2017010201 | hole Anlagendetails
customer_unit($unit_num_id);                                                  // Funktion 2017310101 | hole Kundendaten
if ($result = $db->query($customer_unit)) {                                     //Abfrage Kundendaten
    if ($result->num_rows) {                                                    //Name, Adresse, Ort
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($rows as $row) {
          ?>
           <div class='row'>                                                   <!-- Ausgabe Kundenadresse Start -->
            <div class='col-md-4 col-xs-12'>
             <h2 class='idshadow'><?php echo $row['cs_customer_name']; ?><br />
             <h4 class='idshadow'><?php echo $row['cs_street']; ?><br />
             <h4 class='idshadow'><?php echo $row['cs_zip']. "&nbsp" . $row['ort'];             ?>
            </div>                                                              <!-- Ausgabe Kundenadresse Ende -->
                <!-- Ausgabe Kontaktperson Start -->
             <div class='col-md-4 col-xs-12 pull-right' id='ausgabeText'>

                <h4 class='idshadow'><?php if (isset($row['Nachname']) ) {  echo "Ansprechpartner: ";} ?><br />
                <h4 class='idshadow in'><?php echo $row['Vorname']. " ". $row['Nachname']; ?><br />
  <?php // Abfrage ob Ansprechpartner vorhanden ,dann erst Ausgabe.

  if (!is_null($row['Tel1'])){ ?> <h4 class='idshadow in'><i class='fa fa-phone' aria-hidden='true'></i><?php echo " ".$row['Tel1'] . "<br />";}
  if (!is_null($row['Tel2'])){ ?> <h4 class='idshadow in'><i class='fa fa-phone' aria-hidden='true'></i><?php echo " ".$row['Tel2'] . "<br />";}
  if (!is_null($row['Email'])){ ?> <h4 class='idshadow in' aria-hidden='true'><?php echo " ".$row['Email'] . "<br />";}
  ?>
      </div></div></div>

  <?php                                                 // Setzen der Variablen zur späteren Verwendung

}}else {echo "<h2 class='idshadow'>". $error_no_id. "<br />";}}

                                  // Abfrage, Ausgabe wieviele Anlagen sind unter der u_id angelegt -->
                     //get_units($unit_num_id);
$units = ("SELECT a.ident_id, a.u_id FROM unit a WHERE a.u_id = '" . $unit_num_id . "'");
 ?>
                   <div class = 'container text-left'>
                        <div class='row' id='lowpadding'>
                            <div class='col-md-4 col-xs-6'> <h4 class='idshadow pull-left'>Kundennummer:&nbsp; <?php echo $row['cs_id'];?></h4></div>
                            <div class='col-md-4 col-xs-6'> <h4 class='idshadow pull-left'>Unitnummer:&nbsp; <?php echo $unit_num_id;?></h4></div>
                            <div class='col-md-4 col-xs-12'> <h4 class='idshadow pull-left'>IdentifikationsID:&nbsp <br />
<?php                   if ($result = $db->query($units)) {                      //Abfrage wieviele Units sind unter der u_id gespeichert
                          if ($result->num_rows) {
                          $rows = $result->fetch_all(MYSQLI_BOTH);
                           foreach ($rows as $row) {                           // Ausgabe units in Schleife da mehrere vorhanden sein können
                             echo "<a class='btn btn-default mine' href='/get_ident_nr.php?identid=" .$row['0'] ."&submit='>" .$row['0']."</a><br />";
                           }}else { echo "Keine Daten";}}
                                    echo "</div></div></div>";

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
$queryAnlagentyp = ("SELECT ident_id, typ_id, typ_auswahl FROM `unit`
JOIN unittypen b ON typ_id = b.id WHERE ident_id = '" . $idnr . "'");           // Abfrage welcher Typ ist die Anlage Kompressor, Klima...
if ($result = $db->query($queryAnlagentyp)) {                                     //Abfrage Anlagendetails
    if ($result->num_rows) {                                                    //Typ, Sernr etc
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($rows as $row){
?>
<div class= "container">
<div class= "row">
<div class="col-md-5">
   <div class="panel panel-success paneltop">
     <div class="panel-heading">Anlagendaten<br /><h4 class="panel-title">short facts</h4>
     </div>
    <div class="center-with-box"> <?php echo $row['typ_auswahl'];}}}?> </div>
        <ul class="list-group">
            <li class="list-group-item"><i class="fa fa-building-o fa-fw" aria-hidden="true"></i>&nbsp;Identifikationsnummer:  <div class=pull-right>
                    <!-- Ausgabe und Prüfung Hersteller Anfang -->
                    <?php
                    if ($idnr != NULL) {
                        echo $idnr;
                    } else {
                        echo 'NO DATA AVAILABLE';
                    }
                    ?> </div>
                    <!-- Ausgabe und Prüfung Hersteller Ende -->
            </li>
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


// Nach Anschluß alle Aufgaben, SQL Verbindung schließen
//$db->close();

 ?>                                   </div>
    </div>
              <!-- +++++++++++++++++++++++++++START FORM ADD NEW TEXT++++++++++++++++++++++ -->
            <div class="panel panel-default">
                <div class="panel panel-heading">Neuer Eintrag</div>
                    <div class="panel panel-info text-primary text-center">Anlage <?php echo $idnr; ?></div>
                        <div class="panel panel-body">
<form class="form-horizontal" data-toggle="validator" role="form" id ="form" name="form" action="send_formdata_history.php" method="POST" >
  <div class="form-group">
      <label for="kundnr" class="col-sm-2 control-label">Kategorie </label>
    <div class="col-sm-10">
      <div class="input-group">
       <select type="text" class="form-control" name="ocatkey" id="cat"  autofocus="" />
<?php
// +++++++++++++++++++++ Abfrage SELECT Kategorie hinzufügen von Eintrag +++++++++++++++++++++++++++
        $getCat = ("SELECT * FROM category_history");
        if ($result_cat = $db->query($getCat)) {
          if ($result_cat->num_rows) {
            $rows = $result_cat->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row){
              echo '<option value="'.$row['catkey'].' "> '.$row['cat_name'] .'</option>';
            }}}
?>
       </select>
          <textarea rows="15" form="form" class="form-control" id="texta" name="texta"><?PHP if(!empty(htmlspecialchars($_SESSION['texthier']))){ echo $_SESSION['texthier'];}?> </textarea>
          <input type="hidden" value="<?php echo $idnr; ?>" name="AnlagenID"></input>
    </div>  </div>
    </div> </div>
                    <button type="submit" name="submit" id="submit" class="btn pull-right btn-primary" onclick=" <?php delSesVar(); ?>">Give it to me</button><br /><br />
                    <p> </p>
            </div>
              <!-- +++++++++++++++++++++++++++FORM END ADD NEW TEXT++++++++++++++++++++++ -->


    </div></div>
    </div></div>





  </div>
</div> </div></div>

                       <?php include 'footer.php' ?>