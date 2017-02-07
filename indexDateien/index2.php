<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
</head>

<body>
<style>
p{text-indent:20px;
border:solid 1px black;
padding:30px;
background:yellow;
color:blue;}

</style>



<?php
require_once ('konfig.php');
$db_link = mysqli_connect (
                     MYSQL_HOST, 
                     MYSQL_BENUTZER, 
                     MYSQL_KENNWORT, 
                     MYSQL_DATENBANK
                    );


$abfrage = "SELECT * FROM kunden";
$ergebnis = mysqli_query($db_link, $abfrage);
while($row = mysqli_fetch_object($ergebnis))
{
  echo "<p>";
  echo $row->name;
  echo "&nbsp";
  echo "</p>";
  echo $row->anlagentyp;
  echo '<br>';
}

?>
</body>

</html>
