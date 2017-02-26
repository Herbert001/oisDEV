<link href = "inc/css/styles3.css" rel = "stylesheet">
<link href = "inc/css/bootstrap.css" rel = "stylesheet">
<?php

/* 
 * Daten aus dem Wartungsformular MaintenanceAircondition.php
 * fuer Klimaanalgen in die Datenbank
 * einfügen und Meldung bei Erfolg ausgeben.
 */
include_once 'connectdb.php';
 
// Initiieren und deklarieren der Variablen aus dem Formular
$detecID        =   $db->real_escape_string($_POST['AnlageIDDetec']);           // AnlagenID von DeTec
$idKunde        =   $db->real_escape_string($_POST['IDKunde']);                 // AnlagenID vom Kunden
$filter         =   $db->real_escape_string($_POST['filter']);                  // Filter checkbox
$waermetauscher =   $db->real_escape_string($_POST['waermetauscher']);          // Waermetauscher checkbox
$temperatur     =   $db->real_escape_string($_POST['temperatur']);              // Temperatur checkbox
$strom          =   $db->real_escape_string($_POST['stromaufnahme']);           // Stromaufnahem checkbox
$abfluss        =   $db->real_escape_string($_POST['abfluss']);                 // Abfluss checkbox
$kondensatpumpe =   $db->real_escape_string($_POST['kondensatpumpe']);          // Pumpe checkbox
$funktion       =   $db->real_escape_string($_POST['funktion']);                // Funktion checkbox
$fernbedienung  =   $db->real_escape_string($_POST['fernbedienung']);           // Fernbedienung checkbox
$bemerkungen    =   htmlentities($_POST['bemerkungen']);                        // Textfeld Bemerkungen
echo $idKunde;
if(isset($_POST['submit']))  {                                                //Weiteres Ausfuehren nur wenn SUBMIT gedrueckt wurde

// Umwandeln der SELECT Boxen wenn nicht geklickt auf '0' und auf '1' wenn geklickt
if($filter==''){ $filter = '0';}else{ $filter ='1';}
if($waermetauscher==''){ $waermetauscher = '0';}else{ $waermetauscher ='1';}    
if($temperatur==''){ $temperatur = '0';}else{ $temperatur ='1';}    
if($stromaufnahme==''){ $stromaufnahme = '0';}else{ $stromaufnahme ='1';}    
if($abfluss==''){ $abfluss= '0';}else{ $abfluss ='1';}    
if($kondensatpumpe==''){ $kondensatpumpe = '0';}else{ $kondensatpumpe ='1';}    
if($funktion==''){ $funktion = '0';}else{ $funktion ='1';}    
if($fernbedienung ==''){ $fernbedienung  = '0';}else{ $fernbedienung  ='1';}    
        

//$query_insert ="UPDATE WMKlima SET (idKunde,filter,waermetauscher,temperatur,strom,abfluss,kondensatpumpe,funktion,fernbedienung,bemerkungen)
 //       VALUES ($kundeID, $filter,$waermetauscher,$temperatur,$stromaufnahme,$abfluss,$kondensatpumpe,$funktion,$fernbedienung,$bemerkungen
   //     WHERE id =' .$detecID.'";
// Update der ausgewählten Anlage 
$queryUpdate= "UPDATE WMKlima SET idKunde= '$idKunde', filter = '$filter', waermetauscher = '$waermetauscher', temperatur= '$temperatur',
         strom = '$strom', abfluss= '$abfluss', kondensatpumpe = '$kondensatpumpe', funktion= '$funktion', fernbedienung = '$fernbedienung',
         bemerkungen = '$bemerkungen' WHERE id = '$detecID'";
// Ausgabe fuer den Nutzer, war der Vorgang erfolgreich
if($ergebnis=$db->query($queryUpdate)){ echo "<div class='updatewartung'><br />\nAnzahl der veränderten Datensätze: "
    . "".$db->affected_rows ."</div>";}else{echo $mysqli->error;}
 // Ausgabe der aktuellen Daten 

$query_get = ('SELECT * FROM WMKlima WHERE id =' .$detecID.'');
$resultat = $db->query($query_get);
while($row=$resultat->fetch_array())   
echo "<div class='updatewartung ausgabe'>" .$row['bemerkungen'] ."<br />".$row['idKunde'] ."</div>";
echo "<div class='updatewartung ausgabe'><a href='javascript:history.back()' class='btn btn-primary' style='margin:16px'> " .'Back to the root(s)' ."</a></div>";

        
        
        






// Wenn die Seite nicht ueber Button aufgerufen wurde, Fehlermeldung ausgeben
}else{ echo "<div style='text-align: center; font-size:35px; background-color:"
    . " red; color: white; border: 2px; border-radius:3px; border-width: 3px;"
        . " border-style:solid;border-color: black;'>Aufruf der Seite ausserhalb normaler Parameter!";}
