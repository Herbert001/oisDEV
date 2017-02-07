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
  $(document).ready(function(){
        $('#uid_form').keyup(function() {
         $.post('check2.php', { uid_form: form.uid_form.value },
        function(result){
           $('#feedback').html(result).show("fade", 2000);
       });
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

if(isset($_REQUEST['submit']))
{
    $form_id        = clean($_POST['uid_form']);
    $cat_id         = clean($_POST['select_case']);
    $name_company   = $_POST['k_name_company'];
    $errorMessage   = "";
    $errorMessage2  = "";
    var_dump($_POST['k_name_company']);    
    if(!isset ($form_id) OR empty($form_id) OR empty($cat_id))
    {       
         $errorMessage2   = "Bitte Kategorie auswählen!";
//         header( "Location: addunit_1.php");
    }
            
    $result = $db->query("SELECT u_id FROM unit WHERE u_id = '$form_id' "); 
         
    if ($result->num_rows >0){
             $errorMessage = "Diese ID ist schon vergeben !";
             $ausgabe   = $result->num_rows;
             //var_dump ($result->fetch_assoc());
             echo $ausgabe;
    }
    else{
        echo "nix is anzuzeigen" .$cat_id .$form_id;
        
       
    }

    /* free result set */
    $result->close();
}
    
//        if ($result->num_rows > 0) {
//    // output data of each row
//   while($rows = $result->fetch_all(MYSQLI_ASSOC)) {
//        echo "Dies ist EIN TESTTTT";
//        $result->close();
//   }
//} else {
//    echo "0 results";
//    
//} 
?>
<div class="jumbotron text-justify">
  <div class="container">
      <div class="row">
      <h2 class="idshadow">Neue Anlage hinzufügen</h2>
  </div>
  </div>
</div>
<div class="container">
   <div class="row">
       <div class="col-md-2">Test</div>
       <div class="col-md-10">
       <div class="panel panel-info">
        <div class="panel-heading">ID Prüfung</div>
        <div class="panel-body panel-info">
            <!-- *********************Start Formular********************* -->
            <!--                 Neuen Anlage hinzufügen                  -->
            <!-- ******************************************************** -->
<form class="form-horizontal" id ="form" name="form" action="addunit_1.php" method="post" >                                  
<div class="form-group">
  <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="uid">Anlagen ID <i class="asteriskField">*</i>
  </label> 
<div class="input-group col-md-6"><div id="feedback"></div>
  <input id="uid_form" name="uid_form" placeholder="ID" class="form-control"  required="" autofocus="" type="text" value="<?php echo $form_id;?>" />    
    <div class="error-message"><?php echo $errorMessage; ?></div>
</div> 
</div>  
<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="select_case">Art</label>
  <div class="col-md-6">
    <select id="select_case" name="select_case" class="form-control">
      <option value="0" selected disabled>Choose here</option>  
      <option value="1">Klimaanlage</option>
      <option value="2">Druckluftkompressor</option>
      <option value="3">KWS</option>
      <option value="4">Drucklufttrockner</option>
      <option value="5">weitere</option>
      <option value="6">weitere2</option>
    </select><div class="error-message"><?php echo $errorMessage2; ?> </<div>
  </div>
    </div></div>
      
 <div class="form-group">
    <label for="firma" class="col-sm-4 control-label">Firmenname</label>
    <div class="col-sm-6">
     <div class="input-group">
      <div class="input-group-addon">
     <i class="fa fa-user fa-fw" aria-hidden="true" ></i>
     </div>
<select type="text" class="form-control" name="selectname" id="name" value="" autofocus="" placeholder="Firma" />
        <?php  
        customer();                                                           // Function Nr.: 23020801 $da 
        $ergebnisvonHerstellern= $db->query($dort);
        // Ausgabe über while Schleife, da mehr als ein Ergebnis erwartet wird
        while($endresult = $ergebnisvonHerstellern->fetch_array() ) {
        echo "<option>{$endresult['cs_customer_name']} |{$endresult['cs_id']} </option>";  }?>
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
</div>
</div>  
                     
  
<script src = "inc/js/bootstrap.js"></script>
<?php include_once 'footer.php';
    
