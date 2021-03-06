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



echo '</div>';

// Nach Anschluß alle Aufgaben, SQL Verbindung schließen
$db->close();

 ?></div>                                     </div>
                                </div>

                            </div>
                        </div>
/*
 * Copyright (C) Karsten Kluge
 * This file is part of {project}  *
 */

