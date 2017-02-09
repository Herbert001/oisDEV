<?php
session_start();
if (empty($_SESSION['usr_id'])) {
header("Location: index.php?uid=" . $_SESSION['uids'] . "");
exit;
} else {
//echo "stringjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj";
//echo  var_dump ($_SESSION['uids']);
}
?>
<!DOCTYPE html>
<!--
Copyright (C) Karsten Kluge
This file is part of {project}
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>DeTec UnitDataInfoSystem ALPHA #0.7.2</title>
        <meta name= "viewport" content = "width=device-width, initial-scale=1.0">
        <link href = "inc/css/bootstrap.css" rel = "stylesheet">
        <link href = "inc/css/styles.css" rel = "stylesheet">
        <link href = "inc/css/font-awesome.min.css" rel="stylesheet" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="inc/js/jquery-ui.min.js"></script>
    </head>
    <body>
<?php
include 'connectdb.php';
include 'inc/func/anzeige_func.php';
include 'inc/func/function.php';
include 'header2.php';
$shorturl = htmlentities($_SERVER['PHP_SELF']);

if (isset($_REQUEST['submit'])) {                                               //Abfrage wenn SUBMIT Prüfung abgeschickt wurde
$form_id      = clean($_POST['uid_form']);
$name_company = $_POST['k_name_company'];
$cat_id       = multiexplode(array("."), clean($_POST['select_case']));         // Aus Abfrage, die ID und Kategorie liefert, die ID separieren
$kd_nr_ex     = multiexplode(array("|"), $_POST['selectname']);                 //Aus Abfrage, die KD Nr. und Namen liefert, die KD Nr. separieren
$errorMessage2= "";                                                             //Variablen nullen
$errorMessage = "";
echo ($cat_id[1]);                                                              // TEST MUSS ENTFERNT WERDEN
var_dump($form_id);
  if (!isset($form_id) OR empty($form_id) OR empty($cat_id)) {
  $errorMessage2 = "Bitte Kategorie auswählen!";                                // Link zurück noch einfügen
  }else{
    $result = $db->query("SELECT ident_id FROM unit WHERE ident_id = '$form_id' "); // Zusätzliche Abfrage ob ID schon vorhanden
          if ($result->num_rows > 0) {                                              // per PHP wenn JQuery nicht aktiviert
            $errorMessage = "Diese ID ist schon vergeben !";
            echo "<p></P><div id='testcolor'> .$errorMessage. </div>";                                                 // Link zurück noch einfügen
            $ausgabe = $result->num_rows;
            echo "<p></P><div id='testcolor'> .$ausgabe. </div>";
          }else{
            echo '<p></p>< br/><p></p>';
            include 'aircondition_form.php';                                       //Ausgabe der übermittelten Variablen und
            $errorMessage = "";                                                 //anzeigen des weiteren Formulares
          }
$result->close();
       }

}
?>






        </body>
        </html>
