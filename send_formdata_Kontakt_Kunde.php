<html>
    <head>
        <title>Datenbank Eintrag Kontaktperson Kunde</title>
    </head>
    <body>

<?php
require 'connectdb.php';
include 'inc/func/anzeige_func.php';
require 'inc/func/function.php';

if(isset($_REQUEST['submit']))
{
  $errorMessage=    "<br>";
  $selectname=      clean($_POST['selectname']);
  $exploded =       multiexplode(array("|", ":"),$selectname);                  //Übermitteltes Array separieren damit ID des gewählten Eintrages bekannt ist
  $formular_id_1=   $exploded[3];                                  
  $vorname=         clean($_POST['cp_first_name']);
  $nachname=        clean($_POST['cp_last_name']);
  $tel_a=           checkfon($_POST['phone_a']);
  $tel_b=           checkfon($_POST['phone_b']);
  $fax=             trim($_POST['fax']);
  $fax =            delspace($fax);
  $email=           trim($_POST['e_mail']);
  
  
print_r($selectname);
print_r($exploded[3]);
$datek=     date("Y-m-d H:i:s");
//$notes_with_break = str_replace("\n","< br>",$notes);    
  if ( empty($nachname) == TRUE )                                               //Prüfung auf ausgefüllte Felder
  {                                                      
    echo "<a href='javascript: history.go(-1)'>Es wurden nicht alle benötigten Felder ausgefüllt!\n</a>";
    die();                                                                          // Prüfung abbrechen und weitere Ausführung stoppen.
  }                                                                               
  else  {      
        insert_new_customer_contact();                                                  //Abfragequery in function.php
        }
}
//$kunr = $db->real_escape_string($_POST['k_kdnr']);                              // Prüfung zusätzlich ob KdNr schon vorhanden
//    check_kdnr($kunr);                                                          // Abfrage in function.php
//    $result = $db->query($customer_id);                                     
//               $result->num_rows;                              
//               $rows = $result->fetch_all(MYSQLI_ASSOC);    
//if ($result->num_rows === 0){                                                   //Wenn KdNr nicht vorhanden, folgt INSERT sonst Fehler     
if  ($result=$db->query($insqDbtb) ===TRUE){
    $last_id = $db->insert_id;                                                  // Welche Primäre ID wurde zugewiesen?
echo "Neuer Datensatz mit der ID " .$last_id. " eingetragen. <br>";}
else {
      echo "<H3> Fehler beim Eintrag in die Datenbank!" . mysqli_error($db) ."</H3>";   
     }                                                                             // Prüfung Ende 
insert_customer_contact_link();
     
     
if ($result_2=$db->query($linktab) ===TRUE){
  echo "Folgende Daten wurden in die Tabelle customer_contactperson_link eingetragen: <br />";
  echo $formular_id_1 . $last_id;
}else{
echo "Fehler im System!"  . mysqli_error($db);}
 
$db -> close($db);                                                                            
//   Testausgabe was eingetragen wird                                                                           
echo $selectname ."<br />";
echo $formular_id . "<br />";
echo $nachname ."<br />";
echo $vorname ."<br />";
echo $tel_a ."<br />";
echo $tel_b ."<br />";
echo $email ."<br />";
echo $fax ."<br />";
echo nl2br($notes) ."<br />";
echo $datek ;
//  Testausgabe ENDE
?>
</body>
</html>                 

                             
                

    


    

        
    
