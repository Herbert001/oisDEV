<?php 
include 'connectdb.php';
// Abfrage mit übermittelten Werten aus maintenanceVENT.php um Kunden ID nachzuladen
$kundenID = strval($db->real_escape_string($_POST['WMid']));    //WMId wird in maintenanceAircondition.php initiert.
$query_id = ("SELECT * FROM WMKlima WHERE id = " .$kundenID ."  " );
$result = $db->query($query_id);                                     
               $result->num_rows;                              
               $rows = $result->fetch_all(MYSQLI_ASSOC);
               foreach ($rows as $row){
                   echo $row['idKunde'];
               }
//               echo "<pre>";
//print_r($rows);
//               echo "</pre>";

?>
