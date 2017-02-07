<!DOCTYPE html>
<html>
    <head>
        <title> DeTec UnitDataInfoSystem ALPHA #0.7.2</title>
        <meta name= "viewport" content = "width=device-width, initial-scale=1.0">
        <link href = "css/bootstrap.css" rel = "stylesheet">
        <link href = "css/styles.css" rel = "stylesheet">
    </head>
    <body>
	
        <?php require 'connectdb.php';
        $kunde = $_GET["knr"];
		$_GET["uid"];
		?>
        <nav class= "navbar navbar-inverse navbar-fixed-top">
            <div class = "container-fluid">
                <div class = "navbar-header">
                <button type = "button" class = "navbar-toggle" data-toggle = "collapse" data-target ="#mainNavbar">
                    <span class = "icon-bar"></span>
                    <span class = "icon-bar"></span>
                    <span class = "icon-bar"></span>
                </button>
                <div class = "navbar-brand">
                   OnlineUnitInformationSystem
                   <div class = "text-info">v. ALPHA070216 &copyKarsten Kluge</div>
               </div>
               
               </div>
                    <!-- Menu -->
                    <div class = "collapse navbar-collapse" id = "mainNavbar">
                        <ul class = "nav navbar-nav navbar-right">
                            <li><a href="#">Kundendaten</a></li>
                            <li><a href="#">Anlagendaten</a></li>
                            <li><a href="#">Details</a></li>
                            <li><a href="#">Historie</a></li>
                            <li><a href="#">Fehlercodes</a></li>
                            <!--DropdownMenu -->
                            <li class = "dropdown">
                                <a href="#" class = "dropdown-toggle" data-toggle="dropdown">Nochwas <span class= "caret"></span></a>
                                <ul class = "dropdown-menu">
                                    <li><a href="#">Bilder</a></li>
                                    <li><a href="#">Hersteller</a></li>
                                    <li><a href="#">Kontaktdaten</a></li>
                                </ul>
                            </li>
                        </ul> 
                    </div>
            </div>
        </nav>
        <div class="jumbotron text-left">
            <div class="container">
  <h1 class="mod1">
  
      <?php if($result = $db->query("SELECT tab1_kunde.k_id, tab1_kunde.k_name_company
	  

        FROM tab1_kunde
        WHERE k_id = ".$kunde." "
    ))
        if($result->num_rows)
        {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach($rows as $row)
        {
            echo $row['k_name_company']; // <!-- Auswahl der Firma über GET Parameter vom Browser gesendet -->
        }
        };?></h1>
  <p>... <?php echo $_GET["knr"] ;?></p>
  <p><a class="btn btn-primary btn-lg" href="#" role="button">Mehr erfahren</a></p>
        </div>
        </div>
        
        <script src = "https://code.jquery.com/jquery-1.9.1.js"></script>
        <script src ="js/bootstrap.js"></script>
    </body>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
</html>