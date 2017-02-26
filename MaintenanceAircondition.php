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
        <link href=  "inc/css/checkbox-x.min.css" media="all" rel="stylesheet" type="text/css" >
        <link href = "inc/css/font-awesome.min.css" rel="stylesheet" />
        
        <script src= "https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src ="inc/js/bootstrap.js"></script>
        <script src= "inc/js/checkbox-x.min.js" type="text/javascript"></script>
        
        <!-- Script zum nachladen der Kunden ID etc. nach Auswahl über Select Feld -->
        <script type="text/javascript">
        $(document).ready(function(){
        $('select').on('change',function() {
         $.post('checkWMId.php', { WMid: form.AnlageIDDetec.value },            // WMid wird zu $_POST['WMid']
        function(result){
            $('#IDKunde').attr('disabled', true);
           $('#IDKunde').val(result);                                           // In value von IDKunde wird der Rückgabewert eingefügt   
    });
    });
    });
        // +++++++++++Script nachladen END +++++++++++++++++
    $(document).ready(function(){
            $('#submit').prop('disabled', true);
            $('#AnlageIDDeTec').on('click', function(){
                $('#submit').prop('disabled', false);
            });
        });
        // +++++++++++Script disable/enable Inputfield von KundenID Start +++++++++++
        $(document).ready(function(){
          $('#IDKunde').attr('disabled', true);
            $('#editKundenID').on('click', function(){               
              $('#IDKunde').attr('disabled', !$('#IDKunde').attr('disabled')); // Das ist der Toggle !
            });
        });
        // +++++++++++Script disable/enable Inputfield von KundenID ENDE +++++++++++
        // ++++++++++++++Start+++Enable KundeID bevor Formular gesendet wird+++++++
        //+++++++++++++++++++++++++da sonst der Inhalt nicht uebergeben wird+++++++
        $(document).ready(function(){
            $('#submit').on('click', function(){
            // Hier vielleicht noch eine Abfragebox mit den eingetragenen Werten einfügen (alert)    
            $('#IDKunde').prop('disabled', false);
            });
        });
        
        //++++++++++++++++++++++Enable Inputfield KundenID ENDE+++++++++++++++++
        
    </script>
    </head>
<body>
    
    <div class="container">
    <div class="panel-group">
    <div class="panel panel-info">
      <div class="panel-heading">
          Wartungsprotokoll Klimaanlage Weidmüller
      </div>
    <div class="panel-body">
    <!-- START FORMULAR -->
    <form class="form-horizontal" id="form" name="form" action="maintenanceAirconditionPushData.php" method="POST">
            <div class="form-group">
                <div class="col-sm-3 col-xs-12">
                <label class="control-label" for="AnlageIDDeTec">
                    Anlagenbezeichnung DeTec:
                </label>
                </div>     
                <div class="col-sm-6">
                    <div class="input-group">
                        <select type="text" class="form-control" name="AnlageIDDetec" id="AnlageIDDeTec">
                
   <?php
   include 'connectdb.php';
// +++++++++++++++++++++ Abfrage SELECT DeTec ID +++++++++++++++++++++++++++
        $getCat = ("SELECT * FROM WMKlima");
        if ($result_cat = $db->query($getCat)) {
          if ($result_cat->num_rows) {
            $rows = $result_cat->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row){
              echo '<option id="IDDetec" name="IDDetec" value="'.$row['id'].' "> '.$row['idDetec'] .'</option>';
              
            }}}
?>
       </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3 col-xs-12">
                <label  class ="control-label" for="AnlageIDKunde">
                    Anlagenbezeichnung Kunde:
                </label>
                </div>   
                <div class="col-sm-3 col-xs-6">
                    <input type="text" class="form-control" id="IDKunde" name="IDKunde" />
                </div>
                <div class="col-sm-1 col-xs-3">
                    <span id="editKundenID" name="editKundenID" class="input-group">
                        <i class="glyphicon glyphicon-edit fa-2x"></i>
                    </span>                        
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3 col-xs-6">
                <label class="pull-left" for="MyCheckBox">Filter gereinigt / ersetzt</label>
                </div>
            <div class="col-sm-6 col-xs-offset-2 col-xs-4">
            <input class="pull-right" type="checkbox" name="filter" data-toggle="checkbox-x" data-three-state="false" data-size="xl">
            </div>
            </div> 
            
            <div class="form-group">
                <div class="col-sm-3 col-xs-6">
                <label class="pull-left" for="MyCheckBox">Wäremtauscher desinfiziert</label>
                </div>
            <div class="col-sm-6 col-xs-offset-2 col-xs-4">
            <input class="pull-right" type="checkbox" name="waermetauscher" data-toggle="checkbox-x" data-three-state="false" data-size="xl">
            </div>
            </div> 
            <div class="form-group">
                <div class="col-sm-3 col-xs-6">
                <label class="pull-left" for="MyCheckBox">Temperaturen / Drücke kontrolliert</label>
                </div>
            <div class="col-sm-6 col-xs-offset-2 col-xs-4">
            <input class="pull-right" type="checkbox" name="temperatur" data-toggle="checkbox-x" data-three-state="false" data-size="xl">
            </div>
            </div> 
            <div class="form-group">
                <div class="col-sm-3 col-xs-6">
                <label class="pull-left" for="MyCheckBox">Stromaufnahme Verdichter Ok</label>
                </div>
            <div class="col-sm-6 col-xs-offset-2 col-xs-4">
            <input class="pull-right" type="checkbox" name="stromaufnahme" data-toggle="checkbox-x" data-three-state="false" data-size="xl">
            </div>
            </div> 
            <div class="form-group">
                <div class="col-sm-3 col-xs-6">
                <label class="pull-left" for="MyCheckBox">Abfluss gespült / gereinigt</label>
                </div>
            <div class="col-sm-6 col-xs-offset-2 col-xs-4">
            <input class="pull-right" type="checkbox" name="abfluss" data-toggle="checkbox-x" data-three-state="false" data-size="xl">
            </div>
            </div> 
            <div class="form-group">
                <div class="col-sm-3 col-xs-6">
                <label class="pull-left" for="MyCheckBox">Kondensatpumpe geprüft</label>
                </div>
            <div class="col-sm-6 col-xs-offset-2 col-xs-4">
            <input class="pull-right" type="checkbox" name="kondensatpumpe" data-toggle="checkbox-x" data-three-state="false" data-size="xl">
            </div>
            </div> 
            <div class="form-group">
                <div class="col-sm-3 col-xs-6">
                <label class="pull-left" for="MyCheckBox">Funktionsprüfung IG/AG</label>
                </div>
            <div class="col-sm-6 col-xs-offset-2 col-xs-4">
            <input class="pull-right" type="checkbox" name="funktion" data-toggle="checkbox-x" data-three-state="false" data-size="xl">
            </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3 col-xs-6">
                <label class="pull-left" for="MyCheckBox">Fernbedienung geprüft</label>
                </div>
            <div class="col-sm-6 col-xs-offset-2 col-xs-4">
            <input class="pull-right" type="checkbox" name="fernbedienung" data-toggle="checkbox-x" data-three-state="false" data-size="xl">
            </div>
            </div> 
            <div class="form-group">
                <div class="col-sm-3 col-xs-6">
                <label class="control-label " for="AnlageIDDeTec">
                    Bemerkungen:
                </label>
                </div>
                <div class="col-sm-6 col-xs-12" id="textbox">
                    <textarea name="bemerkungen"  width="50%" rows="10" style="background-color: white; color:black; width: 100%"></textarea>   
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-6 col-sm-3 col-xs-offset-6 col-xs-6">
                    <button type="submit" name="submit" id="submit" class="btn btn-primary pull-right">Absenden</button>
                </div>
            </div>    
        </form>
    </div>
    </div>
    </div>
    </div>
    
    
    
</body>
</html>
