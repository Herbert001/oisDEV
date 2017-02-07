<?php

function selectfunc_aircondition($_sesuid){
    $resulta = ("SELECT a.u_id, c.ac_ag_id, c.ac_ig_link_id, d.ac_ag_typ_id, d.ac_ag_serial_nr, d.ac_ag_build_year, d.ac_ag_frigen_load
                            FROM unit a
                            LEFT JOIN unit_link_aircondition c
                            ON a.u_id = c.id_linktab
                            LEFT JOIN aircondition_ag d
                            ON c.ac_ag_id = d.id
                            WHERE a.u_id = $_sesuid");
    return $resulta;
   }
   
function save_get($_getparam){
    if ((isset($_POST[$getparam])) && (!empty($_POST[$getparam])) && (ctype_digit($_POST[$getparam]))){
        echo $getparam . "Geht einwandfrei";
          }
          else echo 'geht nicht';
}
return $getparam;
   
   function checkFon($fon)
{
    $fon = preg_replace('/[^A-Za-z0-9ÜüÄäÖöß[:blank:]]/', '', $fon);   
    $fon= trim($fon);
    if (!preg_match('/^((+)([0-9.-/\s]{5,})|([0-9.-/\s]{5,}))*$/', $fon))
    {
        return $fon;
    }
    else
{
            echo $fon;
            die( 'Die eingegebene Telefonnummer enthält nicht erlaubte Zeichen!' ); 
    }
}  
   
function clean($string) {
   
    $string = preg_replace('/\s\s+/', ' ', $string);    //entfernt überschüssige Leerzeichen aus einer Zeichenkette. 
    //$zuerst = trim($string, " \t.");
    return $string;              
    
    }
   
function delspace($fax){
    
return $fax = str_replace(" ", "", $fax);}      // entfernt alle Leerzeichen innerhalb des Strings
?>