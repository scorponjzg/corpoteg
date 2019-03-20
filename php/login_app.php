<?php

 session_start();

 require_once 'configMySQL.php';
 

$ACCESSKEY="corpoteg";

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
	
	$usuario = isset($datos['user']) ? $conn->real_escape_string($datos['user']) : '';
	$contrasena = isset($datos['pass']) ? $conn->real_escape_string($datos['pass']) : '';
	
		$sql = "SELECT pk_usuario FROM usuario WHERE usuario = '{$usuario}' && contrasena='".sha1($contrasena)."' ; ";
		
		$result = $conn->query($sql);

		if($result->num_rows == 1){

			$resultados = $result->fetch_assoc();
			$ubicacion = "";
			$sql = "SELECT pk_servicio, servicio FROM servicio WHERE activo = 1 ";
		
		   $result2 = $conn->query($sql);
		  
		   if($result2->num_rows > 0){
		   		while($resultado = $result2->fetch_assoc()){

		   			if($ubicacion != ""){
		   				$ubicacion .= ";";
		   			}
		   			$ubicacion .= $resultado['pk_servicio'].":".$resultado['servicio'];


		   		}

		   } else {
		   		header("HTTP/1.0 400 Bad Request");
				echo "No existe una ubicacion registrada";

		   }
			echo "1/".$resultados['pk_usuario']."/".$ubicacion;
		    $result2->free();
		} else {
			
			header("HTTP/1.0 400 Bad Request");
			echo "Error al ingresar los datos";
			//echo $sql;
		}
$result->free();

$conn->close();

} else {
  header("HTTP/1.0 400 Bad Request");
  echo "Access denied";     //reports if accesskey is wrong
}
    
?>