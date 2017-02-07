
 <?php require 'connectdb.php';?>

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
                            <li class ="dropdown">
                                <a href="#" class = "dropdown-toggle" data-toggle= "dropdown">Kunden 
                                    <spawn class= "caret"</spawn></a>
                                     <ul class="dropdown-menu">
                                         <li><a href = "Kunde_add2.php">Kunden anlegen</a></li>
                                        <li><a href = "#">Kunden löschen</a></li>
                                        <li><a href = "#">Kunden aufrufen</a></li>
                                        <li><a href = "#">Kunden --------</a></li>
                                     </ul>
                            </li>

                            <li class ="dropdown">
                                <a href="#" class = "dropdown-toggle" data-toggle= "dropdown">Anlagen 
                                    <spawn class= "caret"</spawn></a>
                                     <ul class="dropdown-menu">
                                         <li><a href = "addunit_1.php">Anlagen anlegen</a></li>
                                        <li><a href = "#">Anlagen löschen</a></li>
                                        <li><a href = "#">Anlagen aufrufen</a></li>
                                        <li><a href = "#">Anlagen --------</a></li>
                                     </ul>
                            </li>

                            <li class ="dropdown">
                                <a href="#" class = "dropdown-toggle" data-toggle= "dropdown">Hersteller 
                                    <spawn class= "caret"</spawn></a>
                                     <ul class="dropdown-menu">
                                        <li><a href = "Hersteller_add.php">Hersteller anlegen</a></li>
                                        <li><a href = "#">Hersteller löschen</a></li>
                                        <li><a href = "#">Hersteller aufrufen</a></li>
                                        <li><a href = "#">Hersteller --------</a></li>
                                     </ul>
                            </li>

                            <li class ="dropdown">
                                <a href="#" class = "dropdown-toggle" data-toggle= "dropdown">Kontaktperson 
                                    <spawn class= "caret"</spawn></a>
                                     <ul class="dropdown-menu">
                                        <li class="dropdown-header">Kontakt Hersteller</li>
                                        <li><a href = "Kontaktperson_H_add.php">Kontaktperson Hersteller anlegen</a></li>
                                        <li><a href = "#">Kontaktperson Hersteller löschen</a></li>
                                        <li><a href = "#">Kontaktperson Hersteller aufrufen</a></li>
                                        <li><a href = "#">Kontaktperson Hersteller --------</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li class="dropdown-header">Kontakt Kunde</li>
                                        <li><a href = "Kontaktperson_K_add.php">Kontaktperson Kunde anlegen</a></li>
                                        <li><a href = "#">Kontaktperson Kunde löschen</a></li>
                                        <li><a href = "#">Kontaktperson Kunde aufrufen</a></li>
                                        <li><a href = "#">Kontaktperson Kunde --------</a></li>
                                     </ul>
                            </li>
                            <li>  </li>
                            <!--DropdownMenu -->
                            <li class = "dropdown">
                                <span>  <p class="navbar-btn">
                                    <a href="logout.php" class="btn btn-danger btn-sm navbar-btn">LOGOUT</a>
                                    &nbsp;
                                    </p>
                                </span>
<!--                                <a href="#" class = "dropdown-toggle" data-toggle="dropdown">Nochwas <span class= "caret"></span></a>
                                <ul class = "dropdown-menu">
                                    <li><a href="#">Bilder</a></li>
                                    <li><a href="#">Hersteller</a></li>
                                    <li><a href="#">Kontaktdaten</a></li>
                                </ul>-->
                            </li>
                        </ul> 
                    </div>
            </div>
        </nav>
    <script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip({ 
          placement : "auto",
          animation: "true",
          delay: {show:200, hide:700}
    });
 });
   </script>
        
