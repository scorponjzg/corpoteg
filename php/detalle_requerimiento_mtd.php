<?php

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	
  session_start();
	
  require_once 'configMySQL.php';

	$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
		// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$returnJs = [];

	$id = isset($_POST['requerimiento']) ? $_POST['requerimiento'] + 0 : 0;
	

	$sql = "SELECT  pk_vacante AS id, vacante AS requeridos, fk_turno AS turno, fk_servicio AS servicio, hora_entrada AS entrada, hora_salida AS salida, tolerancia_entrada AS te, tolerancia_salida AS ts from vacante WHERE pk_vacante= ".$id;
   								
	$result = $conn->query($sql);
	
	if ($result->num_rows == 1) {
	
		$returnJs['requerimiento']= $result->fetch_assoc();
	
	} else{
		
		$returnJs['requerimiento'][]= "No hay turnos registados";
	}
	
		$result->free();
					
	echo json_encode($returnJs);
	$conn->close();
}