<div class= "container">
<div class= "row">
    <div class="col-md-5">
        <div class="panel panel-success paneltop">
            <div class="panel-heading">Anlagendaten<br /><h4 class="panel-title">short facts</h4>
            </div>
<div class="center-with-box"> <?php echo $anlagentypus;?> </div>
            <ul class="list-group">
                <li class="list-group-item"><i class="fa fa-building-o fa-fw" aria-hidden="true"></i>&nbsp;Identifikationsnummer:  <div class=pull-right>
                    <!-- Ausgabe und Prüfung AnlagenID Anfang -->
                    <?php
                    if ($anlagenID != NULL) {
                        echo $anlagenID;
                    } else {
                        echo 'NO DATA AVAILABLE';
                    }
                    ?> </div>
                </li>
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
                      <!-- Ausgabe und Prüfung Bezeichnung Anfang -->
                      <?php
                      if ($bezeichnung != NULL) {
                          echo $bezeichnung;
                      } else {
                          echo 'NO DATA AVAILABLE';
                      }
                      ?></div>
                      <!-- Ausgabe und Prüfung Bezeichnung Ende -->
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
                      if ($leistung != NULL) {
                          echo $leistung;
                      } else {
                          echo 'NO DATA AVAILABLE';
                      }
                      ?></div>
                      <!-- Prüfung und Ausgabe Kälteleistung ENDE -->
              </li>
              <li class="list-group-item"><i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i>&nbsp;Wartungsvertrag:<div class=pull-right>
                      <!-- Prüfung und Ausgabe Wartungsvertrag ANFANG -->
                      <?php
                      if ($maintenance_contract!= NULL) {
                          echo $maintenance_contract;
                      } else {
                          echo 'NO DATA AVAILABLE';
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
                          echo 'NO DATA AVAILABLE';
                      }
                      ?></div>
                      <!-- Prüfung und Ausgabe Letzte Wartung ENDE -->
              </li>
              <li class="list-group-item">---------:</li>
          </ul>
                        </div>
                    </div>
    <!-- Abfrage der HISTORIE zu der Anlage -->
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

 ?>
   </div>              </div>
                      </div>
                     </div>
                    </div>
/*
 * Copyright (C) Karsten Kluge
 * This file is part of {project}  *
 */

