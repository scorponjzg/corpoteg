<?php 
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	if(isset($_SESSION['tipo_corpoteg']) && $_SESSION['tipo_corpoteg'] == 1){

		require_once 'configMySQL.php';
		
		$returnJs = [];
		$returnJs['editado'] = 'Por el momento no se encuentra en la funcionalidad activa, intente en otro momento.';
		$noCambios = 0;
		$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
		
		//check connection_aborted
		if($conn -> connect_error) {
			die("Connection failed: " . $conn -> connect_error);		
		}
		
		$conn -> set_charset('utf8');

		$id = isset($_POST['pk']) ? $conn->real_escape_string($_POST['pk']) : '';
		$servicio = isset($_POST['servicio']) ? $conn->real_escape_string($_POST['servicio']) : '';
		$turno = isset($_POST['turno']) ? $conn->real_escape_string($_POST['turno']) : '';
		$entrada = isset($_POST['entrada']) ? $conn->real_escape_string($_POST['entrada']) : '';
		$salida = isset($_POST['salida']) ? $conn->real_escape_string($_POST['salida']) : '';
		$te = isset($_POST['te']) ? $conn->real_escape_string($_POST['te']) : '';
		$ts = isset($_POST['ts']) ? $conn->real_escape_string($_POST['ts']) : '';
		$personal = isset($_POST['personal']) ? $conn->real_escape_string($_POST['personal']) : '';
		
			
			$sql = "UPDATE vacante SET vacante='{$personal}', fk_servicio = {$servicio}, fk_turno = {$turno}, hora_entrada = '{$entrada}', hora_salida = '{$salida}', tolerancia_entrada = '{$te}', tolerancia_salida = '{$ts}' WHERE pk_vacante={$id}";
				error_log($sql);
			$noCambios = $conn->query($sql);
			//error_log($sql."---".$noCambios);
			if($conn->affected_rows == 1){
			
				$returnJs['editado'] = 'true';
			
			} else {

				if($noCambios == 1){
					$returnJs['editado']="No realizó ningún cambio.";
				}
			}
		
		echo json_encode($returnJs);
		$conn->close();
	} else {

		header("HTTP/1.0 400 Bad Request");

		echo "No tiene los permisos requieridos";
	}

}