<?php 

	function conexion(){
	$conn=pg_connect("host=192.168.1.45 port=5432 dbname=sisticket user=ususisticket password=12345678");
	return $conn;
	}


	//Ejecutar SQL
	function ExecSQL($conn,$sql){
	return @pg_query($conn,$sql);
	}
//Obtener Datos de Registro
	function obResultado($cursor){
	return pg_fetch_row($cursor);
	}
//Obtener Datos de Registro por Nombre
	function obResultadoN($cursor){
	return pg_fetch_array($cursor);
	}	
//Numero de Filas 
	function NumFilas($cursor){
	return pg_num_rows($cursor);
	}

?>



