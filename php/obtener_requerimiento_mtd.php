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
	$sql = "SELECT v.vacante as solicitado, v.pk_vacante as id, t.turno, s.servicio, v.hora_entrada AS entrada, v.hora_salida AS salida, v.tolerancia_entrada AS t_e, v.tolerancia_salida AS t_s FROM vacante AS v INNER JOIN turno AS t ON v.fk_turno = t.pk_turno INNER JOIN servicio AS s ON v.fk_servicio = s.pk_servicio WHERE v.activo=1;";
												
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		
		while($resultado = $result->fetch_assoc()){
			
			$returnJs['servicio'][]= $resultado;
		}
		if($_SESSION['tipo_corpoteg'] == 1){

			$returnJs['show'] = "true";
		}
		
	} else {
		
		$returnJs['servicio'][] = array("nombre" => "No hay requerimientos registrados");
	}
	$result->free();
	
					
	echo json_encode($returnJs);
	$conn->close();
}