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

<?php

include("conex.php");
// **** CONEXION
$conn = conexion();
$latitud = $_GET['latitud'];
$longitud= $_GET['longitud'];

include ('cabecera/head.php');

?>


<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmxuq1GhG16VwdJ2X60B-ioLfG6CHaeDM&callback=direccion"
  type="text/javascript"></script>


<script type="text/javascript">



        function direccion() {
            var latlng = new google.maps.LatLng(<?php echo $latitud?> ,-<?php echo $longitud ?>);
            
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


    function redireccionar() 
    {
        location.href="index.php"
    } 
    var temp = setTimeout ("redireccionar()", 60000);


    document.addEventListener("click", function() {
    // borrar el temporizador que redireccionaba
    clearTimeout(temp);
    // y volver a iniciarlo
    temp = setTimeout("redireccionar()", 60000);
})



</script>
</head>
<body>
    
    <center>       
        <div class="img-responsive" >          
            <div id="googleMap" style="width:1000px;height:600px; margin-top:50px;"></div><br>
        </div>


        <div>
            <button class="boton" onclick="window.open('index.php','_self');return false;"> SALIR </button>
        </div>
    </center>

    

    <?php 
        include ('cabecera/foot.php');
    ?>
    
</body>
</html>