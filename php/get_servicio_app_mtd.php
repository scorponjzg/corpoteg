<?php

 session_start();

 require_once 'configMySQL.php';
 

$ACCESSKEY="corpoteg";

/************************************CONFIG****************************************/

//these are just in case setting headers forcing it to always expire
header('Content-Type: text/html; charset=UTF-8');  
header('Cache-Control: no-cache, must-revalidate');

if($_POST['p']==$ACCESSKEY){
	
	$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
		// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$conn->set_charset("utf8");
    $datos=str_replace("¬"," ",$_POST);
	
	$datos=str_replace("  ","",$datos);
	$ubicacion = "";
	$usuario = isset($datos['user']) ? $conn->real_escape_string($datos['user']) : '';
	$contrasena = isset($datos['pass']) ? $conn->real_escape_string($datos['pass']) : '';
	$separador = false;
	
		$sql = "SELECT v.pk_vacante, t.turno, s.servicio,v.vacante FROM vacante AS v INNER JOIN turno AS t ON t.pk_turno=v.fk_turno  INNER JOIN servicio as s ON s.pk_servicio=v.fk_servicio WHERE v.vacante_activo=1; ";
			
		$result = $conn->query($sql);
		
		if($result->num_rows > 0){

			while($resultado = $result->fetch_assoc()){
				$vacante =  true;
				//Se verifica que el número requerido sea meyo al que está asignado
				
				$sql = "SELECT count(fk_usuario) as asignado FROM asignado WHERE asignado_activo=1 && fk_vacante = ".$resultado['pk_vacante'];
				
				$result2 = $conn->query($sql);	
				if($result2->num_rows == 1){
					$asignados = $result2->fetch_assoc();
					if($resultado['vacante'] < $asignados['asignado']){

			   			$vacante = false;
					}
				}
				
				if($vacante){

					if($separador){
						//evita la primera interacción
			   				$ubicacion .= ";";
			   			}
			   			$ubicacion .= $resultado['pk_vacante']."-".$resultado['servicio']."-".$resultado['turno'];
			   			$separador = true;
				} 

		   	}

		   } else {
		   		header("HTTP/1.0 400 Bad Request");
				echo "No existe una ubicacion registrada";

		   }
$result->free();

$conn->close();
	echo "1/".$ubicacion;

} else {
  header("HTTP/1.0 400 Bad Request");
  echo "Access denied";     //reports if accesskey is wrong
}
    
?>