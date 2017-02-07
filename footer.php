<?php session_start(); ?>
<script type="text/javascript">
        $(function() {
$('[data-tooltip="true"]').tooltip();
});
</script>            

<!-- Modal -->
<div class="modal fade" id="maintenance" tabindex="-1" role="dialog" aria-labelledby="einModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="einModalLabel">Wartungskomponenten</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
  <h2>UNM 660-10-270</h2>
  <p></p>            
  <table class="table">
    <thead>
      <tr>
        <th>Bezeichnung</th>
        <th>Größe, Ausführung</th>
        <th>Artikel Nr.:</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Keilriemen</td>
        <td>SPZ 1600</td>
        <td>1005214</td>
      </tr>
      <tr>
        <td>Luftfilter</td>
        <td>100 x 50</td>
        <td>G475894</td>
      </tr>
      <tr>
        <td>Hubkolbenöl</td>
        <td>2 Ltr</td>
        <td>DeteD</td>
      </tr>
    </tbody>
  </table>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
        
      </div>
    </div>
  </div>
</div>
<?php
echo "<div class='footer navbar-fixed-bottom'>";
        if($_SESSION['loginTRUE'] = TRUE){
            $lastlogin = $_SESSION['lastlogin']->format('d.m.y');
            $lastlogint = $_SESSION['lastlogin']->format('H:i');
?>            
            <div class="col-md-8">
 <?php echo "Hallo " .$_SESSION['usr_name'];
            echo ", Dein letzter Login war am ".$lastlogin ;
            echo " um " .$lastlogint .'Uhr.';
  ?>          
            </div>
  <div class="col-md-4">
    <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-tooltip="true" data-target="#maintenance" title="Wartungskomponenten" aria-label="Wartungskomponenten">
      <span class="fa fa-wrench fa" aria-hidden="true"></span>
    </button>
  </div>
<?php                      
        }
        else{
            echo "Niemand angemeldet!";
        };
 ?>

</div>
    </body>
</html>
