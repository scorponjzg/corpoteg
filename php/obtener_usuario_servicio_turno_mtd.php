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

	$pk_vacante = isset($_POST['turno']) ? $conn->real_escape_string($_POST['turno']) : '';

	$sql = "SELECT  u.codigo, CONCAT(u.a_paterno, ' ', u.a_materno, ' ', u.nombre) AS nombre FROM usuario AS u, asignado AS a WHERE a.fk_vacante = {$pk_vacante} && a.fk_usuario= u.pk_usuario &&  u.activo=1 ORDER BY nombre;";
	error_log($sql);

								
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		
		while($resultado = $result->fetch_assoc()){
			
			$returnJs['usuario'][]= $resultado;
		}
		if($_SESSION['tipo_corpoteg'] == 1){

			$returnJs['show'] = "true";
		}
		
	} else {
		
		$returnJs['usuario'][] = array("nombre" => "No hay usuarios registrados");
	}
	$result->free();
	
					
	echo json_encode($returnJs);
	$conn->close();
}