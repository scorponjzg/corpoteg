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

	$sql = "SELECT u.pk_usuario AS identificador, u.codigo, CONCAT(u.a_paterno, ' ', u.a_materno, ' ', u.nombre) AS nombre, u.telefono, u.contacto, e.empresa, t.turno, s.servicio  FROM usuario AS u INNER JOIN empresa AS e ON u.fk_empresa = e.pk_empresa INNER JOIN asignado AS a  ON u.pk_usuario = a.fk_usuario INNER JOIN vacante AS v ON v.pk_vacante = a.fk_vacante INNER JOIN turno AS t ON t.pk_turno = v.fk_turno INNER JOIN servicio as s ON s.pk_servicio = v.fk_servicio WHERE u.activo=1 ORDER BY e.empresa, s.servicio, t.turno;";
	/*$sql = "SELECT u.codigo, CONCAT(u.a_paterno, ' ', u.a_materno, ' ', u.nombre) AS nombre, u.telefono, u.contacto, e.empresa, t.turno, s.servicio  FROM usuario AS u, empresa AS e, asignado AS a, vacante AS v, turno AS t, servicio AS s WHERE u.fk_empresa = e.pk_empresa && u.pk_usuario = a.fk_usuario && v.pk_vacante = a.fk_vacante && t.pk_turno = v.fk_turno && s.pk_servicio = v.fk_servicio && u.activo=1 ORDER BY e.empresa, s.servicio, t.turno;";*/
												
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