<?php 


// verschiedene Funktionen

function insert_new_customer()  //Verwendung in Datei send_formdata_neuer_Kunde2.php
{   
    global $insqDbtb, $kunr, $firma, $strasse, $plz, $tel_a, $tel_b, $fax, $email, $notes, $datek;
    return $insqDbtb="INSERT INTO `customer`                                                
	(`cs_id`, `cs_customer_name`, `cs_street`, `cs_zip`,
         `cs_phone_a`, `cs_phone_b`, `cs_fax`, `cs_email`, `cs_notes`,
         `cs_date_add`)
	 VALUES
	('$kunr', '$firma', '$strasse', '$plz', '$tel_a', '$tel_b',  '$fax',
         '$email', '$notes', '$datek')" or trigger_error("Query Failed! SQL:  $insqDbtb - Error: ".mysqli_error(), E_USER_ERROR);
    
}

// Einfügen neue Kontaktperson von Kunde
function insert_new_customer_contact()  //Verwendung in Datei send_formdata_Kontakt_Kunde.php
{   
    global $insqDbtb, $vorname, $nachname, $tel_a, $tel_b, $fax, $email;
    return $insqDbtb="INSERT INTO `contact_person`                                                
	(`cp_first_name`, `cp_last_name`, `phone_a`, `phone_b`, `fax`, `e_mail`)
	 VALUES
	('$vorname', '$nachname', '$tel_a', '$tel_b', '$fax', '$email' )" OR
        trigger_error("Query Failed! SQL:  $insqDbtb - Error: ".  \mysqli_error(), E_USER_ERROR);
}

function insert_customer_contact_link()
{
  global $linktab, $last_id, $formular_id_1;
  return $linktab = "INSERT INTO `customer_contactperson_link`
  (`cp_id`, `cp_c_link_id`)
   VALUES
  ('$formular_id_1','$last_id')";
          
}

function insert_new_manufactor()  //Verwendung in Datei send_formdata_neuer_Hersteller.php
{   
    global $insqDbtb, $firma, $kunr, $cpm_id, $strasse, $plz, $tel_a, $tel_b, $fax, $email,
            $notes, $datek;
    return $insqDbtb="INSERT INTO `manufactor`                                                
	(`name`, `mf_nr`, `cpm_id`, `street`, `zip_link`,
         `phone_a`, `phone_b`, `fax`, `e_mail`, `notes`,
         `m_date_add`)
	 VALUES
	('$firma', '$kunr', '$cpm_id', '$strasse', '$plz', '$tel_a', '$tel_b', '$fax', '$email',
      '$notes', '$datek')" or trigger_error("Query Failed! SQL:  $insqDbtb - Error: ".mysqli_error(), E_USER_ERROR);
    
}

function customer_unit($unit_num_id)                                            //Funktion in get_ident_nr.php
{                                                                               //2017310101
  global $customer_unit;                                                        //Abfrage Unit welcher Kunde
  return $customer_unit = ("SELECT a.u_id, a.ident_id, b.u_id, b.cs_id, c.cs_id,
    c.cs_customer_name, c.cs_street, c.cs_zip, d.ort, f.cp_first_name AS Vorname,
    f. cp_last_name AS Nachname, f.phone_a AS Tel1, f.phone_b AS Tel2, f.fax AS fax,
    f.e_mail AS Email, f.notes AS Notes
FROM unit a                                                                     
JOIN unit_link_customer b
ON a.u_id = b.u_id
LEFT JOIN customer c 
ON b.cs_id = c.cs_id
LEFT JOIN customer_contactperson_link e
ON c.cs_id = e.cp_id
LEFT JOIN contact_person f
ON e.cp_c_link_id = f.id
LEFT JOIN ort_plz d
ON c.cs_zip = d.Plz
WHERE a.u_id = '" . $unit_num_id . "'" );       
}

function get_unit_data_acr($unit_num_id)                                        //Funktion 2017010201
{                                                                               //Abfrage Unit Details
  global $get_unit_data_acr;                                                  // mit Hersteller und Kontaktperson  
  return $get_unit_data_acr = ("SELECT a.airdryer, b.ad_sernr AS Seriennr,
    b.ad_build_year AS BJ, c.ad_manufactor_id, c.ad_power AS Leistung,
    c.ad_fr_load AS Menge, g.fr_name AS Frigen,
    c.ad_description AS Typ, c.ad_manufactor_nr, c.ad_current, c.ad_voltage,
    c.ad_e_power, d.name AS Hersteller , d.street, d.cpm_id, f.cp_first_name,
    f.cp_last_name, f.e_mail
FROM `unit_link_tab` a
LEFT JOIN airdryer b ON a.airdryer = b.id_linktab
LEFT JOIN airdryer_typ c ON c.id = b.ad_typ_id
LEFT JOIN manufactor d ON c.ad_manufactor_id = d.id
LEFT JOIN customer_contactperson_link e ON d.cpm_id = e.cpm_id
LEFT JOIN contact_person f ON e.cp_c_link_id = f.id
LEFT JOIN frigen g ON c.ad_fr_id = g.fr_id 
WHERE a.airdryer = '" . $unit_num_id . "' ");
}

function check_kdnr($kunr)
{
    global $customer_id;
    return $customer_id = ("SELECT cs_id FROM customer WHERE cs_id = ' $kunr ' " );
}

function check_h_kdnr($kunr)
{
    global $manufactor_id;
    return $manufactor_id = ("SELECT mf_nr FROM manufactor WHERE mf_nr = ' $kunr ' " );
}

function manufactor()                                                           // function zur Herstellerabfrage 23020801
{
  global  $da;
  return $da = ("SELECT * FROM manufactor ORDER BY name ");
}
function customer()                                                             // function zur Kundenabfrage 23020802
{
    global $dort;
    return $dort = ("SELECT * FROM customer ORDER BY cs_customer_name ");
}

function multiexplode ($delimiters,$string) {                                   // Zerlegen des übermittelten SELECT ARRAYS um die ID zu bekommen
   
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

function istvorhd($var_query){
  global $var_query;
  if(isset($var_query));  
  return TRUE;
}