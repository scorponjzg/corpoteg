<?php

 session_start();

 require_once 'configMySQL.php';
 
$ACCESSKEY="corpoteg";

/************************************CONFIG****************************************/

//these are just in case setting headers forcing it to always expire
header('Content-Type: text/html; charset=UTF-8');  
header('Cache-Control: no-cache, must-revalidate');
//error_log(print_r($_GET,true));

function getRandomCode(){
	$an = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$su = strlen($an) - 1;
	return substr($an, rand(0, $su), 1) .
		   substr($an, rand(0, $su), 1) .
		   substr($an, rand(0, $su), 1) .
		   substr($an, rand(0, $su), 1) .
		   substr($an, rand(0, $su), 1) .
		   substr($an, rand(0, $su), 1);
}

if($_POST['p']==$ACCESSKEY){
	
	$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
		// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$conn->set_charset("utf8");
    $datos=str_replace("¬"," ",$_POST);
	$datos=str_replace("  ","",$datos);
	
	$usuario = isset($datos['user']) ? $conn->real_escape_string($datos['user']) : '';
	$entrada = isset($datos['entrada']) ? $conn->real_escape_string($datos['entrada']) : '';
	$responsable = isset($datos['responsable']) ? $conn->real_escape_string($datos['responsable']) : '';
	$ubicacion = isset($datos['ubicacion']) && $datos['ubicacion'] != '0' ? $conn->real_escape_string($datos['ubicacion']) : 1;
	$medio = isset($datos['medio']) ? $conn->real_escape_string($datos['medio']) : '';


	//La app puede mandar como código el mismo valor que el nombre de usuario por lo que se valida que no sea sí
	$codigo = isset($datos['codigo']) && $datos['codigo'] != $usuario ? $conn->real_escape_string($datos['codigo']) : '';
	
		$sql = "INSERT INTO asistencia (codigo_usuario, nombre, accion_registro, fk_usuario, fk_servicio, medio_registro) VALUES('$codigo','{$usuario}',{$entrada},{$responsable},(SELECT pk_servicio FROM servicio WHERE servicio='{$ubicacion}' && activo=1 LIMIT 1),'{$medio}') ; ";
		
		$conn->query($sql);

		if($conn->affected_rows == 1){

			 echo "2/Registro exitoso";
			
		} else {
			
			header("HTTP/1.0 400 Bad Request");
			echo "Error al ingresar los datos";
			//echo $sql;
		}
  
} else {
  header("HTTP/1.0 400 Bad Request");
  echo "Access denied";     //reports if accesskey is wrong
}

?>