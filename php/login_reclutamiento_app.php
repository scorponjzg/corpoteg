<?php

 session_start();

 require_once 'configMySQL.php';
 

$ACCESSKEY="secret";

/************************************CONFIG****************************************/

//these are just in case setting headers forcing it to always expire
header('Content-Type: text/html; charset=UTF-8');  
header('Cache-Control: no-cache, must-revalidate');

if($_POST['p']==$ACCESSKEY){
	
	$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
		// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$conn->set_charset("utf8");
    $datos=str_replace("¬"," ",$_POST);
	
	$datos=str_replace("  ","",$datos);
	
	$usuario = isset($datos['usuario']) ? $conn->real_escape_string($datos['usuario']) : '';
	$contrasena = isset($datos['contrasena']) ? $conn->real_escape_string($datos['contrasena']) : '';
	
		$sql = "SELECT pk_usuario, nombre FROM usuario WHERE usuario = '{$usuario}' && contrasena='".sha1($contrasena) . "'; ";
		
		$result = $conn->query($sql);

		if($result->num_rows == 1){
			$restultados = $result->fetch_assoc();
			  echo $restultados['nombre']."/".$restultados['pk_usuario'];
		} else {
			
			header("HTTP/1.0 400 Bad Request");
			echo "Error al ingresar los datos";
		}

  
} else {
  header("HTTP/1.0 400 Bad Request");
  echo "Access denied";     //reports if accesskey is wrong
}

?>