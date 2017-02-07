<?php
require 'connectdb.php';


//$k_kdnr = mysqli_real_escape_string($_POST['cs_id']);
//$k_kdnr = '10251';
$customer_id = ("SELECT cs_id FROM customer WHERE cs_id = 90250");
$result = $db->query($customer_id);                                     //Ausgabe Kundendaten
                        $result->num_rows;                               //Name, Adresse, Ort
                            $rows = $result->fetch_all(MYSQLI_ASSOC);
                            echo $result->num_rows;
                           








?>
/* 
 * Copyright (C) Karsten Kluge 
 * This file is part of {project}  * 
 */

