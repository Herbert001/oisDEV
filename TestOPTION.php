<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap Starter Template</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<?php require 'connectdb.php';
      require 'inc/func/function.php';
  ?>
  
  
  <form class="form-horizontal" role="form" id ="form" name="form" action="Formulartest.php" method="POST" >

<div class="form-group">
  <label for="Vorname" class="col-sm-2 control-label">Firma</label>
    <div class="col-sm-10">
      <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-hashtag fa-fw"></i> 
       </div>  
        <select type="text" class="form-control" name="selectname" id="name" value="" autofocus="" placeholder="Firma" />
         
         
          <?php    // Abfrage generieren
     manufactor(); // Function Nr.: 23020801 $da 
              $ergebnisvonHerstellern= $db->query($da);
              // Ausgabe über while Schleife, da mehr als ein Ergebnis erwartet wird
          while($endresult = $ergebnisvonHerstellern->fetch_array() ) {
          echo "<option> {$endresult['id']} | {$endresult['name']}</option>";
          }
        ?>
        
        </select>
      </div>
        <!--Ausgabe Fehlermeldung -->             
         <div class="help-block"></div>
        <!--Ende Ausgabe -->
    </div> 
   </div>  
  
<div class="form-group">
  <label for="Vorname" class="col-sm-2 control-label">Vorname</label>
    <div class="col-sm-10">
      <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-hashtag fa-fw"></i> 
       </div>  
        <input type="text" class="form-control" name="cp_first_name" id="firstname" value="<?php echo $cp_first_name; ?>" autofocus="" placeholder="Vorname" />
      </div>
        <!--Ausgabe Fehlermeldung -->             
         <div class="help-block"></div>
        <!--Ende Ausgabe -->
    </div> 
   </div>
  <button type="submit" name="submit" id="submit" class="btn pull-right btn-primary">TEST</button>
  </form>
 
    
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">
        <br><br><br>
        <h1>Bootstrap Starter Template</h1>
        <p class="lead">Use this document as a way to quickly start any new project.
            <br> All you get is this text and a mostly barebones HTML document.</p>
    </div>
    <!-- /.container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

Ausgabe Kunde und Kontaktperson(en)
<?php $queryKunde = ("SELECT customer.cs_id, customer_contactperson_link.cp_id,
                             customer_contactperson_link.cp_c_link_id,
                             contact_person.id, customer.cs_customer_name AS Kunde,
                             contact_person.cp_last_name FROM customer
                             LEFT JOIN customer_contactperson_link ON
                             customer.cs_id = customer_contactperson_link.cp_id
                             LEFT JOIN contact_person ON
                             customer_contactperson_link.cp_c_link_id =
                             contact_person.id WHERE customer.cs_id = 10095");

?>






</body>


</html>