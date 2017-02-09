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
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title> DeTec UnitDataInfoSystem ALPHA #0.7.2</title>
        <meta name= "viewport" content = "width=device-width, initial-scale=1.0">
        <link href = "inc/css/bootstrap.css" rel = "stylesheet">
        <link href = "inc/css/styles.css" rel = "stylesheet">
        <link href = "inc/css/font-awesome.min.css" rel="stylesheet" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="inc/js/jquery-ui.min.js"></script>
        <script type="text/javascript">
          // Kundennummerabfrage über AJAX ob Nummer schon vorhanden!
          $(document).ready(function () {
              $('#uid_form').keyup(function () {
                  $.post('check2.php', {uid_form: form.uid_form.value},
                          function (result) {
                              $('#feedback').html(result).show("fade", 2000);
                          });
              });
          });
          // Löschen der Fehlermeldung bei Reload und onklick auf Eingabefeld
          $(document).ready(function () {
              $('#uid_form').on('click', function () {
                  $('.error-message').html("");
              });
          });
        </script>
    </head>
    <body>
        <?php
        include 'connectdb.php';
        include 'inc/func/anzeige_func.php';
        include 'inc/func/function.php';
        include 'header2.php';
        $shorturl = htmlentities($_SERVER['PHP_SELF']);

        if (isset($_REQUEST['submit'])) {
          $form_id = clean($_POST['uid_form']);
          $name_company = $_POST['k_name_company'];
          $cat_id = multiexplode(array("."), clean($_POST['select_case']));           // Aus Abfrage, die ID und Kategorie liefert, die ID separieren
          $kd_nr_ex = multiexplode(array("|"), $_POST['selectname']);                  //Aus Abfrage, die KD Nr. und Namen liefert, die KD Nr. separieren
          $errorMessage2 = "";                                                        //Variablen nullen
          $errorMessage = "";
          echo ($cat_id[1]);                                                          // TEST MUSS ENTFERNT WERDEN

          if (!isset($form_id) OR empty($form_id) OR empty($cat_id)) {
            $errorMessage2 = "Bitte Kategorie auswählen!";
          }

          $result = $db->query("SELECT ident_id FROM unit WHERE ident_id = '$form_id' "); // Zusätzliche Abfrage ob ID schon vorhanden
          if ($result->num_rows > 0) {                                                    // per PHP wenn JQuery nicht aktiviert
            $errorMessage = "Diese ID ist schon vergeben !";
            $ausgabe = $result->num_rows;
          } else {
            $errorMessage = "";
          }
          $result->close();                                                               // Result freigeben, beenden
        }                                                                               // Endklammer der IF Abfrage
        ?>
        <div class="jumbotron text-justify">
            <div class="container">
                <div class="row">
                    <h2 class="idshadow">Neue Anlage hinzufügen</h2>                         <!--Ausgabe im Jumbotron-->
                </div>
            </div>
        </div>
        <div class="container">                                                         <!-- Spalte links -->
            <div class="row">
                <div class="col-md-2">Test</div>                                           <!-- TEST MUSS NOCH ENTFERNT WERDEN-->
                <div class="col-md-10">
                    <div class="panel panel-info">
                        <div class="panel-heading">ID Prüfung</div>
                        <div class="panel-body panel-info">
                            <!-- *********************Start Formular********************* -->
                            <!--                 Neuen Anlage hinzufügen                  -->
                            <!-- ******************************************************** -->
                            <form class="form-horizontal" id ="form" name="form" action="addunit_1.php" method="post" >
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="uid">Anlagen ID <i class="asteriskField">*</i></label>
                                    <div class="input-group col-md-6"><div id="feedback"></div>
                                        <input id="uid_form" name="uid_form" placeholder="ID" class="form-control"  required="" autofocus="" type="text" value="" />
                                        <div class="error-message"> <?php echo $errorMessage; ?></div>
                                    </div>
                                </div>
                                <!-- Select Basic -->
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="select_case">Art</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-list fa-fw" aria-hidden="true"></i></div>
                                            <select id="select_case" name="select_case" class="form-control">
                                                <?php
                                                selectTyp();                                                                    // Select Auswahl aus Datenbank Tabelle unittypen generieren
                                                $resultTyp = $db->query($selTyp);                                               // Funktion 2017020801
                                                while ($resultIn = $resultTyp->fetch_array()) {
                                                  echo "<option>{$resultIn['id']}. {$resultIn['typ_auswahl']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        </select><div class="error-message"><?php echo $errorMessage2; ?> </<div>
                                            </div>
                                        </div></div>

                                    <div class="form-group">
                                        <label for="firma" class="col-sm-4 control-label">Kunde</label>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-user fa-fw" aria-hidden="true" ></i>
                                                </div>
                                                <select type="text" class="form-control" name="selectname" id="name" value="" autofocus="" placeholder="Firma" />
                                                <?php
                                                customer();                                                           // Function Nr.: 23020801 $da
                                                $ergebnisvonHerstellern = $db->query($dort);
                                                // Ausgabe über while Schleife, da mehr als ein Ergebnis erwartet wird
                                                while ($endresult = $ergebnisvonHerstellern->fetch_array()) {
                                                  echo "<option>{$endresult['cs_customer_name']} |{$endresult['cs_id']} </option>";
                                                }
                                                ?>
                                                </select>

                                            </div>
                                            <!--Ausgabe Fehlermeldung -->
                                            <span class="help-block" id="error">
                                            </span>
                                            <!--Ende Ausgabe -->
                                        </div>
                                    </div>


                                    <p></p>
                                    <a class="btn btn-primary-white pull-left" href="Kunde_add2.php">
                                        <i class="fa fa-plus-square fa-1x"></i> Neuen Kunden anlegen</a>
                                    <button type="submit" name="submit" class="btn pull-right btn-primary-white">Give it to me</button>

                                    <div class="col-md-4 col-sm-4"></div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



            <script src = "inc/js/bootstrap.js"></script>
            <?php
            include_once 'footer.php';

