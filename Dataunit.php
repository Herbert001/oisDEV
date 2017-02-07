<?php 
session_start();
$unit_a = $_SESSION['unit_a'];
echo $unit_a;
?>



<html>
    <head>
        <title> DeTec UnitDataInfoSystem ALPHA #0.7.2</title>
        <meta name= "viewport" content = "width=device-width, initial-scale=1.0">
        <link href = "css/bootstrap.css" rel = "stylesheet">
        <link href = "inc/css/styles.css" rel = "stylesheet">
        <link href = "css/font-awesome.min.css" rel="stylesheet" />
    </head>
    <body>
    

    <?php require 'header1.php';
            require 'connectdb.php';
    ?>    
        <div class="jumbotron text-left">
            <div class="container">
  <h1 class="mod1">
<?php
     //if(!isset  ($unit_a)) {
            //die("Es wurde keine Anlagennummer übergeben!");
           // echo $unit_a;
     // } ;
     $q_kunde_unit = ("SELECT tab_unit.u_id, tab1_kunde_unit_link.k_id, tab1_kunde_unit_link.u_id, tab1_kunde.k_name_company, tab1_kunde.k_street, tab1_kunde.k_plz_id, tab1_plzort.Ort, tab_unit.k_interne_id, tab_unit.u_serial, tab_typ.t_typ, tab_unit.u_year, tab_unit.u_voltage, tab_frigen.fr_name, tab_unit.u_fr_load, tab_unit.u_capacity, tab2_manufactor.m_name, tab_unit.u_vdkfnr, tab_unit.u_contract, tab_unit.u_current, tab_contract.c_last_maintenance
              FROM tab_unit
              JOIN tab1_kunde_unit_link
              ON tab_unit.u_id = tab1_kunde_unit_link.u_id
              JOIN tab1_kunde
              ON tab1_kunde_unit_link.k_id = tab1_kunde.k_id
              JOIN tab1_plzort
              ON tab1_kunde.k_plz_id = tab1_plzort.Plz
              JOIN tab_typ
              ON tab_unit.t_id = tab_typ.t_id
              JOIN tab_frigen
              ON tab_unit.fr_id = tab_frigen.fr_id
              LEFT JOIN tab2_manufactor_typ_link
              ON tab_unit.t_id = tab2_manufactor_typ_link.t_id
              LEFT JOIN tab2_manufactor
              ON tab2_manufactor_typ_link.m_id = tab2_manufactor.m_id
              LEFT JOIN tab_contract
              ON tab_unit.u_contract = tab_contract.c_contract
              WHERE tab_unit.u_id = $unit_a");
        

        if($result = $db->query($q_kunde_unit ))
            if($result->num_rows)
        {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach($rows as $row)
          {
            echo $row['k_name_company'];
            echo " </h1><p></p>";
            //Auswahl der Firma über GET Parameter vom Browser gesendet
            echo "<h2 class='idshadow'>";
            //<!-- Ausgabe Strasse und PLZ, Ort -->
            echo $row['k_street']."<br />";
            echo $row['k_plz_id']." ".$row['Ort']."<br /></h2><p></p><br /><br />";
          
            //<!-- Ausgabe ID Nummer -->  
            echo "<h4 class='idshadow'> Anlagen Identifikationsnummer:";
            echo $row['k_interne_id']."</h4>";
            $typget = $row['tab_typ.t_id'];
          }
        };
?></div>
        </div>
<div class= "container">
    <div class= "row">
        <div class="col-md-12">
            <div class="panel panel-success paneltop">
                <div class="panel-heading">Anlagendaten<br /><h4 class="panel-title">max facts</h4>
                </div>

     <ul class="list-group">
          <li class="list-group-item">Wartungsvertrag:<div class=pull-right>
                    <!-- Prüfung und Ausgabe Wartungsvertrag ANFANG -->
            <?php
           if ($row['u_contract'] != NULL)
            {
          echo $row['u_contract'] ;
             }
          else 
            {
              
              echo "<span class='glyphicon glyphicon-remove'></span>";
      
            }
            ?>
                    <!-- Prüfung und Ausgabe Wartungsvertrag ENDE -->
            </li>
             <li class="list-group-item">Letzte Wartung:<div class=pull-right>
                    <!-- Prüfung und Ausgabe Letzte Wartung ANFANG -->
            <?php
           if ($row['c_last_maintenance'] != NULL)
            {
          echo $row['c_last_maintenance'] ;
             }
          else 
            {
              
              echo "<span class='glyphicon glyphicon-remove'></span>";
      
            }
            ?>
                    <!-- Prüfung und Ausgabe Letzte Wartung ENDE -->
            </li>
          <li class="list-group-item">Hersteller:<div class="pull-right"> 
                    <!-- Ausgabe und Prüfung Hersteller Anfang -->
           <?php
                if ($row['m_name'] != NULL)
                    {
                  echo $row['m_name'] ;
                     }
                  else 
                    {
                      echo 'NO DATA AVAILABLE';
                    }
           ?> 
                      <!-- Ausgabe und Prüfung Hersteller Ende -->
          </li>
          <li class="list-group-item">Typ:<div class=pull-right>
                      <!-- Ausgabe und Prüfung Typ Anfang -->
          <?php
                if ($row['t_typ'] != NULL)
                    {
                  echo $row['t_typ'] ;
                     }
                  else 
                    {
                      echo 'NO DATA AVAILABLE';
                    }
           ?>
                    <!-- Ausgabe und Prüfung Typ Ende -->
            </li>
  
          <li class="list-group-item">Ser. Nr.:<div class=pull-right> 
                    <!-- Ausgabe und Prüfung Seriennummer Anfang -->
          <?php
                if ($row['u_serial'] != NULL)
                    {
                  echo $row['u_serial'] ;
                     }
                  else 
                    {
                      echo 'NO DATA AVAILABLE';
                    }
          ?>
                    <!-- Ausgabe und Prüfung Seriennummer Ende -->
          </li>
  
          <li class="list-group-item">Baujahr:<div class=pull-right>
                    <!-- Ausgabe und Prüfung Baujahr Anfang -->
          <?php
                if ($row['u_year'] != NULL)
                    {
                  echo $row['u_year'] ;
                     }
                  else 
                    {
                      echo 'NO DATA AVAILABLE';
                    }
           ?>
                    <!-- Ausgabe und Prüfung Baujahr Ende -->
           </li>
           <li class="list-group-item">Kältemittel:<div class=pull-right>
                    <!-- Ausgabe und Prüfung Kältemittelbezeichung Anfang -->
          <?php
                if ($row['fr_name'] != NULL)
                    {
                  echo $row['fr_name'] ;
                     }
                  else 
                    {
                      echo 'NO DATA AVAILABLE';
                    }
             ?>
                   <!-- Ausgabe und Prüfung Kältemittelbezeichung Ende -->
           </li>
          <li class="list-group-item">Füllmenge:<div class=pull-right>
                   <!-- Prüfung und Ausgabe KM- Menge ANFANG -->
           <?php
                if ($row['u_fr_load'] != NULL)
                    {
                  echo $row['u_fr_load'] ;
                     }
                  else 
                    {
                      echo 'NO DATA AVAILABLE';
                    }
            ?>
                    <!-- Prüfung und Ausgabe KM- Menge ENDE -->
           </li>

          <li class="list-group-item">Kälteleistung:<div class=pull-right> 
                    <!-- Prüfung und Ausgabe Kälteleistung ANFANG -->
          <?php
           if ($row['u_capacity'] != NULL)
            {
          echo $row['u_capacity'] ;
             }
          else 
            {
              echo 'NO DATA AVAILABLE';
            }
            ?>
                    <!-- Prüfung und Ausgabe Kälteleistung ENDE -->
           </li>

          <li class="list-group-item">VDKF:<div class=pull-right>
                    <!-- Prüfung und Ausgabe VDKF ANFANG -->
            <?php
           if ($row['u_vdkfnr'] != NULL)
            {
          echo $row['u_vdkfnr'] ;
             }
          else 
            {
              echo 'NO DATA AVAILABLE';
            }
            ?>
                    <!-- Prüfung und Ausgabe VDKF ENDE -->
            </li>

            <li class="list-group-item">Spannung:<div class=pull-right>
                    <!-- Prüfung und Ausgabe Wartungsvertrag ANFANG -->
            <?php
           if ($row['u_voltage'] != NULL)
            {
          echo $row['u_voltage'] ;
             }
          else 
            {
              
              echo "<span class='glyphicon glyphicon-remove'></span>";
      
            }
            ?>
                    <!-- Prüfung und Ausgabe Wartungsvertrag ENDE -->
            </li>
              <li class="list-group-item">Strom:<div class=pull-right>
                    <!-- Prüfung und Ausgabe Wartungsvertrag ANFANG -->
            <?php
           if ($row['u_current'] != NULL)
            {
          echo $row['u_current'] ;
             }
          else 
            {
              
              echo "<span class='glyphicon glyphicon-remove'></span>";
      
            }
            ?>
                    <!-- Prüfung und Ausgabe Wartungsvertrag ENDE -->
            </li>
            </ul>
</div>
</div>
</div>
</div>
        <script src ="https://code.jquery.com/jquery-1.9.1.js"></script>
        <script src ="js/bootstrap.js"></script>
        
</body>
        </html>
