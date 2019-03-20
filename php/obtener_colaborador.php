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
	$returnJs['registrado'] = false;
	$returnJs['tipo'] = $_SESSION['tipo_corpoteg'];
	$arrarUrl = explode("/",$_SERVER["REQUEST_URI"]);
	$url = "http://" . $_SERVER["HTTP_HOST"] ."/". $arrarUrl[1] . "/" .  $arrarUrl[2] . "/fotos/";
	// error_log($_SERVER["HTTP_HOST"]);
	// error_log($_SERVER["REQUEST_URI"]);
	// error_log(print_r($direccion, true));
	// error_log(print_r(array_pop($direccion), true));
				
		$sql = "SELECT CONCAT(s.servicio,' --- ',t.turno) AS servicio, e.estatus, m.medio, u.pk_usuario AS identificador, CONCAT('{$url}',u.nombre_foto) as foto, CONCAT(u.a_paterno,' ', u.a_materno,' ',  u.nombre) as nombre, SUBSTRING_INDEX(u.fecha_contrato, ' ', 1) AS fecha, u.telefono,u.alergia,u.reclutador,u.nss, u.tipo_sangre FROM usuario AS u INNER JOIN medio AS m ON m.pk_medio = u.fk_medio INNER JOIN estatus AS e ON e.pk_estatus = u.fk_estatus INNER JOIN asignado as a ON a.fk_usuario = u.pk_usuario INNER JOIN vacante AS v ON v.pk_vacante = a.fk_vacante INNER JOIN servicio AS s ON s.pk_servicio = v.fk_servicio INNER JOIN turno AS t ON t.pk_turno = v.fk_turno WHERE u.activo = 1 ORDER BY pk_usuario DESC";
		
		error_log($sql);
												
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		
		while($restultados = $result->fetch_assoc()){
			
			$returnJs['usuario'][] = $restultados;
			
		}
		
		$returnJs['nombre'] = $_SESSION['tipo_corpoteg'] == 1 ? 'ADMIN' : $returnJs['usuario'][0]['nombre'];
		$returnJs['registrado'] = true ;
		$result->free();
	}
					
	echo json_encode($returnJs);
	$conn->close();
}