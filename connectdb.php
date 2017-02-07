<?php 

error_reporting(1); //Fehler nicht anzeigen auf 0 setzen!

$db = new mysqli('127.0.0.1', 'root', 'klemens', 'ois');
if($db->connect_errno) {
    die('SoS, wir haben Probleme die Datenbank zu erreichen!' . $mysqli->connect_error);
}
$db->set_charset('utf8'); //Umlaute setzen
?>