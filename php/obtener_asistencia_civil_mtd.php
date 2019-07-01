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

	$entrada = array("entrada" => "No hay registro");
	$salida = array("salida" => "No hay registro");
	$returnJs = [];

	$fecha = isset($_POST['fecha']) ? $conn->real_escape_string($_POST['fecha']) : '';
	$pk_vacante = isset($_POST['turno']) ? $conn->real_escape_string($_POST['turno']) : '';
	$vacante = [];
	error_log($fecha);
	$sql = "SELECT fk_servicio, SUBSTRING_INDEX(hora_entrada, ' ', -1) AS entrada, SUBSTRING_INDEX(hora_salida, ' ', -1) AS salida FROM vacante WHERE pk_vacante = $pk_vacante";

	$result = $conn->query($sql);
	
	
	if ($result->num_rows == 1) {//->num_rows = 1
			$vacante = $result->fetch_assoc();
			//error_log(print_r($vacante,true));
			$serprarar_entrada = explode(":",$vacante["entrada"]);
			$serparara_salida = explode(":",$vacante["salida"]);
			$entrada = $serprarar_entrada[0] - 1;
			$salida = $serparara_salida[0] + 1;

			if($entrada < 10){
				$entrada = '0'.$entrada;
			}

			if($salida < 10){
				$salida = '0'.$salida;
			}

			$vacante['entrada'] = $fecha.' '.$entrada.':'.$serprarar_entrada[1];
			$vacante['salida'] = $fecha.' '.$salida.':'.$serparara_salida[1];

			$sql = "SELECT  nombre, IFNULL(codigo_usuario,'No registrado') as codigo FROM asistencia WHERE fk_servicio = {$vacante['fk_servicio']} && hora_registro BETWEEN '{$vacante['entrada']}' AND '{$vacante['salida']}' GROUP BY nombre ORDER BY nombre ;";

			error_log($sql);
			$result1 = $conn->query($sql);
			
			if ($result1->num_rows > 0) {
				$registro = [];
				while($resultado1 = $result1->fetch_assoc()){
					$registro = [];
				
					$sql = "SELECT IFNULL((SELECT  hora_registro FROM asistencia WHERE  fk_servicio = {$vacante['fk_servicio']} && hora_registro BETWEEN '{$vacante['entrada']}' AND '{$vacante['salida']}' && accion_registro = 1 && nombre = '{$resultado1['nombre']}' LIMIT 1 ),'No registrada') AS entrada, IFNULL((SELECT  hora_registro FROM asistencia WHERE  fk_servicio = {$vacante['fk_servicio']} && hora_registro BETWEEN '{$vacante['entrada']}' AND '{$vacante['salida']}' && accion_registro = 0 && nombre = '{$resultado1['nombre']}' ORDER BY pk_asistencia DESC LIMIT 1),'No registrado') AS salida FROM asistencia WHERE fk_servicio = {$vacante['fk_servicio']} && nombre = '{$resultado1['nombre']}' && hora_registro BETWEEN '{$vacante['entrada']}' AND '{$vacante['salida']}' LIMIT 1" ;
						//error_log($sql);
					$result_acceso = $conn->query($sql);
					
						
							$registro= $result_acceso->fetch_assoc();

						
						
						$result_acceso ->free();
					$usuarios['usuarios'][] = array_merge($resultado1,$registro);
					

				}//fin while
				unset($registro);
				//error_log(print_r($resultado,true));
				//error_log(print_r($usuarios,true));
				$returnJs['fecha'] = $usuarios;
				unset($usuarios);
			}

    } else {
				
		$returnJs['horario'][]= "No se encuentra un horario registrado";
	}
	
		$result->free();

	echo json_encode($returnJs);
	$conn->close();
}