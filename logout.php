<?php
/**
 * Created by PhpStorm.
 * User: KarstensIMAC
 * Date: 03.08.16
 * Time: 21:34
 */

session_start();

if(isset($_SESSION['usr_id'])) {
    session_destroy();
    unset($_SESSION['usr_id']);
    unset($_SESSION['usr_name']);
    unset($_SESSION['uids']);
    unset($_SESSION['logerror']);
        header("Location: index.php");
} else {
    session_destroy();
    unset($_SESSION['usr_id']);
    unset($_SESSION['usr_name']);
    unset($_SESSION['uids']);
    unset($_SESSION['logerror']);
        header("Location: index.php");
 }
    

?>