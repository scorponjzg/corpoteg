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
	
	$returnJs = [];
	
	$sql = "SELECT estatus,  pk_estatus as id FROM estatus WHERE activo = 1";
								
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		
		while($resultado = $result->fetch_assoc()){
			
			$returnJs['estatus'][]= $resultado;
		}
		
		
	} else {
		
		$returnJs['estatus'][] = array("nombre" => "No hay estados registrados");
	}

	$sql = "SELECT medio,  pk_medio as id FROM medio WHERE activo = 1";
							
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		
		while($resultado = $result->fetch_assoc()){
			
			$returnJs['medio'][]= $resultado;
		}
		
		
	} else {
		
		$returnJs['medio'][] = array("nombre" => "No hay medios registrados");
	}

	$sql = "SELECT empresa,  pk_empresa as id FROM empresa WHERE activo = 1";
	
							
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		
		while($resultado = $result->fetch_assoc()){
			
			$returnJs['empresa'][]= $resultado;
		}
		
		
	} else {
		
		$returnJs['empresa'][] = array("nombre" => "No hay empresas registradas");
	}
	$result->free();
	
					
	echo json_encode($returnJs);
	$conn->close();
}