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
    include('conex_2.php');
    
    $fecha = date('Y-m-d');
    $numero = $_POST['cedula'];
    $prioridad = $_POST['preferencial'];
    $conn = conexion();

    $numero2 = substr($numero, -4);

    // BUSQUEDA PARA VALIDAR QUE NO HAYAN TICKETS CON EL MISMO NUMERO

    $sql = "select * from ticket where secuencia='".$numero2."' and atendido='NO'";
    $resul = ExecSQL($conn, $sql);

    if (NumFilas($resul) == 1){

      $errors[] = "YA SE ENCUENTRA";

    }else{
      // SI NO HAY TICKETS CON EL MISMO NÚMERO SE PROCEDE A ALMACENAR EL NUEVO TICKET.
      pg_query("INSERT INTO ticket (secuencia,taquilla,fecha, prioridad, atendido, orden, id_estado, id_sede, timbre) values ('$numero2','0','$fecha','$prioridad', 'NO', '0', '1', '1' , 'FALSE')");
    };

    include ('cabecera/head.php')
?>
          
<body>

      <?php if (isset($errors)){?>

      <div class="container">
        <div class="row top-buffer">
          <div class="alert alert-danger" role="alert">
           <strong><center><h2>
          <?php
            foreach ($errors as $error) {
                echo $error;
              }
            ?>
            </h2></center></strong>
         </div>
        </div>
      </div>

      <?php
      }else{?>

      <div class="container">
        <div class="row top-buffer">
          <div class="alert alert-info" role="alert">
              <strong><center><h2> TICKET</h2></center></strong>
              <strong><center><h2> <?php echo $numero2; ?> </h2></center></strong>
          </div>
        </div>
      </div>

        <?php
      }
?>




</body>

    
<?php 
  include ('cabecera/foot.php');
?> 


</body>
</html>


  