<?php

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	
  session_start();
	
  require_once 'configMySQL.php';

	$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
		// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	$conn->set_charset("utf8");
	$sql = "SELECT servicio, pk_servicio as pk from servicio WHERE activo = 1";
	
												
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		
		while($resultado = $result->fetch_assoc()){
			
			
			
				$returnJs['servicio'][]= $resultado;
			
		}
		
		
	} else{
		
		$returnJs['servicio'][]= "No hay servicios registados";
	}
		$result->free();
					
	echo json_encode($returnJs);
	$conn->close();
}