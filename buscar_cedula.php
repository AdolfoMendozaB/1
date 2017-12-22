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
    <link rel="stylesheet" type="text/css" href="css/estilos.css">

<link href="css/jquery-ui-1.8.15.custom.css" rel="stylesheet"/>
<link href="css/keyboard.css" rel="stylesheet"/>
<link href="teclado/demo.css" rel="stylesheet" type="text/css" >
<script src="js/jquery.js"/></script>
<script src="js/jquery-ui.min.js"/></script>
<script src="js/jquery.keyboard.js"/></script>
<script src="js/jquery.mousewheel.js"/></script>
<script src="js/jquery.keyboard.extension-typing.js"/></script>
<script src="js/jquery.keyboard.extension-autocomplete.js"/></script>
<script src="js/jquery.jatt.min.js"/></script>
<script type="text/javascript" src="js/webcam.js"></script>


<script language="JavaScript">


    function enviar()
    {
            if (document.form1.cedula.value=="")
            {
                return false;
            }
            else
            {
                
                return true;
            }
    }


    /*function redireccionar() 
    {
        location.href="index.php"
    } 
    var temp = setTimeout ("redireccionar()", 30000);


    document.addEventListener("click", function() {
    // borrar el temporizador que redireccionaba
    clearTimeout(temp);
    // y volver a iniciarlo
    temp = setTimeout("redireccionar()", 30000);
    })*/


</script>
</head>
<body>

    <?php 
        include ('cabecera/head.php')
    ?>

    <div class="container" >
        <form class="form-group" name="form1" action="foto.php" method="post" onsubmit="return enviar()">
             <div class="teclado">
                <table align="center">
                  <div align="center">
                    <div class="textonoti"><h4>INGRESE EL NÚMERO DE CÉDULA</h4></div>     
 
                        <input id="num" class="alignRight" type="text" autocomplete="off" name="cedula">
                        <input id="mydata" type="hidden" name="mydata" value=""/>

                    <div class="code ui-corner-all"  >          
                        <pre>
                            <code>                
                                <script>
                                $('#num')
                                .keyboard({
                                layout : 'num',
                                maxLength : 8,
                                restrictInput : true,
                                preventPaste : true,
                                autoAccept : true,                
                                }).addTyping();
                                </script>    
                            </code>
                        </pre>    
                    </div>
                   </div>
                </table>
           </div>     
                
                    <div class="row bot-buffer">
                        <div class="col-md-10 col-md-offset-1 text-center" >
                            <button class="boton" type="submit" name="submit"> BUSCAR</button>
                        </div>
                    </div>
                

    </form>
    </div>
    
    <?php 
        include ('cabecera/foot.php')
    ?>

</body>
</html>