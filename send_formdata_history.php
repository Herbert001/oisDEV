<?php
session_start();

/*
 * Copyright (C) Karsten Kluge
 * This file is part of {project}  *
 */

require 'connectdb.php';
include 'func/anzeige_func.php';

// Variablen auslesen
$catkey       = htmlspecialchars($_POST['ocatkey']);
$anlageComment= htmlspecialchars($_POST['texta']);
$IdAnlage     = htmlspecialchars($_POST['AnlagenID']);
//echo htmlspecialchars($_SESSION['texthier']);
echo $IdAnlage;

// Prüfung, ob gesetzt und nicht leer
if(isset($_POST['submit']))
{
  if($catkey <=1 )
  {
    echo "Fehler! Bitte Kategorie auswählen!";
    // Fehler keine Kategorie ausgewählt!
    echo "<a href='##' onClick='history.go(-1); return false;'> Go back </a>";
  }
  elseif($anlageComment == "")
  {
    echo "Kein Text eingegeben, bitte ausfüllen!";
    // Fehler kein Text eingegeben!
    echo "<a href='##' onClick='history.go(-1); return false;'> Go back </a>";
  }
  else
  {
  echo "Alles ok, Eintrag kann erfolgen!";
  echo "<a href='##' onClick='history.go(-1); return false;'> Go back </a>";
  }
}














