<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>The jquery test</title>
  <meta name="description" content="The jquery testd">
  <meta name="author" content="SitePoint">

  <link rel="stylesheet" href="">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
<script
  src="https://code.jquery.com/jquery-3.1.1.slim.js"
  integrity="sha256-5i/mQ300M779N2OVDrl16lbohwXNUdzL/R2aVUXyXWA="
  crossorigin="anonymous"></script>

</head>


<body>
  <script src="js/scripts.js"></script>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="formular">
<input type="text" id="textfeld" />
<input type="submit" id="button" value="Give it to me"/>
<br /><p>.</p>
<input type="text" id="feld" />
<input type="submit" id="button2" value="slide" style="position:relative;" />
</form>

<script type="text/javascript">
    $(function(){
     $('#button').prop('disabled', true);
        
     
       $('#textfeld').on('keyup', function (){
       if ($('#textfeld').val() .length >3){
           $('#button').prop('disabled', false);
}else{
         $('#button').prop('disabled', true);
    }
    });
    })
    
    // button 2 slide hide
    $('#button2').hide();
    $('#feld').on('click', function(){
        $('#button2').show();
    })
    
    
    
</script>


</html>


