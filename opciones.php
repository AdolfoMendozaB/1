<!DOCTYPE html >
<html lnag=es>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="distribution" content="all"/>
	<meta name="revisit" content="1 days"/>
	<title>Ministerio Público</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>
<?php 
    include ('cabecera/head.php')
?>
          
<body>
    
    <div class="container">
      <div class="row top-buffer">
        <div class="col-md-10 col-md-offset-1 text-center" >

            <div><button  class="boton" onclick="window.open('ingresar_cedula.php?preferencial=SI','_self');return false;"> PREFERENCIAL </button></div><br>

            <div><button class="boton" onclick="window.open('ingresar_cedula.php?preferencial=NO','_self');return false;"> GENERAL </button></div><br>


        </div>
      </div>       
    </div>   

</body>

    
<?php 
  include ('cabecera/foot.php');
?> 



</body>
</html>


