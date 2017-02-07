<html>
    <head>
        <title>Datenbank Eintrag Kontaktperson</title>
    </head>
    <body>

<?php
require 'connectdb.php';
include 'inc/func/anzeige_func.php';
require 'inc/func/function.php';

if(isset($_REQUEST['submit']))
{
$errorMessage = "<br>";
    
$vorname=      clean($_POST['cp_first_name']);
$firma=     clean($_POST['k_name_company']);
$nachname=  clean($_POST['cp_last_name']);
$tel_a=       checkfon($_POST['phone_a']);
$tel_b=       checkfon($_POST['phone_b']);
$email=     trim($_POST['e_mail']);
$fax=       trim($_POST['fax']);
$fax = delspace($fax);
$name=     clean($_POST['name']);
$datek=     date("Y-m-d H:i:s");
//$notes_with_break = str_replace("\n","< br>",$notes);

    
if ( empty($kunr) == TRUE  OR                                                  //Prüfung auf ausgefüllte Felder
     empty($firma) == TRUE OR
     empty($plz) == TRUE OR
     empty($strasse) == TRUE OR
     empty($tel_a) == TRUE
    )                                                   
{
   echo "<a href='javascript: history.go(-1)'>Es wurden nicht alle benötigten Felder ausgefüllt!</a>";
   
}                                                                               // Prüfung Ende
else
{
    insert_new_customer();      //Abfragequery in function.php
    
}
}      
    $kunr = $db->real_escape_string($_POST['k_kdnr']);   // Prüfung zusätzlich ob KdNr schon vorhanden
    check_kdnr($kunr);                                       // Abfrage in function.php
    $result = $db->query($customer_id);                                     
               $result->num_rows;                              
               $rows = $result->fetch_all(MYSQLI_ASSOC);
               
    if ($result->num_rows === 0)
{                                          //Wenn KdNr nicht vorhanden, folgt INSERT sonst Fehler  
        $result=$db->query($insqDbtb) ===TRUE;
        $last_id = $db->insert_id;              // Welche Primäre ID wurde zugewiesen?
        echo "Neuer Datensatz mit der ID " .$last_id. " eingetragen. <br>";   
    } else {
        echo "<H3> Diese Kundennummer: <em> . {$kunr} . </em> ist schon vergeben! </H3>";   
   }
        
    
//   TEstausgabe was eingetragen wird                                                                           
echo $kunr ."<br />";
echo $firma . "<br />";
echo $nachname ."<br />";
echo $strasse ."<br />";
echo $tel ."<br />";
echo $plz ."<br />";
echo $email ."<br />";
echo $fax ."<br />";
echo nl2br($notes) ."<br />";
echo $datek ;
//  Testausgabe ENDE
?>
</body>
</html>