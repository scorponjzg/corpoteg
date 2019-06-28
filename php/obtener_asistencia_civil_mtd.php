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

			$sql = "SELECT  nombre, IFNULL(codigo_usuario,'No registrado') as codigo,  FROM asistencia WHERE  fk_servicio = {$vacante['fk_servicio']} && hora_registro BETWEEN '{$vacante['entrada']}' AND '{$vacante['salida']}' GROUP BY nombre ORDER BY nombre ;";

			error_log($sql);
			$result1 = $conn->query($sql);
			
			if ($result1->num_rows > 0) {
				//$fecha['fecha'][] = $resultado; 
				while($resultado1 = $result1->fetch_assoc()){
					$registro = [];
				}

			/*$usuarios = [];
			$sql = "(SELECT  hora_registro FROM asistencia WHERE  fk_servicio = {$vacante['fk_servicio']} && hora_registro BETWEEN '{$vacante['entrada']}' AND '{$vacante['salida']}' && accion_registro = 1  LIMIT 1 ;) AS entrada";

			$sql = "(SELECT  hora_registro FROM asistencia WHERE  fk_servicio = {$vacante['fk_servicio']} && hora_registro BETWEEN '{$vacante['entrada']}' AND '{$vacante['salida']}' && accion_registro = 0  LIMIT 1 ;) AS salida DESC LIMIT 1";

			$sql = "SELECT  nombre, IFNULL(codigo_usuario,'No registrado') as codigo FROM asistencia WHERE  fk_servicio = {$vacante['fk_servicio']} && (SUBSTRING_INDEX(`hora_registro`, ' ', 1) > '{$vacante['entrada']}' && accion_registro = 1)  || (SUBSTRING_INDEX(`hora_registro`, ' ', 1) < '{$vacante['salida']}' && accion_registro = 0) GROUP BY nombre ORDER BY nombre ;";
			$sql = "SELECT SUBSTRING_INDEX(`hora_registro`, ' ', -1) as registro, IF(accion_registro = 1,'E','S') AS accion, IFNULL(foto_asistencia,'descarga.png') AS foto, codigo_usuario 
			AS codigo, nombre FROM asistencia WHERE fk_servicio = {$vacante['fk_servicio']} && SUBSTRING_INDEX(`hora_registro`, ' ', 1) > '{$vacante['entrada']}' && SUBSTRING_INDEX(`hora_registro`, ' ', 1) < '{$vacante['salida']}';";
						
			$result1 = $conn->query($sql);
			if ($result1->num_rows = 1) {
				//$fecha['fecha'][] = $resultado; 
				while($resultado1 = $result1->fetch_assoc()){
				$registro = [];
					
					
				}
					$sql = "SELECT SUBSTRING_INDEX(`hora_registro`, ' ', -1) as registro, IF(accion_registro = 1,'E','S') AS accion, IFNULL(foto_asistencia,'descarga.png') AS foto  from asistencia WHERE nombre='{$resultado1['nombre']}' && fk_servicio = {$servicio} && SUBSTRING_INDEX(`hora_registro`, ' ', 1) = '{$resultado['fecha']}';";
					//error_log($sql);
					
					$result_acceso = $conn->query($sql);
					if ($result_acceso->num_rows > 0) {
						while($resultado2 = $result_acceso->fetch_assoc()){

							$registro['registros'][]= $resultado2;

						}
						$result_acceso ->free();
					}
					
					$usuarios['usuarios'][] = array_merge($resultado1,$registro);
					unset($registro);
				//error_log(print_r($resultado,true));
				//error_log(print_r($usuarios,true));
				$returnJs['fecha'][] = array_merge($resultado,$usuarios);
				unset($usuarios);
				
				
			} else {
				
				$returnJs['fecha'][]= "No hay fechas registadas";
			}
		
		$sql = "SELECT  t.turno, v.vacante AS personal, v.hora_entrada AS entrada, v.hora_salida AS salida, v.tolerancia_entrada AS te, v.tolerancia_salida AS ts from vacante AS v INNER JOIN turno AS t ON t.pk_turno = v.fk_turno WHERE  v.fk_servicio = {$servicio} && v.activo=1 ORDER BY v.pk_vacante ;";
						
					$result_acceso1 = $conn->query($sql);
					
					if ($result_acceso1->num_rows > 0) {
						while($resultado2 = $result_acceso1->fetch_assoc()){

							$returnJs['requerimiento'][]= $resultado2;

						}
						$result_acceso1 ->free();

					} else {
				
						$returnJs['fecha'][]= "Debe registrar al menos un requerimiento del servicio";
					}*/
    } else {
				
		$returnJs['horario'][]= "No se encuentra un horario registrado";
	}
	
		$result->free();

	echo json_encode($returnJs);
	$conn->close();
}