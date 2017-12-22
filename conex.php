<?php 
//nos permite conectarnos a la base de datos
	function conexion(){
	$conn=pg_connect("host=192.168.1.45 dbname=kiosko user=usukiosko password=uko210.");
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
