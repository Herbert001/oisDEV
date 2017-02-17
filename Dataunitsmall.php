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
        <link href = "inc/css/styles3.css" rel = "stylesheet">
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
    </div>
<?php }
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
// Abfrage welche Identifikationsnummer(n) gehören zu der u_id Ausgabe im Jumbotron
$idsFromUnit = ("SELECT a.id, a.u_id, a.ident_id AS ID, a.typ_id FROM unit a
WHERE a.u_id = '" . $_SESSION['uids'] . "' AND a.u_visible = 1");
if ($result = $db->query($idsFromUnit)) {
  if ($result->num_rows) {
  $rows = $result->fetch_all(MYSQLI_ASSOC);
    foreach ($rows as $row) {
      $anlagenID = $row['ID'];
      echo  "&nbsp <a class='linkjumbo' href='/get_ident_nr.php?identid=" .$row['ID']."&submit=' >" .$row['ID']. "</a><br />";  //Ausgabe der IDs auf der rechten Seite im Jumbotron
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
      $anlagentypus     = "Kälteanlage";                                           //Ausgabe im Panel unter shortfacts
      $refrigeration    = TRUE;
      $ausgabe_include  =  'ausgabe_refrigeration.php';
      $get_data ("SELECT a.ident_id, a.lastService AS Wartung,
        b.uIdentId, c.r_typ_id, c.r_sernr AS Seriennummer, c.r_build_year AS Baujahr,
        c.r_vdkf AS VDKF, d.id, d.r_description AS Bezeichnung, d.r_manufactor_nr,
        d.r_fr_load AS FMenge, d.r_power AS KLeistung, e.name AS Hersteller,
        f.fr_name AS Frigen
        FROM unit a JOIN unit_link_tab b ON a.ident_id = b.uIdentId
        JOIN refrigeration c ON c.id = b.rIdentId
        JOIN refrigeration_typ d ON c.r_typ_id = d.id
        JOIN manufactor e ON d.r_manufactor_id = e.id
        JOIN frigen f ON d.r_fr_id = f.fr_id
        WHERE a.ident_id = '" . $anlagenID . "'");

      if ($result = $db->query($get_data)) {
          if ($result->num_rows) {
          $rows = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row) {
              $bezeichnung    = $row['Bezeichnung'];
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

    case 2:
        $anlagentypus       = "Druckluftkompressor Schraube";                   //Ausgabe im Panel unter shortfacts
        $aircompressorscrew = TRUE;
        $ausgabe_include  =  'ausgabe_aircompressor_screw.php';
        $get_data =("SELECT a.ident_id, a.lastService AS Wartung, b.uIdentId,
          c.acp_id_typ, c.serialnr AS Seriennummer, a.contract_id,
          c.builddate AS Baujahr, d.id, d.acp_description AS Bezeichnung,
          d.acp_manufactor_nr,d.acp_fr_load AS FMenge, d.acp_power AS Leistung,
          e.name AS Hersteller, f.fr_name AS Frigen, g.contractNr AS Wartungsvertrag

       FROM unit a JOIN unit_link_tab b ON a.ident_id = b.uIdentId
        JOIN air_compressor c ON c.id = b.acIdentIdPistol OR b.acIdentIdScrew
        JOIN aircompressor_typ d ON c.acp_id_typ = d.id
        JOIN manufactor e ON d.acp_manufactor_id = e.id
        JOIN frigen f ON d.acp_fr_id = f.fr_id
        JOIN contract g ON a.contract_id = g.id
        WHERE a.ident_id = '" . $anlagenID . "'");

      if ($result = $db->query($get_data)) {
          if ($result->num_rows) {
          $rows = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row) {
              .$bezeichnung         = $row['Bezeichnung'];
              .$hersteller          = $row['Hersteller'];
              .$seriennr            = $row['Seriennummer'];
              .$baujahr             = $row['Baujahr'];
              .$frigen              = $row['Frigen'];
              .$fuellmenge          = $row['FMenge'];
              .$leistung            = $row['Leistung'];
              $lastmaintenance      = $row['Wartung'];
              $maintenance_contract = $row['Wartungsvertrag'];

      }}};
    break;


    case 3:
        $anlagentypus   = "Klimaanlage AG";                                     //Ausgabe im Panel unter shortfacts
        $airconditionag = TRUE;
        $get_data = ("SELECT a.ident_id, a.lastService AS Wartung, b.uIdentId,
          c.ac_ag_typ_id, c.ac_vdkf AS VDKF, c.ac_ag_serial_nr AS Seriennummer,
          c.ac_ag_build_year AS Baujahr, d.id, d.ac_ag_description AS
          Bezeichnung, d.ac_ag_manufactor_link_id , c.ac_ag_frigen_load AS FMenge,
          d.ac_ag_k_power AS KLeistung, e.name AS Hersteller, f.fr_name AS Frigen

       FROM unit a JOIN unit_link_tab b ON a.ident_id = b.uIdentId
        JOIN aircondition_ag c ON c.id = b.acIdentIdAG
        JOIN aircondition_typ_ag d ON c.ac_ag_typ_id = d.id
        JOIN manufactor e ON d.ac_ag_manufactor_link_id = e.id
        JOIN frigen f ON d.ac_ag_frigen_link = f.fr_id
        WHERE a.ident_id = '" . $anlagenID . "'");

        if ($result = $db->query($get_data)) {
          if ($result->num_rows) {
          $rows = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row) {
              $bezeichnung    = $row['Bezeichnung'];
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
    case 4:
        $anlagentypus   = "Klimaanlage IG";                                       //Ausgabe im Panel unter shortfacts
        $airconditionig = TRUE;
        // Frigen komplett aus der Abfrage genommen, da unerheblich fuer IG
        $get_data = ("SELECT a.ident_id, a.lastService AS Wartung, b.uIdentId,
          c.ac_ig_typ_id, c.ac_ig_serial_nr AS Seriennummer,
          c.ac_ig_build_year AS Baujahr, d.id, d.ac_ig_description AS
          Bezeichnung, d.ac_ig_manufactor_link_id , d.ac_ig_k_power AS KLeistung,
          e.name AS Hersteller

       FROM unit a JOIN unit_link_tab b ON a.ident_id = b.uIdentId
        JOIN aircondition_ig c ON c.id = b.acIdentIdIG
        JOIN aircondition_typ_ig d ON c.ac_ig_typ_id = d.id
        JOIN manufactor e ON d.ac_ig_manufactor_link_id = e.id
        WHERE a.ident_id = '" . $anlagenID . "'");

        if ($result = $db->query($get_data)) {
          if ($result->num_rows) {
          $rows = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row) {
              $bezeichnung    = $row['Bezeichnung'];
              $hersteller     = $row['Hersteller'];
              $seriennr       = $row['Seriennummer'];
              $baujahr        = $row['Baujahr'];
              $kaelteleistung = $row['KLeistung'];
              $lastmaintenance= $row['Wartung'];
        }}};
    break;
    case 5:
        $anlagentypus         = "Druckluftkompressor Hubkolben";                //Ausgabe im Panel unter shortfacts
        $aircompressorpistol  = TRUE;
        // -- Folgend Gleiche Abfrage wie beim Hubkolben -- kann später modifiziert werden wenn nötig
        $get_data =("SELECT a.ident_id, a.lastService AS Wartung, b.uIdentId,
          c.acp_id_typ, c.serialnr AS Seriennummer,
          c.builddate AS Baujahr, d.id, d.acp_description AS Bezeichnung,
          d.acp_manufactor_nr,d.acp_fr_load AS FMenge, d.acp_power AS KLeistung,
          e.name AS Hersteller, f.fr_name AS Frigen

       FROM unit a JOIN unit_link_tab b ON a.ident_id = b.uIdentId
       JOIN air_compressor c ON c.id = b.acIdentIdPistol OR b.acIdentIdScrew
       JOIN aircompressor_typ d ON c.acp_id_typ = d.id
       JOIN manufactor e ON d.acp_manufactor_id = e.id
       JOIN frigen f ON d.acp_fr_id = f.fr_id
       WHERE a.ident_id = '" . $anlagenID . "'");

        if ($result = $db->query($get_data)) {
          if ($result->num_rows) {
          $rows = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row) {
              $bezeichnung    = $row['Bezeichnung'];
              $hersteller     = $row['Hersteller'];
              $seriennr       = $row['Seriennummer'];
              $baujahr        = $row['Baujahr'];
              $frigen         = $row['Frigen'];
              $fuellmenge     = $row['FMenge'];
              $leistung       = $row['Leistung'];
              $lastmaintenance= $row['Wartung'];

        }}};
    break;
    case 6:
        $anlagentypus = "Drucklufttrockner";                                    //Ausgabe im Panel unter shortfacts
        $airdryer     = TRUE;
        $get_data = ("SELECT a.ident_id, a.lastService AS Wartung, b.uIdentId,
          c.ad_typ_id, c.ad_sernr AS Seriennummer,c.ad_build_year AS Baujahr,
          c.ad_vdkf AS VDKF, d.id, d.ad_description AS Bezeichnung,
          d.ad_manufactor_nr , d.ad_fr_load AS FMenge, d.ad_power AS KLeistung,
          e.name AS Hersteller, f.fr_name AS Frigen

       FROM unit a JOIN unit_link_tab b ON a.ident_id = b.uIdentId
        JOIN airdryer c ON c.id = b.dIdentId
        JOIN airdryer_typ d ON c.ad_typ_id = d.id
        JOIN manufactor e ON d.ad_manufactor_id = e.id
        JOIN frigen f ON d.ad_fr_id = f.fr_id
        WHERE a.ident_id = '" . $anlagenID . "'");

         if ($result = $db->query($get_data)) {
          if ($result->num_rows) {
          $rows = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row) {
              $bezeichnung    = $row['Bezeichnung'];
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
    case 7:
      $chiller        = TRUE;
      $anlagentypus   = "Kaltwassersatz";                                         //Ausgabe im Panel unter shortfacts
      $ausgabe_include=  'ausgabe_chiller.php';
        // Abfrage Details wenn Chiller
        $get_data =("SELECT a.ident_id, a.lastService AS Wartung, b.uIdentId,
          c.c_typ_id, c.c_sernr AS Seriennummer, c.c_build_year AS Baujahr,
          c.c_vdkf AS VDKF, d.id, d.c_description AS Bezeichnung, d.c_manufactor_nr,
          d.c_fr_load AS FMenge, d.c_power AS KLeistung, e.name AS Hersteller,
          f.fr_name AS Frigen

        FROM unit a JOIN unit_link_tab b ON a.ident_id = b.uIdentId
        JOIN chiller c ON c.id = b.cIdentId
        JOIN chiller_typ d ON c.c_typ_id = d.id
        JOIN manufactor e ON d.c_manufactor_id = e.id
        JOIN frigen f ON d.c_fr_id = f.fr_id
        WHERE a.ident_id = '" . $anlagenID . "'");

        if ($result = $db->query($get_data)) {
          if ($result->num_rows) {
          $rows = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row) {
              $bezeichnung    = $row['Bezeichnung'];
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
    case 8:
        $anlagentypus = "Lüftungsanlage";                                       //Ausgabe im Panel unter shortfacts
        $ventilation  = TRUE;
        $get_data = ("SELECT a.ident_id, a.lastService AS Wartung, b.uIdentId,
          c.v_typ_id, c.v_sernr AS Seriennummer, c.v_build_year AS Baujahr,
          d.id, d.v_description AS Bezeichnung, d.ad_manufactor_id ,
          d.v_power AS KLeistung, e.name AS Hersteller

       FROM unit a JOIN unit_link_tab b ON a.ident_id = b.uIdentId
       JOIN ventilation c ON c.id = b.vIdentId
       JOIN ventilation_typ d ON c.v_typ_id = d.id
       JOIN manufactor e ON d.ad_manufactor_id = e.id
       WHERE a.ident_id = '" . $anlagenID . "'");

         if ($result = $db->query($get_data)) {
          if ($result->num_rows) {
          $rows = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row) {
              $bezeichnung    = $row['Bezeichnung'];
              $hersteller     = $row['Hersteller'];
              $seriennr       = $row['Seriennummer'];
              $baujahr        = $row['Baujahr'];
              $leistung      = $row['Leistung'];
              $lastmaintenance= $row['Wartung'];

        }}};
        break;

    case 9:
        $anlagentypus = "Sonstige";                                              //Ausgabe im Panel unter shortfacts
        $mixed        = TRUE;
        $get_data = ("SELECT a.ident_id, a.lastService AS Wartung, b.uIdentId,
          c.id, c.m_ser_nr AS Seriennummer, c.m_build_year AS Baujahr,
          c.m_description AS Bezeichnung, d.id, d.name AS Hersteller,
          d.id , c.m_power AS Leistung

       FROM unit a JOIN unit_link_tab b ON a.ident_id = b.uIdentId
       JOIN mixed c ON c.id = b.mIdentId
       JOIN manufactor d ON c.m_manufactor_link = d.id
       JOIN frigen e ON c.m_fr_link = e.fr_id
       WHERE a.ident_id = '" . $anlagenID . "'");
    break;
}



          include $ausgabe_include;                                             // Panel links mit Daten aus Abfrage $get_data
          include 'footer.php'                                                  // include per case noch unterscheiden
?>

