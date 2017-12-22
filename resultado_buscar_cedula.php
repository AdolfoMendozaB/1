<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="distribution" content="all"/>
    <meta name="revisit" content="1 days"/>
    <title>Ministerio Público</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilos.css" type="text/css" rel="stylesheet">
    
    <!--Estilos Tabla-->
    <link rel="stylesheet" type="text/css" href="css/styletable.css">
    <link rel="stylesheet" type="text/css" href="css/styletable2.css">

    <script type="text/javascript" src="js/tabla.js" ></script>
    <script type="text/javascript" src="js/tabla2.js" ></script>
    <script type="text/javascript" src="js/tabla3.js" ></script>
<link href="css/jquery-ui-1.8.15.custom.css" rel="stylesheet"/>
<link href="css/keyboard.css" rel="stylesheet"/>
<script src="js/jquery.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.mousewheel.js"></script>
<script src="js/jquery.jatt.min.js"></script>
<script type="text/javascript" src="js/webcam.js"></script>

<script>
    /*function redireccionar() 
    {
        location.href="index.php"
    } 
    var temp = setTimeout ("redireccionar()", 80000);


    document.addEventListener("click", function() {
    // borrar el temporizador que redireccionaba
    clearTimeout(temp);
    // y volver a iniciarlo
    temp = setTimeout("redireccionar()", 80000);
    })*/
   
</script>

</head>

<?php
function DMY($fecha) {
    list($anio, $mes, $dia) = explode("-", $fecha);
    return $dia . "/" . $mes . "/" . $anio;
}

// CONEXION
include("conex.php");
$conn = conexion();

// BUSQUEDA
if (isset($_POST['cedula'])){
    $cedula_foto=$_POST['cedula'];}

    $ced=$_GET['cedula'];

    $sql = "select d.dependencias_id, d.fdistribucion,dpen.descripcion as dependencia,d.numero_unico, dpen.estado_descripcion as estado_dpen from distribucion.personas_distribucion pd

inner join distribucion.distribucion d on d.id=pd.distribucion_id
inner join dependencias dpen on dpen.id=d.dependencias_id
where pd.cedula=".$ced." order by fdistribucion desc limit 3 ";

$sqlN = "select pd.nombres, pd.apellidos, pd.cedula from distribucion.personas_distribucion pd where pd.cedula=".$ced."";
$resul = ExecSQL($conn, $sql);
$resulN = ExecSQL($conn, $sqlN);

// GUARDAR FOTO
if ( isset($_POST["image"]) && !empty($_POST["image"]) ) {
    $img = $_POST['image'];

$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$fileData = base64_decode($img);

$hora= date ("h:i:s");
$fecha= date ("j-n-Y");
$filename = $cedula_foto;
$foto = "$filename-$hora-$fecha";
    file_put_contents("imagenes/pictures/$foto.png", $fileData );
}
?>

<body>
    <?php 
        include ('cabecera/head.php');
    ?>           
        <?php
        if (!NumFilas($resul) > 0) {
        ?>           
            <div class="container">
                <div class="row center-buffer">
                    <div class="alert alert-danger" role="alert">
                            <strong><center>No existen casos relacionados con el número de cédula ingresado.</center></strong>
                    </div>

                    <center><button class=" boton" onclick="window.open('buscar_cedula.php','_self');return false;"> REGRESAR </button></center>
                </div>
            </div>
        <?php
        } else {
            $datos = obResultadoN($resulN)
        ?>

                <div class="container">
                        <center><div><h4>DETALLE DEL CASO DE: <?php echo $datos['nombres']."  ".$datos['apellidos'].".  "."CI:  ".$datos['cedula']; ?></h4></div><br/></center>                
                    <div class="container">
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <tr>                                                    
                                <th>MP</th>
                                <th>Fecha Distribución</th>
                                <th>Despacho Fiscal</th>
                                <th>Dirección</th>
                                <th>Ver Ubicación</th>
                            </tr>
                        <?php

                        while ($valor = obResultadoN($resul)) {?>
                            <tr>
                                <td><h3><?php echo $valor['numero_unico']; ?></h3></td>
                                <td><h3><?php echo DMY($valor['fdistribucion']); ?></h3></td>
                                <td><h3><?php echo $valor['dependencia']; ?></h3></td>
                                <td><h3><?php echo $valor['estado_dpen'];?></h3></td>
                                <td>
                                    <button class="boton" onclick="window.open('ver_direccion.php?dependencias_id=<?php echo $valor["dependencias_id"];?>','_self');return false;"> UBICACIÓN</button>
                                </td>
                            </tr>
                        <?php } ?>
                        </table>
                    </div>
                    <?php } ?>
                </div>
        <?php 
            include ('cabecera/foot.php');
        ?>
    <div class="navbar-fixed-bottom foot" >       
        <ul class="navbar-brand navbar-left" style="margin-bottom:60px;">
            <button class="boton" onclick="window.open('buscar_cedula.php','_self');return false;"> Buscar Nuevo Caso</button>
        </ul>        
    </div>

</body>
</html>