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
	$id = isset($_POST['servicio']) ? $_POST['servicio'] + 0 : 0;
	$returnJs['show'] = "false";			
	$sql = "SELECT s.servicio AS nombre, t.turno AS turno, v.hora_entrada AS entrada, v.hora_salida AS salida, v.pk_vacante AS id FROM vacante AS v INNER JOIN turno AS t ON t.pk_turno = v.fk_turno INNER JOIN servicio AS s ON v.fk_servicio = s.pk_servicio WHERE v.activo=1 && v.fk_servicio = {$id};";
												
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		
		while($resultado = $result->fetch_assoc()){
			
			$returnJs['turno'][]= $resultado;
		}
		if($_SESSION['tipo_corpoteg'] == 1){

			$returnJs['show'] = "true";
		}
		
	} else {
		
		$returnJs['turno'][] = array("nombre" => "No hay turnos registrados");
	}
	$result->free();
	
					
	echo json_encode($returnJs);
	$conn->close();
}