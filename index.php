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

            <div><center>
              <img src="imagenes/consultar_denuncias.png" style="width:100px; margin-right:230px;">
              <img src="imagenes/buscar_fiscalia.png" style="width:100px; margin-right:180px;">
              <img src="imagenes/atencion_ personal.png" style="width:100px;">
            </center></div><br>

            <div><center>

            <button  class="boton" onclick="window.open('buscar_cedula.php','_self');return false;"> CONSULTAR DENUNCIAS </button>

            <button class="boton" style="margin-left:20px;" onclick="window.open('mapa.php?id=0','_self');return false;"> BUSCAR FISCALIA </button>

            <button class="boton" style="margin-left:20px;" onclick="window.open('opciones.php','_self');return false;"> ATENCIÓN PERSONAL </button>

            </center></div>

      </div>       
    </div>   

</body>

    
<?php 
  include ('cabecera/foot.php');
?> 


</body>
</html>


