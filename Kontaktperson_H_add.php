<?php
session_start();
if (empty($_SESSION['usr_id']))
{
  header("Location: index.php?uid=". $_SESSION['uids'] ."");
  exit; 
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
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>  
<script src="inc/js/jquery-ui.min.js"></script>
<!--  <script src="inc/js/jquery.validate.min.js"></script>-->
 <script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.js"></script>
<!--<script src="inc/js/bootstrap_validator_min.js"></script>
<!--<script src="inc/js/validation.js"></script>-->


</head>
<body>
<?php include ('header2.php');
        require 'inc/func/function.php';?>
<!-- Admin Section Begin -->
<div class="jumbotron text-left">
     <div class="container">
          <h1 class="mod1">Neue Kontaktperson für Hersteller anlegen
     </div> 
</div>            
<div class="container">
     <div class="row">
      <div class="col-md-2">Test</div>      <!-- Aufteilung der Seite in 2 Teile LINKS ist frei zur Verfügung -->
        <div class="col-md-10">             <!-- Beginn der zweiten Spalte -->
          <div class="panel panel-info box-border">
            <div class="panel-heading">Kontaktperson anlegen</div>
              <div class="panel-body panel-info">
                 
                <!-- Anfang Formular -->
<form class="form-horizontal" role="form" id ="form" name="form" action="send_formdata_Kontakt_Hersteller.php" method="POST" >

<div class="form-group">
  <label for="Firma" class="col-sm-2 control-label">Firma</label>
    <div class="col-sm-10">
      <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-hashtag fa-fw"></i> 
       </div> 
               <!-- <input type="text" class="form-control" name="name" id="name" value="" autofocus="" placeholder="Firma" /> -->
        <select type="text" class="form-control" name="selectname" id="name" value="" autofocus="" placeholder="Firma" />
        <?php  
        manufactor();                                                           // Function Nr.: 23020801 $da 
        $ergebnisvonHerstellern= $db->query($da);
        // Ausgabe über while Schleife, da mehr als ein Ergebnis erwartet wird
        while($endresult = $ergebnisvonHerstellern->fetch_array() ) {
        echo "<option> {$endresult['id']} | {$endresult['name']}</option>";  }?>
        </select>  
        </div>
        <!--Ausgabe Fehlermeldung -->             
         <div class="help-block"></div>
        <!--Ende Ausgabe -->
    </div> 
   </div>  
  
<div class="form-group">
  <label for="Vorname" class="col-sm-2 control-label">Vorname</label>
    <div class="col-sm-10">
      <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-hashtag fa-fw"></i> 
       </div>  
        <input type="text" class="form-control" name="cp_first_name" id="firstname" value="" autofocus="" placeholder="Vorname" />
      </div>
        <!--Ausgabe Fehlermeldung -->             
         <div class="help-block"></div>
        <!--Ende Ausgabe -->
    </div> 
   </div>
  <div class="form-group">
    <label for="Nachname" class="col-sm-2 control-label">Nachname</label>
    <div class="col-sm-10">
     <div class="input-group">
      <div class="input-group-addon">
       <i class="fa fa-building fa-fw" aria-hidden="true" ></i>
      </div>
       <input type="text" class="form-control" name="cp_last_name" id="lastname" data-rule-required="true" data-msg-required="Bitte einen Namen eingeben" data-rule-minlength="3" data-msg-minlength="Mindestens 3 Buchstaben" placeholder="Nachname" />
     </div>
        <!--Ausgabe Fehlermeldung -->                                                                    
        <div class="help-block"></div>
        <!--Ende Ausgabe -->
    </div>
</div>
  
  <div class="form-group">
    <label for="phone_a" class="col-sm-2 control-label">Telefonnummer 1</label>
    <div class="col-sm-10">
     <div class="input-group">
      <div class="input-group-addon" aria-hidden="true">
       <i class="fa fa-phone fa-fw"></i>
      </div>
      <input type="digits" class="form-control" name="phone_a" id="phone_a"  data-rule-digits="true" data-msg-digits="Bitte nur Zahlen einfügen, keine Leerzeichen und Buchstaben" data-rule-minlength="5" data-msg-minlength="Mindestens 5 Zahlen" placeholder="Telefonnummer" />
     </div>
        <!--Ausgabe Fehlermeldung -->                                                                    
        <div class="help-block"></div>  
            <!--Ende Ausgabe -->
     </div>
  </div> 
  
<div class="form-group">
    <label for="tel2" class="col-sm-2 control-label">Telefonnummer 2</label>
    <div class="col-sm-10">
     <div class="input-group">
      <div class="input-group-addon" aria-hidden="true">
       <i class="fa fa-phone fa-fw"></i>
      </div>
      <input type="digits" class="form-control" name="phone_b" id="phone_b"  data-rule-digits="true" data-msg-digits="Bitte nur Zahlen einfügen, keine Leerzeichen und Buchstaben" data-rule-minlength="5" data-msg-minlength="Mindestens 5 Zahlen" placeholder="Telefonnummer" />
     </div>
        <!--Ausgabe Fehlermeldung -->                                                                    
        <div class="help-block"></div>  
            <!--Ende Ausgabe -->
     </div>
  </div>    
      <!-- <div class="row">
            <div class="col-md-12">
  <div class="form-group"> 
    <label for="plz" class="col-sm-2 col-xs-2 control-label">PLZ</label>
    <div class="col-sm-10 col-md-10 col-xs-2">
     <div class="input-group">
         <div class="input-group-addon">    
       <i class="fa fa-codepen fa-fw" aria-hidden="true"></i>
      </div>
      <input type="number" class="form-control" name="k_plz_id" id="plz" data-minlength="5" pattern="^[0-9]$" data-error="Fünfstellig, nur Zahlen!" required="" placeholder="PLZ" />
      
     </div>
       <!--Ausgabe Fehlermeldung                                                                    
        <div class="help-block with-errors"></div>  
       <!--Ende Ausgabe 
    </div>
  </div>-->
<div class="form-group">
    <label for="fax" class="col-sm-2 control-label">Fax</label>
    <div class="col-sm-10">
     <div class="input-group">
      <div class="input-group-addon" aria-hidden="true">
     <i class="fa fa-fax fa-fw"></i>
     </div>
      <input type="number" class="form-control" name="fax" id="fax" placeholder="Faxnummer" />
      </div>
        <!--Ausgabe Fehlermeldung -->                                                                    
        <div class="help-block"></div>  
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
      <input type="email" data-error="Keine gültige Adresse" class="form-control" name="e_mail" id="mail" placeholder="E-mail" />
      </div>
               <!--Ausgabe Fehlermeldung -->                                                                    
        <div class="help-block"></div>  
            <!--Ende Ausgabe -->
    </div>
  </div>

  <p></p>

<button type="submit" name="submit" id="submit" class="btn pull-right btn-primary">Give it to me</button>
    </form>
  <script>

    $.validator.setDefaults({
    highlight: function(element) {
        $(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
});
    
    
  $("#form").validate({
            rules: {
               firstname: "required",
                lastname: "required"
                   
                },
                             
                lastname: {
                    required: true,
                    minlength: 2
                },
              
               
                phone_a: {
                    digits: true,
                    minlength: 5
                },
                phone_b: {
                    digits: true,
                    minlength: 5
                },
                
                mail: {
                    email: true,
                    minlength: 3
                }
            }
              );
               
               
            
                
  </script>
  </div>
            
  </div>
</div>
    </div> 
       </div>
				 <script src = "inc/js/bootstrap.js"></script>
  
</body>
</html>