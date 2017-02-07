<html>
    <head>
        <title>title</title>
    </head>
    <body>

   


<?php
require 'connectdb.php';
include 'func/anzeige_func.php';

if(isset($_REQUEST['submit']))
{
$errorMessage = "";
    
$kunr=      clean($_POST['k_kdnr']);
$firma=     clean($_POST['k_name_company']);
$nachname=  clean($_POST['k_lastname']);
$plz=       clean($_POST['k_plz_id']);
$strasse=   trim($_POST['k_street']);
$tel_a=       checkfon($_POST['k_tel_company']);
$tel_b=       checkfon($_POST['k_tel_company2']);
$email=     trim($_POST['k_mail_company']);
$fax=       trim($_POST['k_fax_company']);
$notes=     trim($_POST['k_notes_company']);
$datek=     date("Y-m-d H:i:s");
$notes_with_break = str_replace("\n","< br>",$notes);

    
if ( empty ($kunr) == TRUE   or                                                 //Prüfung auf ausgefüllte Felder
     empty ($firma) == TRUE )                                                   
{
   echo "Kundennummer und Name sind zwingend!";
}                                                                               // Prüfung Ende
else
{
if ($errorMessage != "" ) {                                                     // Ausgabe Fehlermeldung
echo "<p class='message'>" .$errorMessage. "</p>" ;
}
else
{
   //Inserting record in table using INSERT query
//   TEstausgabe was eingetragen wird                                                                           
//echo $kunr ."<br />";
//echo $firma . "<br />";
//echo $nachname ."<br />";
//echo $strasse ."<br />";
//echo $tel ."<br />";
//echo $plz ."<br />";
//echo $email ."<br />";
//echo $fax ."<br />";
//echo $notes ."<br />";
//echo $datek ;

//  Testausgabe ENDE
//  Folgendes auskommentieren wenn Eintrag in Datenbank                                                                                                      
$insqDbtb="INSERT INTO `customer`                                                
	(`cs_id`, `cs_customer_name`, `cs_street`, `cs_zip`,
         `cs_phone_a`, `cs_phone_b`, `cs_fax`, `cs_email`, `cs_notes`,
         `cs_date_add`)
	 VALUES
	('$kunr', '$firma', '$strasse', '$plz', '$tel_a', '$tel_b',  '$fax',
         '$email', '$notes', '$datek')";
}
}
}
if ($db->query($insqDbtb) ===TRUE){
    $last_id = $db->insert_id;
    echo "Neuer Datensatz mit der ID " .$last_id. " eingetragen.";
} else {
    echo "Error: " .$insqDbtb . "<br>" . $db->error;
}
?>
</body>
</html>