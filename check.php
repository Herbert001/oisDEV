<?php 
include 'connectdb.php';
// Abfrage mit übermittelten Werten aus Kunde_add2.php um Verfügbarkeit von Kundennummer anzuzeigen

$k_kdnr = $db->real_escape_string($_POST['cs_id']);
$customer_id = ("SELECT cs_id FROM customer WHERE cs_id = ' $k_kdnr ' " );
$result = $db->query($customer_id);                                     
               $result->num_rows;                              
               $rows = $result->fetch_all(MYSQLI_ASSOC);
               //echo $result->num_rows;
// Editierte Ausgabe wenn Rückgabewert 0 oder 1
if (strlen($k_kdnr) >= 5)
    if ($result->num_rows === 0)
        echo "<div id='green'> Kundenummer verfügbar! </div>";
    else  
        echo "<div id='red'> Kundenummer schon vergeben! </div>";
?>