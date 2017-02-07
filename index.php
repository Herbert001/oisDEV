<?php
session_start();
error_reporting(1);
if(isset($_SESSION['usr_id'])) 
    {
        header("Location: Dataunitsmall.php?uid=". $_SESSION['uids']."");
        exit;
    }
if(!empty($_GET['uid']))
    {
    $unitid = htmlspecialchars($_GET['uid']);
    $_SESSION['uids']= $unitid ;
    }

include_once 'connectdb.php';

//check if form is submitted

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <!-- Bootstrap and Fontawesome, CSS-->
    <link href="inc/css/bootstrap.min.css" rel="stylesheet">
    <link href = "inc/css/styles.css" rel = "stylesheet">
    <link href = "inc/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>

 <?php include 'header2.php';   ?>     


<div class="container">
    <div class="row logintop">
        <div class="col-md-4 col-sm-4 col-xs-10 col-md-offset-4 col-sm-offset-4 col-xs-offset-1 well">
            <form role="form" action="login.php" method="POST" name="loginform">
                <fieldset>
                    <legend>Login</legend>

                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="text" name="email" placeholder="Registrierte E-Mail" required class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" name="password" placeholder="Passwort" required class="form-control" />
                    </div>

<!--                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="hidden" name="uid" value="<?php echo $unitid; ?>" required class="form-control" />
                    </div>-->
                    
                    <div class="form-group">
                        <input type="submit" name="login" value="Login" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
            <span class="text-danger"><?php if (isset($_SESSION['logerror'])) { echo $_SESSION['logerror']; } ?></span>
            <br />  <a href="logout.php">LOGOUT</a>
            <?php var_dump($_SESSION['uids']). "<br />";
            var_dump($_SESSION['usr_id']);
             ?>
             
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="inc/js/bootstrap.min.js"></script>
</body>
</html>