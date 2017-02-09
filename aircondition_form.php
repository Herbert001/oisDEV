?>
<!-- Ausgabe Formular in addunit_2.php -->
 <p><br /></p>

<div class="container">
 <div class="row">
   <div class="col-md-2">Test</div>
    <div class="col-md-10">
      <div class="panel panel-info box-border">
      <div class="panel-heading">Anlage hinzufügen</div>
      <div class="panel-body panel-info">
       <form class="form-horizontal" data-toggle="validator" role="form" id ="form" name="form" action="send_formdata_neuerKunde2.php" method="POST" >
        <div class="form-group">
      <label for="kundnr" class="col-sm-2 control-label">UnitID
    <span class="asteriskField">*
    </span>
    </label>
    <div class="col-sm-10">
      <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-hashtag fa-fw"></i>
       </div>
        <input type="text" class="form-control" name="u_id" id="u_id" value="<?php echo $form_id; ?>" placeholder="Kundennummer" readonly disabled />
      </div>
        <!--Ausgabe Fehlermeldung -->
         <div id="feedback"></div>
         <div class="help-block with-errors"></div>
        <!--Ende Ausgabe -->
    </div>
   </div>
  <div class="form-group">
    <label for="firma" class="col-sm-2 control-label">Firmenname</label>
    <div class="col-sm-10">
     <div class="input-group">
      <div class="input-group-addon">
       <i class="fa fa-building fa-fw" aria-hidden="true" ></i>
      </div>
       <input type="text" class="form-control" name="k_name_company" title="Bei Privatperson vollständigen Namen angeben!" id="firma" value="<?php echo $kd_nr_ex[0]; ?>" placeholder="Firmenname oder vollen Vor-, Nachnamen" readonly disabled/>
     </div>
        <!--Ausgabe Fehlermeldung -->
        <div class="help-block with-errors"></div>
        <!--Ende Ausgabe -->
    </div>
</div>

  <div class="form-group">
    <label for="street" class="col-sm-2 control-label">Anlagentyp</label>
    <div class="col-sm-10">
     <div class="input-group">
      <div class="input-group-addon">
       <i class="fa fa-industry fa-fw" aria-hidden="true"></i>
      </div>
         <input type="text" class="form-control" name="a_typ" id="a_typ" value="<?php echo $cat_id[1];?>" bg-primary readonly disabled />
     </div>
      <!--Ausgabe Fehlermeldung -->
       <div class="help-block with-errors"></div>
      <!--Ende Ausgabe -->
     </div>
  </div>
        <div class="row">
            <div class="col-md-12">
  <div class="form-group">
    <label for="plz" class="col-sm-2 col-xs-2 control-label">Typ Aussengerät</label>
    <div class="col-sm-10 col-md-10 col-xs-2">
     <div class="input-group">
         <div class="input-group-addon">
       <i class="fa fa-codepen fa-fw" aria-hidden="true"></i>
         </div>
      <input type="text" class="form-control" name="typ_ag" id="typ_ag" data-minlength="2" required="" placeholder="Ausseneinheit" />
     </div>
       <!--Ausgabe Fehlermeldung -->
        <div class="help-block with-errors"></div>
       <!--Ende Ausgabe -->
    </div>
  </div>
    <div class="form-group">
      <label for="ort" class="col-sm-2 col-xs-2 control-label">Typ Innengerät</label>
      <div class="col-sm-10 col-md-10 col-xs-2">
       <div class="input-group">
        <div class="input-group-addon">
         <i class="fa fa-codepen fa-fw" aria-hidden="true"></i>
        </div>
         <input type="text" class="form-control" name="typ_ig" id="typ_ig" required="" data-required-error="Pflichtfeld" placeholder="Inneneinheit" />
       </div>
        <!--Ausgabe Fehlermeldung -->
        <div class="help-block with-errors"></div>
        <!--Ende Ausgabe -->
       </div>
     </div>
          <!-- THIS needs to be hidden in firstplace -->

  <div class="form-group">
    <label for="tel" class="col-sm-2 control-label">Typ Innengerät 2</label>
    <div class="col-sm-10">
     <div class="input-group">
      <div class="input-group-addon" aria-hidden="true">
       <i class="fa fa-phone fa-fw"></i>
      </div>
      <input type="text" class="form-control" name="typ_ig_2" required="" id="typ_ig_2"  />
     </div>
        <!--Ausgabe Fehlermeldung -->
        <div class="help-block with-errors"></div>
            <!--Ende Ausgabe -->
     </div>
  </div>
          <!-- THIS needs to be hidden -->
<div class="form-group">
    <label for="tel" class="col-sm-2 control-label">Telefonnummer 2</label>
    <div class="col-sm-10">
     <div class="input-group">
      <div class="input-group-addon" aria-hidden="true">
     <i class="fa fa-phone fa-fw"></i>
     </div>
      <input type="text" class="form-control" name="k_tel_company2" id="tel2" placeholder="Telefonnummer2" />
</div>
        <!--Ausgabe Fehlermeldung -->
        <div class="help-block with-errors"></div>
            <!--Ende Ausgabe -->
</div>
</div>
  <div class="form-group">
    <label for="mail" class="col-sm-2 control-label">E-Mail</label>
    <div class="col-sm-10">
     <div class="input-group">
      <div class="input-group-addon" aria-hidden="true">
     <i class="fa fa-envelope fa-fw"></i>
     </div>
      <input type="email" data-error="Keine gültige Adresse" class="form-control" name="k_mail_company" id="mail" placeholder="E-mail" />
</div>
               <!--Ausgabe Fehlermeldung -->
        <div class="help-block with-errors"></div>
            <!--Ende Ausgabe -->
</div>
</div>
  <div class="form-group">
    <label for="fax" class="col-sm-2 control-label">Fax</label>
    <div class="col-sm-10">
     <div class="input-group">
      <div class="input-group-addon" aria-hidden="true">
     <i class="fa fa-fax fa-fw"></i>
     </div>
      <input type="text" class="form-control" name="k_fax_company" id="fax" placeholder="Faxnummer" />
</div>
        <!--Ausgabe Fehlermeldung -->
        <div class="help-block with-errors"></div>
            <!--Ende Ausgabe -->
</div>
</div>
  <div class="form-group">
    <label for="notes" class="col-sm-2 control-label">Notes</label>
    <div class="col-sm-10">
     <div class="input-group">
      <div class="input-group-addon" aria-hidden="true">
     <i class="fa fa-info fa-fw"></i>
     </div>
      <textarea class="form-control" rows="3" name="k_notes_company" id="notes" placeholder="textbox"></textarea>
</div>
</div>
</div>
<p></p>
<a class="btn btn-primary pull-left" href="addunit_1.php">Neue Anlage anlegen</a>
<button type="submit" name="submit" id="submit" class="btn pull-right btn-primary">Give it to me</button>
    </form>
  </div>
  </div>
</div>
                 </div>
                     </div></div></div>

