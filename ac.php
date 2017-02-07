<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$ag_aircondition = ("SELECT a.u_id, c.ac_ag_serial_nr, c.ac_ag_build_year,
    c.ac_ag_frigen_load, d.ac_ag_description, d.ac_ag_current, d.ac_ag_voltage,
    d.ac_ag_e_power, d.ac_ag_k_power, d.ac_ag_weight, e.name, e.street, e.zip_link,
    g.Ort, e.phone_a, e.phone_b, e.fax, e.e_mail, e.notes, f.cp_first_name,
    f.cp_last_name, f.phone_a, f.phone_b, f.fax, f.fax, i.cs_customer_name, i.cs_street, k.cp_first_name, k.cp_last_name
                        FROM unit AS a
                        LEFT JOIN unit_link_aircondition AS b
                        ON ac_id = b.id
                        LEFT JOIN aircondition_ag AS c
                        ON b.ac_ag_id = c.ac_ag_id
                        LEFT JOIN aircondition_typ_ag AS d
                        ON c.ac_ag_typ_id = d.ac_ag_typ_id
                        LEFT JOIN manufactor AS e
                        ON d.ac_ag_manufactor_link_id = e.id
                        LEFT JOIN contact_person AS f
                        ON e.cpm_id = f.cp_c_link_id
                        LEFT JOIN plzort AS g 
                        ON e.zip_link = g.Plz
                        LEFT JOIN unit_link_customer AS h 
                        ON a.u_id = h.u_id
                        LEFT JOIN customer AS i
			ON h.cs_id = i.cs_id
                        LEFT JOIN customer_contactperson_link AS j
			ON i.cp_id_link = j.cp_id
                        LEFT JOIN contact_person AS k 
                        ON j.cp_c_link_id = k.cp_c_link_id
                        WHERE a.u_id = 4713");
                   
