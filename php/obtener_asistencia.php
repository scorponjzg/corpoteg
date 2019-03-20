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
	$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
				
	$sql = "SELECT nombre from acceso WHERE SUBSTRING_INDEX(`fecha_registro`, ' ', 1) = '{$fecha}' group by nombre order by nombre;";
	
												
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		
		while($resultado = $result->fetch_assoc()){
			
			$sql = "SELECT SUBSTRING_INDEX(`fecha_registro`, ' ', -1) as entrada from acceso WHERE SUBSTRING_INDEX(`fecha_registro`, ' ', 1) = '{$fecha}' && nombre='{$resultado['nombre']}' && tipo_acceso=1 LIMIT 1;";
			
			$result_acceso = $conn->query($sql);
			if ($result_acceso->num_rows == 1) {
				
				$resultado = array_merge($resultado,$result_acceso->fetch_assoc());
			} else {
				
				$resultado = array_merge($resultado,$entrada);
				
			}
			
			$sql = "SELECT SUBSTRING_INDEX(`fecha_registro`, ' ', -1) as salida from acceso WHERE SUBSTRING_INDEX(`fecha_registro`, ' ', 1) = '{$fecha}' && nombre='{$resultado['nombre']}' && tipo_acceso=0 LIMIT 1;";
			
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