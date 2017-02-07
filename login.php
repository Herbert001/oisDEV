<?php
session_start();
include_once 'connectdb.php';

if (empty($_POST['email'] || $_POST['password'])){
    $errormsg = "Name oder Email sind nicht autorisiert!<br />"
                . "Für weitere Informationen 05231 / 9807625";
    $_SESSION['logerror'] = $errormsg;
    header("Location: index.php?uid=". $_SESSION['uids'] ."");
    exit;
}

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $password = md5($password);
    $unit_id = $_SESSION['uids'];
            
    $res=  "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    
    
    if($result = $db->query($res))
    {    
        if($result->num_rows > 0)
        {   
            $loginsuccess = TRUE;
            $_SESSION['loginTRUE'] = $loginsuccess;
            $rows = $result->fetch_all(MYSQLI_ASSOC);
                foreach($rows as $row)
                    {
                        $_SESSION['usr_id'] = $row['id'];
                        $_SESSION['usr_email'] = $row['email'];
                        $_SESSION['usr_name'] = $row['name'];
//                        $_SESSION['lastlogin'] = $row['last_login'];
                        $unitid = htmlspecialchars($_GET['uid']);
                        $_SESSION['lastlogin'] = new DateTime($row['last_login']);
   
                        //$_SESSION['uids'] = $unit_id;
                        header("Location:Dataunitsmall.php?uid=". $unit_id."");
                        $db->query("UPDATE user SET last_login=NOW() WHERE id= '" .$_SESSION['usr_id']. "'"); //Update letzter Login
                        exit;   
                    }
                
        }   else
                    {
                        header("Location: index.php?uid=" . $_SESSION['uids'] . "");
                       echo "<script> alert('INVALID USERNAME OR PASSWORD');</script>";
			                                      
                        $errormsg = "Name oder email sind nicht autorisiert!<br />"
                                . "Für weitere Informationen 05231 / 9807625";
			$_SESSION['logerror'] = $errormsg;
                        exit;
                        
                    }
    }
}



