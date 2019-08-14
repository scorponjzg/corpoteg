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
	$returnJs['show'] = "false";			
	$sql = "SELECT s.servicio as nombre, s.pk_servicio as id, IF(s.asistencia_manual = 0, 'Restringido', 'Permitido') AS permitido, c.nombre AS cliente FROM servicio AS s INNER JOIN cliente AS c ON s.fk_cliente = c.pk_cliente WHERE s.activo=1;";
												
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		
		while($resultado = $result->fetch_assoc()){
			
			$returnJs['servicio'][]= $resultado;
		}
		if($_SESSION['tipo_corpoteg'] == 1){

			$returnJs['show'] = "true";
		}
		
	} else {
		
		$returnJs['servicio'] = array("salida" => "No hay servicios registrados");
	}
	$result->free();
	
					
	echo json_encode($returnJs);
	$conn->close();
}