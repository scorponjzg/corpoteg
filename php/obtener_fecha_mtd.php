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
	
	$servicio = isset($_POST['servicio']) ? $_POST['servicio'] + 0 : 0;
	$f_inicial = isset($_POST['f_inicial']) ? $conn->real_escape_string($_POST['f_inicial']) : '';
	$f_final = isset($_POST['f_final']) ? $conn->real_escape_string($_POST['f_final']) : '';
	$fecha = '';
	if($f_inicial!='' && $f_final != '' ){
		$fecha = " && hora_registro >='".$f_inicial."' && hora_registro <='".$f_final."'";
	} else if($f_final==''){
		$fecha = " && hora_registro >='".$f_inicial."'";
	} else{
		$fecha = " && hora_registro <='".$f_final."'";
	}
				
		$sql = "SELECT SUBSTRING_INDEX(`hora_registro`, ' ', 1) as fecha FROM `asistencia` WHERE fk_servicio={$servicio} ".$fecha."GROUP BY fecha ORDER BY fecha DESC;";
		
												
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		
		while($resultado = $result->fetch_assoc()){
			
			
			
				$returnJs['fecha'][]= $resultado;
			
		}
		
		
	} else{
		
		$returnJs['fecha'][]= array("fecha"=>"No hay fechas registadas");
	}
		$result->free();
					
	echo json_encode($returnJs);
	$conn->close();
}