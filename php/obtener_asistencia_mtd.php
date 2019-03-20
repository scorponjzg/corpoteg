<?php

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	
  session_start();
	
  require_once 'configMySQL.php';

	$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
		// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

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

	$sql = "SELECT  SUBSTRING_INDEX(`hora_registro`, ' ', -1) AS fecha, a.nombre,IFNULL(a.codigo_usuario,'No registrado') as codigo,s.servicio from asistencia as a INNER JOIN servicio as s ON s.pk_servicio=a.fk_servicio WHERE  fk_servicio = {$servicio} ".$fecha."group by nombre, fecha order by fecha DESC;";
	error_log($sql);
											
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		
		while($resultado = $result->fetch_assoc()){
			
			$sql = "SELECT SUBSTRING_INDEX(`hora_registro`, ' ', -1) as registro, IF(accion_registro = 1,'E','S') AS accion from asistencia WHERE nombre='{$resultado['nombre']}' && fk_servicio = {$servicio} ;";
			
			$result_acceso = $conn->query($sql);
			if ($result_acceso->num_rows == 1) {
				
				$resultado = array_merge($resultado,$result_acceso->fetch_assoc());
			} else {
				
				$resultado = array_merge($resultado,$entrada);
				
			}
			
			$sql = "SELECT SUBSTRING_INDEX(`hora_registro`, ' ', -1) as salida from asistencia WHERE SUBSTRING_INDEX(`hora_registro`, ' ', 1) = '{$fecha}' && nombre='{$resultado['nombre']}' && accion_registro=0 && fk_servicio = {$servicio} order by salida DESC LIMIT 1;";
			
			$result_salida = $conn->query($sql);
			if ($result_salida->num_rows == 1) {
				
				$resultado = array_merge($resultado,$result_salida->fetch_assoc());
			} else {
				
				$resultado = array_merge($resultado,$salida);
				
			}
				$returnJs['fecha'][]= $resultado;
			
		}
		
		
	} else{
		
		$returnJs['fecha'][]= "No hay fechas registadas";
	}
	
		$result->free();
					
	echo json_encode($returnJs);
	$conn->close();
}