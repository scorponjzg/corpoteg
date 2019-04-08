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

	$servicio = isset($_POST['servicio']) ? $_POST['servicio'] + 0 : 0;
	$f_inicial = isset($_POST['f_inicial']) ? $conn->real_escape_string($_POST['f_inicial']) : '';
	$f_final = isset($_POST['f_final']) ? $conn->real_escape_string($_POST['f_final']) : '';

	if($f_inicial!='' && $f_final != '' ){
		$fecha = " && SUBSTRING_INDEX(`hora_registro`, ' ', 1) >='".$f_inicial."' && SUBSTRING_INDEX(`hora_registro`, ' ', 1) <='".$f_final."'";
	} else if($f_final==''){
		$fecha = " && SUBSTRING_INDEX(`hora_registro`, ' ', 1) >='".$f_inicial."'";
	} else{
		$fecha = " && SUBSTRING_INDEX(`hora_registro`, ' ', 1) <='".$f_final."'";
	}	

	$sql = "SELECT  SUBSTRING_INDEX(`hora_registro`, ' ', 1) AS fecha, a.nombre,IFNULL(a.codigo_usuario,'No registrado') as codigo, s.servicio from asistencia as a INNER JOIN servicio as s ON s.pk_servicio=a.fk_servicio WHERE  fk_servicio = {$servicio} ".$fecha." group by nombre, fecha order by fecha DESC;";
				
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		
		while($resultado = $result->fetch_assoc()){
		$registro[] = [];
			
			$sql = "SELECT SUBSTRING_INDEX(`hora_registro`, ' ', -1) as registro, IF(accion_registro = 1,'E','S') AS accion, IFNULL(foto_asistencia,'descarga.png') AS foto  from asistencia WHERE nombre='{$resultado['nombre']}' && fk_servicio = {$servicio} && SUBSTRING_INDEX(`hora_registro`, ' ', 1) = '{$resultado['fecha']}';";
			
			$result_acceso = $conn->query($sql);
			if ($result_acceso->num_rows > 0) {
				while($resultado1 = $result_acceso->fetch_assoc()){

					$registro['registros'][]= $resultado1;

				}
				$result_acceso ->free();
			}
			
			$returnJs['fecha'][]= array_merge($resultado,$registro);
			unset($registro);
			
		}
		
		$sql = "SELECT  t.turno, v.vacante AS personal, v.hora_entrada AS entrada, v.hora_salida AS salida, v.tolerancia_entrada AS te, v.tolerancia_salida AS ts from vacante AS v INNER JOIN turno AS t ON t.pk_turno = v.fk_turno WHERE  v.fk_servicio = {$servicio} && v.activo=1 ORDER BY entrada DESC;";
						
			$result_acceso1 = $conn->query($sql);
			
			if ($result_acceso1->num_rows > 0) {
				while($resultado2 = $result_acceso1->fetch_assoc()){

					$returnJs['requerimiento'][]= $resultado2;

				}
				$result_acceso1 ->free();

			} else{
		
				$returnJs['fecha'][]= "Debe registrar al menos un requerimiento del servicio";
			}
		
	} else{
		
		$returnJs['fecha'][]= "No hay fechas registadas";
	}
	
		$result->free();

	echo json_encode($returnJs);
	$conn->close();
}