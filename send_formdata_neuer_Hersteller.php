<html>
    <head>
        <title>Datenbank Eintrag</title>
    </head>
    <body>

<?php
require 'connectdb.php';
include 'inc/func/anzeige_func.php';
require 'inc/func/function.php';

if(isset($_REQUEST['submit']))
{
$errorMessage = "<br>";
    
$kunr=      clean($_POST['h_kdnr']);
$firma=     clean($_POST['h_name_company']);
$plz=       clean($_POST['h_plz_id']);
$strasse=   trim($_POST['h_street']);
$tel_a=       checkfon($_POST['h_tel_company']);
$tel_b=       checkfon($_POST['h_tel_company2']);
$email=     trim($_POST['h_mail_company']);
$fax=       trim($_POST['h_fax_company']);
$fax = delspace($fax);
$notes=     trim($_POST['h_notes_company']);
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
    insert_new_manufactor();      //Abfragequery in function.php
    
}
}      
    $kunr = $db->real_escape_string($_POST['h_kdnr']);   // Prüfung zusätzlich ob KdNr schon vorhanden
    check_h_kdnr($kunr);                                       // Abfrage in function.php
    $result = $db->query($manufactor_id);                                     
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
echo $strasse ."<br />";
echo $tel_a ."<br />";
echo $tel_b ."<br />";
echo $plz ."<br />";
echo $email ."<br />";
echo $fax ."<br />";
echo nl2br($notes) ."<br />";
echo $datek ;
//  Testausgabe ENDE
?>
</body>
</html>