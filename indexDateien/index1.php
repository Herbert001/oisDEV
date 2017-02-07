<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
</head>

<body>


<?php
require_once ('konfig.php');
$db_link = mysqli_connect (
                     MYSQL_HOST, 
                     MYSQL_BENUTZER, 
                     MYSQL_KENNWORT, 
                     MYSQL_DATENBANK
                    );


$sql = "SELECT * FROM kunden";
 
$result = mysqli_query($sql) or die ("Fehler");
?>
<table cellpadding="1" cellspacing="1" border="1">
<tr>
<td>Maschine</td>
<td>Nummer</td>
<td>Ort</td>
</tr>

<?PHP
while ($row = mysqli_fetch_array($result)) {
?>

<tr>
<td style="font-weight: bold; text-align: center"><?=$row['Maschine']?></td>
<td><?=$row['Nummer']?></td>
</tr>

<?PHP
}
?>

</table>
mysqli_free_result( $db_erg );




?>


</body>

</html>
