<?php 
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	if(isset($_SESSION['tipo_corpoteg']) && $_SESSION['tipo_corpoteg'] == 1){

		require_once 'configMySQL.php';
		
		$returnJs = [];
		$returnJs['ingresado'] = 'Por el momento no se encuentra en la funcionalidad activa, intente más tarde.';
		$noCambios = 0;
		$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
		
		//check connection_aborted
		if($conn -> connect_error) {
			die("Connection failed: " . $conn -> connect_error);		
		}
		
		$conn -> set_charset('utf8');
		
		$servicio = isset($_POST['servicio']) ? $conn->real_escape_string($_POST['servicio']) : '';
		$turno = isset($_POST['turno']) ? $conn->real_escape_string($_POST['turno']) : '';
		$personal = isset($_POST['personal']) ? $_POST['personal']+0 : 0;
		$entrada = isset($_POST['entrada']) ? $conn->real_escape_string($_POST['entrada']) : '';
		$salida = isset($_POST['salida']) ? $conn->real_escape_string($_POST['salida']) : '';
		$tolerancia_entrada = isset($_POST['te']) ? $conn->real_escape_string($_POST['te']) : '';
		$tolerancia_salida = isset($_POST['ts']) ? $conn->real_escape_string($_POST['ts']) : '';

		
			$sql = "INSERT INTO vacante(vacante, fk_turno, fk_servicio, hora_entrada, hora_salida, tolerancia_entrada, tolerancia_salida) VALUES({$personal}, {$turno}, {$servicio}, '{$entrada}', '{$salida}', '{$tolerancia_entrada}', '{$tolerancia_salida}');";
			
			$conn->query($sql);
			
			if($conn->affected_rows == 1){
			
				$returnJs['ingresado'] = 'true';
			
			}
		
		echo json_encode($returnJs);
		$conn->close();
	} else {

		header("HTTP/1.0 400 Bad Request");

		echo "No tiene los permisos requieridos";
	}

}