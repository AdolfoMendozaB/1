<!DOCTYPE html >
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
    <script type="text/javascript" src="js/webcam.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.mousewheel.js"></script>
    <script src="js/jquery.jatt.min.js"></script>
    <script src="js/tracking-min.js"></script>
    <script src="js/face-min.js"></script>




<?php 
include("conex.php");
$conn = conexion();
$cedula = $_POST['cedula'];


$sql = "select d.dependencias_id, d.fdistribucion,dpen.descripcion as dependencia,d.numero_unico, dpen.estado_descripcion as estado_dpen from distribucion.personas_distribucion pd

inner join distribucion.distribucion d on d.id=pd.distribucion_id
inner join dependencias dpen on dpen.id=d.dependencias_id
where pd.cedula=".$cedula." order by fdistribucion desc limit 3 ";

$resul = ExecSQL($conn, $sql);

include ('cabecera/head.php');


?> 

</head>


<body>
  <div class="demo-frame">
    <div class="demo-container">

      <div class="container">
        <div class="row top-buffer">
          <div class="alert alert-info" role="alert">
              <strong><center>Por favor, observe la camara que esta en la parte superior de la pantalla.</center></strong>
          </div>
        </div>
      </div>


      <video id="video" width="320" height="240" preload autoplay loop muted></video>
      <canvas id="canvas" width="320" height="240"></canvas>
    </div>
  </div>


    <script type="text/javascript">
        var cedula = <?php echo $cedula;?>
    </script>

    <?php 

      if (!NumFilas($resul) == 0) {

     ?>

  <script type="text/javascript">




  window.onload = function loadDefFrame() {
   setTimeout(function () {
   camara();
  },7000)};

  function camara() {        
 
      var video = document.getElementById('video');
      var canvas = document.getElementById('canvas');
      var context = canvas.getContext('2d');
        canvas.width = 400;
        canvas.height = 300;
      canCapture = true;

      var tracker = new tracking.ObjectTracker('face');
      tracker.setInitialScale(4);
      tracker.setStepSize(2);
      tracker.setEdgesDensity(0.1);

      var trackerTask = tracking.track('#video', tracker, {
        camera: true,
        fps: 10,
        scaled: true });

      tracker.on('track', function(event) {
        context.clearRect(0, 0, canvas.width, canvas.height);

        event.data.forEach(function(rect) {
          context.strokeStyle = '#a64ceb';
          context.strokeRect(rect.x, rect.y, rect.width, rect.height);
          context.font = '11px Helvetica';
          context.fillStyle = "#fff";
          context.fillText('x: ' + rect.x + 'px', rect.x + rect.width + 5, rect.y + 11);
          context.fillText('y: ' + rect.y + 'px', rect.x + rect.width + 5, rect.y + 22);
        
   
        
        context.drawImage(video, 0, 0, canvas.width, canvas.height);


        var dataURI = canvas.toDataURL();


      $.ajax({
        type: "POST",
        url: "resultado_buscar_cedula.php",
        data: {image: dataURI, cedula: cedula},
        success:function(data){
            trackerTask.stop();
            location.href='resultado_buscar_cedula.php?cedula='+cedula;
        }
      });

        });
      });       
      
    };



  </script>

    <?php
        }else{?>
        
          <script type="text/javascript">

                location.href='resultado_buscar_cedula.php?cedula='+cedula;

          </script>

        <?php }
            include ('cabecera/foot.php');
        ?>

</body>
</html>