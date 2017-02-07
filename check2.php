 <?php 
include 'connectdb.php';
// Abfrage mit übermittelten Werten aus addunit_1.php um Verfügbarkeit von IDnummer anzuzeigen

$u_idf = $db->real_escape_string($_POST['uid_form']);
$query_id = ("SELECT u_id FROM unit WHERE u_id = ' $u_idf ' " );
$result = $db->query($query_id);                                     
               $result->num_rows;                              
               $rows = $result->fetch_all(MYSQLI_ASSOC);
               //echo $result->num_rows;
// Editierte Ausgabe wenn Rückgabewert 0 oder 1
if (strlen($u_idf) >= 2)
    if ($result->num_rows === 0)
        echo "<div id='green'> Identnummer verfügbar! </div>";
    else  
        echo "<div id='red'> Identnummer schon vergeben! </div>";
?>

