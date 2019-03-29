<?php

 session_start();
 ini_set('memory_limit', '256M');
 error_reporting(0);

 require_once 'configMySQL.php';
 include ("class.ExifCleaning.php");

 require_once (dirname(__FILE__).'/PHP_Compat-1.6.0a3/Compat/Function/file_get_contents.php');
  
 $data = php_compat_file_get_contents('php://input');
 
$ACCESSKEY="corpoteg";

/************************************CONFIG****************************************/

//these are just in case setting headers forcing it to always expire
header('Content-Type: text/html; charset=UTF-8');  
header('Cache-Control: no-cache, must-revalidate');
//error_log(print_r($_GET,true));

function getRandomCode(){
	$an = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$su = strlen($an) - 1;
	return substr($an, rand(0, $su), 1) .
		   substr($an, rand(0, $su), 1) .
		   substr($an, rand(0, $su), 1) .
		   substr($an, rand(0, $su), 1) .
		   substr($an, rand(0, $su), 1) .
		   substr($an, rand(0, $su), 1);
}

if($_GET['p']==$ACCESSKEY){
	
	$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
		// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$conn->set_charset("utf8");
    $datos=str_replace("¬"," ",$_GET);
	$datos=str_replace("  ","",$datos);
	
	$usuario = isset($datos['user']) ? $conn->real_escape_string($datos['user']) : '';
	$entrada = isset($datos['entrada']) ? $conn->real_escape_string($datos['entrada']) : '';
	$responsable = isset($datos['responsable']) ? $conn->real_escape_string($datos['responsable']) : '';
	$ubicacion = isset($datos['ubicacion']) && $datos['ubicacion'] != '0' ? $conn->real_escape_string($datos['ubicacion']) : 1;
	$medio = isset($datos['medio']) ? $conn->real_escape_string($datos['medio']) : '';

	$imgName = isset($datos['fileName']) ? $conn->real_escape_string($datos['fileName']) : '';

	//La app puede mandar como código el mismo valor que el nombre de usuario por lo que se valida que no sea sí
	$codigo = isset($datos['codigo']) && $datos['codigo'] != $usuario ? $conn->real_escape_string($datos['codigo']) : '';
	
		$sql = "INSERT INTO asistencia (codigo_usuario, nombre, accion_registro, fk_usuario, fk_servicio, medio_registro) VALUES('$codigo','{$usuario}',{$entrada},{$responsable},(SELECT pk_servicio FROM servicio WHERE servicio='{$ubicacion}' && activo=1 LIMIT 1),'{$medio}') ; ";
		
		$conn->query($sql);

		if($conn->affected_rows == 1){
			 $last_id = $conn->insert_id;
			if (file_put_contents($imgName,$data)) {

				if (filesize($imgName) != 0) {
					$nombre_foto = getRandomCode() . ".jpg";
			 		rename($imgName,"fotosAsistencia/".$nombre_foto);
					  //Acomodando orientación de la foto
					  chmod("fotosAsistencia/".$nombre_foto, 0755);
					 
					  ExifCleaning::adjustImageOrientation("fotosAsistencia/".$nombre_foto);
					  //Termina acomodo de orientación
					  $sql ="UPDATE asistencia SET foto_asistencia='{$nombre_foto}' WHERE pk_asistencia = {$last_id}";
					  
					  $conn->query($sql);
			 		echo "2/Registro exitoso";

				} else {
			      header("HTTP/1.0 400 Bad Request");
			      echo "File is empty.";
			    }
			} else {
			    header("HTTP/1.0 400 Bad Request");
			    echo "File transfer failed.";
		 	}
			
		} else {
			
			header("HTTP/1.0 400 Bad Request");
			echo "Error al ingresar los datos";
			//echo $sql;
		}
  
} else {
  header("HTTP/1.0 400 Bad Request");
  echo "Access denied";     //reports if accesskey is wrong
}

?>