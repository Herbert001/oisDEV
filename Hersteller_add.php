<?php
session_start();
if (empty($_SESSION['usr_id'])) {
                       header("Location: index.php?uid=". $_SESSION['uids'] ."");
                       exit; 
                       }else{
                            echo "Ein unerwarteter Fehler ist aufgetreten";
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
<script src="inc/js/jquery.validate.min.js"></script>
<script src="inc/js/bootstrap_validator_min.js"></script>
<!--<script src="inc/js/validation.js"></script>-->
<script type="text/javascript">
 // Kundennummerabfrage über AJAX ob Nummer schon vorhanden!
//  $(document).ready(function(){
//        $('#kundnr').keyup(function() {
//         $.post('check.php', { cs_id: form.k_kdnr.value },
//        function(result){
//           $('#feedback').html(result).show("fade", 2000);
//       });
//    });
//    });   
 // Tooltip von Bootstrap aktivieren
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip({ 
    placement : "bottom",
    animation: "true",
    delay: {show:200, hide:700}
    });
 });
</script>
</head>
<body>
    <?php include ('header2.php');?>
        <!-- include ('inc/js/validationz_add.js'); -->
    
<!-- Admin Section Begin -->
<div class="jumbotron text-left">
            <div class="container">
                 <h1 class="mod1">Hersteller anlegen </h1>
            </div> 
</div>            
                 <div class="container">
                 <div class="row">
                     <div class="col-md-2">Test</div>
                     <div class="col-md-10">
                    <div class="panel panel-info box-border">
  <div class="panel-heading">Hersteller anlegen</div>
  <div class="panel-body panel-info">
    <form class="form-horizontal" data-toggle="validator" role="form" id ="form" name="form" action="send_formdata_neuer_Hersteller.php" method="POST" >
 
  <div class="form-group">
      <label for="kundnr" class="col-sm-2 control-label">Kundennummer
    <span class="asteriskField">*
    </span>
    </label>
    <div class="col-sm-10">
      <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-hashtag fa-fw"></i> 
       </div>  
        <input type="number" class="form-control" name="h_kdnr" id="kundnr" required="" data-required-error="Pflichtfeld" value="<?php echo $k_kdnr; ?>" autofocus="" placeholder="Kundennummer" />
      </div>
        <!--Ausgabe Fehlermeldung -->             
         <div id="feedback"></div>
         <div class="help-block with-errors"></div>
        <!--Ende Ausgabe -->
    </div> 
   </div>
  <div class="form-group">
    <label for="firma" class="col-sm-2 control-label">Firmenname</label>
    <div class="col-sm-10">
     <div class="input-group">
      <div class="input-group-addon">
       <i class="fa fa-building fa-fw" aria-hidden="true" ></i>
      </div>
       <input type="text" class="form-control" name="h_name_company" required="" data-toggle="tooltip" title="" id="firma" data-required-error="Pflichtfeld" placeholder="Firmenname" />
     </div>
        <!--Ausgabe Fehlermeldung -->                                                                    
        <div class="help-block with-errors"></div>
        <!--Ende Ausgabe -->
    </div>
</div>
  
       
  <div class="form-group">
    <label for="street" class="col-sm-2 control-label">Strasse</label>
    <div class="col-sm-10">
     <div class="input-group">
      <div class="input-group-addon">
       <i class="fa fa-road fa-fw" aria-hidden="true"></i>
      </div>
      <input type="text" class="form-control" name="h_street" required="" id="street" data-required-error="Pflichtfeld" placeholder="Strasse" />
     </div>
      <!--Ausgabe Fehlermeldung -->                                                                    
       <div class="help-block with-errors"></div> 
      <!--Ende Ausgabe -->
     </div>
  </div>
        <div class="row">
            <div class="col-md-12">
  <div class="form-group"> 
    <label for="plz" class="col-sm-2 col-xs-2 control-label">PLZ</label>
    <div class="col-sm-10 col-md-10 col-xs-2">
     <div class="input-group">
         <div class="input-group-addon">    
       <i class="fa fa-codepen fa-fw" aria-hidden="true"></i>
      </div>
      <input type="number" class="form-control" name="h_plz_id" id="plz" data-minlength="5" pattern="^[0-9]$" data-error="Fünfstellig, nur Zahlen!" required="" placeholder="PLZ" />
      
     </div>
       <!--Ausgabe Fehlermeldung -->                                                                    
        <div class="help-block with-errors"></div>  
       <!--Ende Ausgabe -->
    </div>
  </div>
    <div class="form-group">
      <label for="ort" class="col-sm-2 col-xs-2 control-label">Ort</label>
      <div class="col-sm-10 col-md-10 col-xs-2">
       <div class="input-group">
        <div class="input-group-addon">
         <i class="fa fa-codepen fa-fw" aria-hidden="true"></i>
        </div>
         <input type="text" class="form-control" name="ort" id="ort" required="" data-required-error="Pflichtfeld" placeholder="Ort" />
       </div>  
        <!--Ausgabe Fehlermeldung -->                                                                    
        <div class="help-block with-errors"></div> 
        <!--Ende Ausgabe -->
       </div> 
     </div>   
  <div class="form-group">
    <label for="tel" class="col-sm-2 control-label">Telefonnummer 1</label>
    <div class="col-sm-10">
     <div class="input-group">
      <div class="input-group-addon" aria-hidden="true">
       <i class="fa fa-phone fa-fw"></i>
      </div>
      <input type="number" class="form-control" name="h_tel_company" required="" id="tel" pattern="^[0-9]$" data-error="Pflichtfeld, nur Zahlen" placeholder="Telefonnummer" />
     </div>
        <!--Ausgabe Fehlermeldung -->                                                                    
        <div class="help-block with-errors"></div>  
            <!--Ende Ausgabe -->
     </div>
  </div>

<div class="form-group">
    <label for="tel" class="col-sm-2 control-label">Telefonnummer 2</label>
    <div class="col-sm-10">
     <div class="input-group">
      <div class="input-group-addon" aria-hidden="true">
     <i class="fa fa-phone fa-fw"></i>
     </div>
      <input type="text" class="form-control" name="h_tel_company2" id="tel2" placeholder="Telefonnummer2" />
</div>
        <!--Ausgabe Fehlermeldung -->                                                                    
        <div class="help-block with-errors"></div>  
            <!--Ende Ausgabe -->
</div>
</div> 
                
<div class="form-group">
    <label for="fax" class="col-sm-2 control-label">Fax</label>
    <div class="col-sm-10">
     <div class="input-group">
      <div class="input-group-addon" aria-hidden="true">
     <i class="fa fa-fax fa-fw"></i>
     </div>
      <input type="text" class="form-control" name="h_fax_company" id="fax" placeholder="Faxnummer" />
</div>
        <!--Ausgabe Fehlermeldung -->                                                                    
        <div class="help-block with-errors"></div>  
            <!--Ende Ausgabe -->
</div>
</div>                
  <div class="form-group">
    <label for="mail" class="col-sm-2 control-label">E-Mail</label>
    <div class="col-sm-10">
     <div class="input-group">
      <div class="input-group-addon" aria-hidden="true">
     <i class="fa fa-envelope fa-fw"></i>
     </div>
      <input type="email" data-error="Keine gültige Adresse" class="form-control" name="h_mail_company" id="mail" placeholder="E-mail" />
</div>
               <!--Ausgabe Fehlermeldung -->                                                                    
        <div class="help-block with-errors"></div>  
            <!--Ende Ausgabe -->
</div>
</div>
  
  <div class="form-group">
    <label for="notes" class="col-sm-2 control-label">Notes</label>
    <div class="col-sm-10">
     <div class="input-group">
      <div class="input-group-addon" aria-hidden="true">
     <i class="fa fa-info fa-fw"></i>
     </div>
      <textarea class="form-control" rows="3" name="h_notes_company" id="notes" placeholder="textbox"></textarea>
</div>
</div>
</div>
<p></p>

<button type="submit" name="submit" id="submit" class="btn pull-right btn-primary">Give it to me</button>
    </form>
  </div>
  </div>
</div>
                 </div> 
   </div>


        
        
        <script src = "inc/js/bootstrap.js"></script>
        
        
        
                </body>
        </html>