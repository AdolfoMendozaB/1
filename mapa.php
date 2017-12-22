<!DOCTYPE html PUBLIC>
<html>
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
<script src="js/jquery.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.mousewheel.js"></script>

<script language="JavaScript" type="text/javascript">
    /*function redireccionar() 
    {
        location.href="index.php"
    } 
    var temp = setTimeout ("redireccionar()", 50000);

    document.addEventListener("click", function() {
    // borrar el temporizador que redireccionaba
    clearTimeout(temp);
    // y volver a iniciarlo
    temp = setTimeout("redireccionar()", 50000);
    })*/
</script>

<script type="text/javascript">
    function enviar(valor){
        location.href='mapa.php?id='+id+'&tipo='+valor;
    }

    function enviar2(competencia){
        location.href='mapa.php?id='+id+'&tipo='+tipo+'&competencia='+competencia;
    }
</script>
</head>
<body>    
    <?php 
        include ('cabecera/head.php')
    ?>
        <!-- **** MAPA **** -->  
        <?php            
    if ($_GET['id']==0){?>
        <div align="center"><h4> DIRECTORIO DE FISCALIAS </h4></div><br/>       
        <object data="imagenes/mapa.swf" type="application/x-shockwave-flash" width="1000" height="550">
            <param name="wmode" value="transparent" />
        </object>
        
    <?php }else{

        // **** CONEXION
        include("conex.php");
        $conn = conexion();
        
        $est = $_GET['id'];
        
        $sql = "select dc.descripcion, dc.descripcion_dependencia, dc.competencia, dc.numero_despacho, dc.descripcion_estado, dc.descripcion_ciudad, dc.descripcion_municipio, dc.telefono, dc.latitud, dc.longitud, dc.descripcion_parroquia, dc.direccion_sede, dc.despacho from competencias_despachos_coordenadas as dc where id_estado=".$est."";

        $resul = ExecSQL($conn, $sql);

        if (isset($_GET['tipo'])){$tipo=$_GET['tipo'];}
        if (isset($_GET['competencia'])){$competencia=$_GET['competencia'];}

     // **** VALIDACIONES PARA EL TIPO DE FISCALIA ****
        if (empty($tipo)){
                $nacional = false;
                $estadal = false;
                $municipal = false;

                while ($valor = obResultadoN($resul)){
                            if(strnatcasecmp($valor['descripcion_dependencia'], "Nacional") == 0 ){
                                $nacional = true;
                             } elseif (strnatcasecmp($valor['descripcion_dependencia'], "Estadal") == 0) {
                                $estadal = true;
                            } elseif (strnatcasecmp($valor['descripcion_dependencia'], "Municipal") == 0) {
                                $municipal = true;
                            }
                            }?>

                <div class="container">
                    <div class="row center-buffer">
                        <div class="col-md-10 col-md-offset-1 text-center" ><center>
                                <h2>SELECCIONE EL TIPO</h2> 

                            <?php if($nacional==true){?>

                                <button class="boton" name="opciones" style="margin-left:20px;" id="opciones" value="Nacional" onclick="enviar(this.value);"/> NACIONAL </button>
                            
                           <?php } ?>


                            <?php if($estadal==true){?>

                                <button class="boton" name="opciones" style="margin-left:20px;" id="opciones" value="Estadal" onclick="enviar(this.value);"/> ESTADAL </button>
                            
                           <?php } ?>


                            <?php if($municipal==true){?>

                                <button class="boton" name="opciones" style="margin-left:20px;" id="opciones" value="Municipal" onclick="enviar(this.value);"/> MUNICIPAL </button></center> <br>
                            
                           <?php } ?>
                               
                        </div> 
                            <div class="navbar-fixed-bottom foot" >       
                                <ul class="navbar-brand navbar-left" style="margin-bottom:60px;">
                                    <button class="boton"  onclick="window.open('mapa.php?id=0','_self')"/> REGRESAR </button>
                                </ul>        
                            </div>
                    </div>
                </div>

                <script type="text/javascript">
                    var id = <?php echo $est;?>
                </script>
                
                <!-- **** VALIDACIONES PARA LAS COMPETENCIAS **** -->
                    <?php } elseif (empty($competencia)){ 

                    $corrupcion = false;
                    $delitos = false;
                    $plena = false;

                        while ($valor = obResultadoN($resul)){
                            if(strnatcasecmp($valor['descripcion_dependencia'], $tipo) == 0){
                            
                                if(strnatcasecmp($valor['competencia'], "Contra la Corrupción") == 0 ){

                                    $corrupcion = true;                              

                                 } elseif (strnatcasecmp($valor['competencia'], "Delitos Comunes") == 0) {
                                        
                                    $delitos = true;

                                } elseif (strnatcasecmp($valor['competencia'], "Plena") == 0) {
                                    $plena = true;
                                }}} ?>

                 <div class="container">
                    <div class="row center-buffer">
                        <div class="col-md-10 col-md-offset-1 text-center" >
                            <h2> SELECCIONE LA COMPETENCIA </h2><center>

                            <?php if($corrupcion==true){?>

                                <button class="boton" name="opciones" style="margin-left:20px;" id="opciones" value="Contra la Corrupción" onclick="enviar2(this.value);"/> CONTRA LA CORRUPCIÓN </button>

                           <?php } ?>

                           <?php if($delitos==true){?>

                                <button class="boton" name="opciones" style="margin-left:20px;" id="opciones" value="Delitos Comunes" onclick="enviar2(this.value);"/> DELITOS COMUNES </button>

                           <?php } ?>

                            <?php if($plena==true){?>

                                <button class="boton" name="opciones" style="margin-left:20px;" id="opciones" value="Plena" onclick="enviar2(this.value);"/> PLENA </button></center><br>

                           <?php } ?>
                        </div>
                            <div class="navbar-fixed-bottom foot" >       
                                <ul class="navbar-brand navbar-left" style="margin-bottom:60px;">
                                    <button class="boton"  onclick="window.open('mapa.php?id=0','_self')"/> REGRESAR </button>
                                </ul>        
                            </div>
                    </div>
                </div> 

                    <script type="text/javascript">
                        var tipo = "<?php echo $tipo;?>"
                    </script>

                    <script type="text/javascript">
                        var id = <?php echo $est;?>
                    </script>

                <?php } ?> 
                         
                <?php

                // **** MUESTRA DE LOS RESULTADOS DE LAS BUSQUEDAS ****
                if (isset($_GET['tipo']) and isset($_GET['competencia'])){
                if (NumFilas($resul) > 0) {
                ?>
                
                    <div class="container">
                        <div class="row tabla-buffer">
                              <div class="tbl-header">
                                <table cellpadding="0" cellspacing="0" border="0" class="datagrid">
                                    <tr>
                                        <th>DESCRIPCION</th>
                                        <th>CIUDAD</th>
                                        <th>MUNICIPIO</th>
                                        <th>PARROQUA</th>
                                        <th>TELEFONOS</th>
                                        <th>TIPO FISCALIA</th>
                                        <th>COMPETENCIA</th>
                                    </tr>

                                    <?php while ($valor = obResultadoN($resul)){

                                         if(strnatcasecmp($valor['descripcion_dependencia'], $tipo) == 0 and strnatcasecmp($valor['competencia'], $competencia) == 0 ){

                                        ?>

                                    <tr>
                                        <td><?php echo $valor['descripcion'] ?></td>
                                        <td><?php echo $valor['descripcion_ciudad'] ?></td>
                                        <td><?php echo $valor['descripcion_municipio'] ?></td>
                                        <td><?php echo $valor['descripcion_parroquia'] ?></td>
                                        <td><?php echo $valor['telefono'] ?></td>
                                        <td><?php echo $valor['despacho'] ?></td>
                                        <td><?php echo $valor['competencia'] ?></td>
                                        <td>
                                            <button class="boton" onclick="window.open('buscar_direccion.php?latitud=<?php echo $valor["latitud"];?>&longitud=<?php echo $valor["longitud"];?>','_self')"/> DIRECCIÓN </button>
                                        </td>  
                                    </tr>
                                    <?php }} ?> 
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } ?> 
                        <div class="navbar-fixed-bottom foot" >       
                            <ul class="navbar-brand navbar-left" style="margin-bottom:60px;">
                                <button class="boton"  onclick="window.open('mapa.php?id=0','_self')"/> REGRESAR </button>
                            </ul>        
                        </div> 
                <?php }} ?>                          
            </div>                                            
        </div>
    <?php 
        include ('cabecera/foot.php');
    ?>
</body>
</html>