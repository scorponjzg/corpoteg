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
		$tipo = isset($_POST['tipo']) ? $conn->real_escape_string($_POST['tipo']) : '';
		$fecha = isset($_POST['fecha']) ? $conn->real_escape_string($_POST['fecha']) : '';
		$hora = isset($_POST['hora']) ? $conn->real_escape_string($_POST['hora']) : '';
		$codigo = isset($_POST['codigo']) ? $conn->real_escape_string($_POST['codigo']) : '';
		$nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : '';
		$registro = $fecha." ".$hora;
		
			$sql = "INSERT INTO asistencia (codigo_usuario, nombre, hora_registro,  accion_registro, fk_usuario, fk_servicio, medio_registro) VALUES('$codigo','{$nombre}', '{$registro}', {$tipo},{$_SESSION['usuario_corpoteg']},{$servicio},'Sistema Web modo manual') ; ";
			error_log($sql);
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