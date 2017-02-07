<!DOCTYPE html>
<!--
Copyright (C) Karsten Kluge 
This file is part of {project} 
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // GET Variable
$page = '';

// Pfüft die GET Variable, ob gesetzt und vom Typ integer
if (isset($_GET['page']) && ctype_digit(strval($_GET['page']))) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

// Ergebnisse pro Seite
$res_per_page = 2;

// Erste Seite
$start_from = ($page-1) * $res_per_page;
// echo 'LIMIT ' . $start_from . ', ' . $res_per_page; // debug SQL Limit

include 'connectdb.php';
$sql_query = ("SELECT notes, name_short FROM historie WHERE u_id = 4711 LIMIT $start_from, $res_per_page");
if(!$result = $db->query($sql_query)) {
    // Falls SQL Fehler auftaucht
    die('Fehler beim Ausführen der Datenbankabfrage:<br>' . $db->error);
} else {
    // SQL Query Daten ausgeben
    echo '<div class="query"><h3>Php MySQL Pagination</h3>';
    echo '<table><tr><td><strong>Name</strong></td><td><strong>Eintrag</strong></td></tr>';
    while($row = $result->fetch_assoc()) {
        echo '<tr><td>'. $row['name_short']. '</td><td>' . $row['notes'] . '</td></tr>';
    }
    echo '</table>';
} 

//Seitensprung
$sql_query = ("SELECT id FROM historie WHERE u_id = 4711");
// SQL Abfrage ausführen
$result = $db->query($sql_query);
// Anzahl der Ergebnisse aus SQL Abfrage
$total_records = $result->num_rows;
echo $total_records;
// Ergebnisse gesamt durch Ergebnisse pro Seite teilen
$total_pages = ceil($total_records / $res_per_page);

// Erste Seite
echo "<p><a href='./'>".'[Start]'."</a> ";
// For Schleife für Seitendurchlauf
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='?page=".$i."'>Seite ".$i."</a> ";
}
// Letzt Seite
echo "<a href='?page=$total_pages'>".'[Ende]'."</a></p>";

echo '</div>';

// Nach Anschluß alle Aufgaben, SQL Verbindung schließen
$db->close();

?>
    </body>
</html>
