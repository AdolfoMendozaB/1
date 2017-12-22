<!DOCTYPE html PUBLIC>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="distribution" content="all"/>
    <meta name="revisit" content="1 days"/>
    <title>Ministerio Público</title>
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="css/estilos.css" type="text/css" rel="stylesheet">
<link href="css/jquery-ui-1.8.15.custom.css" rel="stylesheet"/>
<link href="css/keyboard.css" rel="stylesheet"/>
<script src="js/jquery.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.keyboard.js"></script>
<script src="js/jquery.mousewheel.js"></script>
<script src="js/jquery.keyboard.extension-typing.js"></script>
<script src="js/jquery.keyboard.extension-autocomplete.js"></script>
<script src="js/jquery.jatt.min.js"></script>

<script language="JavaScript" type="text/javascript">
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
<body>
<?php
include("conex.php");
include ('cabecera/head.php');

$conn = conexion();
$dependencias_id = $_GET['dependencias_id'];

$sql = "select dc.descripcion, dc.descripcion_dependencia, dc.competencia, dc.numero_despacho, dc.descripcion_estado, dc.descripcion_ciudad, dc.descripcion_municipio, dc.telefono, dc.latitud, dc.longitud, dc.descripcion_parroquia, dc.direccion_sede, dc.despacho from competencias_despachos_coordenadas as dc where id=".$dependencias_id."";

  				$resul = ExecSQL($conn, $sql);
                if (NumFilas($resul) > 0) {
                            ?>
                            
                        <div class="container">
                            <div class="row tabla-buffer">

                                <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </tfoot>
                                </table>

                                <table class="table" style="margin-left:150px;">
                                    <tr>
                                        <th>DESCRIPCION</th>
                                        <th>CIUDAD</th>
                                        <th>MUNICIPIO</th>
                                        <th>PARROQUA</th>
                                        <th>TELEFONOS</th>
                                        <th>TIPO FISCALIA</th>
                                    </tr>

                                    <?php while ($valor = obResultadoN($resul)){?>

                                    <tr>
                                        <td><?php echo $valor['descripcion'] ?></td>
                                        <td><?php echo $valor['descripcion_ciudad'] ?></td>
                                        <td><?php echo $valor['descripcion_municipio'] ?></td>
                                        <td><?php echo $valor['descripcion_parroquia'] ?></td>
                                        <td><?php echo $valor['telefono'] ?></td>
                                        <td><?php echo $valor['despacho'] ?></td>
                                    </tr>
                                    <?php 
                                            $latitud = $valor['latitud'];
                                            $longitud = $valor['longitud'];
                                    } ?> 
                                </table>
                            </div>
                        </div>
                        <?php
                         ?>

        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmxuq1GhG16VwdJ2X60B-ioLfG6CHaeDM&callback=direccion"
          type="text/javascript"></script>
                <script type="text/javascript">
                        function direccion() {
                            var latlng = new google.maps.LatLng(<?php echo $latitud?> , -<?php echo $longitud ?>);
                            
                            var settings = {
                                zoom:17,
                                center: latlng
                            };

                        var map=new google.maps.Map(document.getElementById("googleMap"),settings);
                        var companyImage = new google.maps.MarkerImage('../imagenes/logo_mapa.png',
                        new google.maps.Size(509,50),
                        new google.maps.Point(0,0),
                        new google.maps.Point(50,50)
                        );

                            var marker = new google.maps.Marker({
                            position: latlng,
                            map: map,
                          });  
                        }
                </script>                    
                    <center>       
                        <div class="img-responsive" >          
                            <div id="googleMap" style="width:900px;height:500px; margin-top:20px;"></div><br>
                        </div>
                    </center>

                    <?php } ?>                                                                        

        <?php
            include ('cabecera/foot.php');
        ?>
</body>
</html>