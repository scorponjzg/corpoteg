<?php
/*
 * Written By: Taifun
 * using parts from the "Web2SQL example" from ShivalWolf
 * and parts from the "POST any local file to a php server example" from Scott
 *
 * Date: 2013/Mar/05
 * Contact: info@puravidaapps.com
 *
 * Version 2: 'dirname(__FILE__)' added to avoid problems finding the complete path to the script  
 */

/************************************CONFIG****************************************/

 session_start();

 require_once 'configMySQL.php';
 include ("class.ExifCleaning.php");
//SETTINGS//
//This code is something you set in the APP so random people cant use it.
$ACCESSKEY="corpoteg";

/************************************CONFIG****************************************/

//these are just in case setting headers forcing it to always expire
header('Content-Type: text/html; charset=UTF-8');  
header('Cache-Control: no-cache, must-revalidate');

	
if($_GET['p']==$ACCESSKEY){
	//error_log(print_r($_GET, true));
	
	$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
		// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$conn->set_charset("utf8");
    $datos=str_replace("¬"," ",$_GET);
	$datos=str_replace("  ","",$datos);
	
	$a_paterno = isset($datos['a_paterno']) ? $conn->real_escape_string($datos['a_paterno']) : '';
	$a_materno = isset($datos['a_materno']) ? $conn->real_escape_string($datos['a_materno']) : '';
	$nombre = isset($datos['nombre']) ? $conn->real_escape_string($datos['nombre']) : '';
	$servicio = isset($datos['servicio']) ? $conn->real_escape_string($datos['servicio']) : '';
	$servicio = explode("-", $servicio);
	$turno = isset($datos['turno']) ? $conn->real_escape_string($datos['turno']) : '';
	$nss = isset($datos['nss']) ? $conn->real_escape_string($datos['nss']) : '';
	$curp = isset($datos['curp']) ? $conn->real_escape_string($datos['curp']) : '';
	$tipo_sangre = isset($datos['tipo_sangre']) ? $conn->real_escape_string($datos['tipo_sangre']) : '';
	$contacto = isset($datos['numero_emergencia']) ? $conn->real_escape_string($datos['numero_emergencia']) : '';
	$alergia = isset($datos['alergia']) ? $conn->real_escape_string($datos['alergia']) : '';
	$fecha_ingreso = isset($datos['fecha_ingreso']) ? $conn->real_escape_string($datos['fecha_ingreso']) : '';
	$telefono_personal = isset($datos['telefono_personal']) ? $conn->real_escape_string($datos['telefono_personal']) : '';
	$reclutador = isset($datos['reclutador']) ? $conn->real_escape_string($datos['reclutador']) : '1';
  // this is the workaround for file_get_contents(...)
  require_once (dirname(__FILE__).'/PHP_Compat-1.6.0a3/Compat/Function/file_get_contents.php');
  $data = php_compat_file_get_contents('php://input');

  $filename = $_GET['filename'];
  
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

  if (file_put_contents($filename,$data)) {
	  
    if (filesize($filename) != 0) {
		$nombre_foto = getRandomCode() . ".jpg";
		
		$tipo_sangre = strlen($tipo_sangre) > 3 ? '----' : $tipo_sangre;
		$sql = "INSERT INTO usuario(fk_perfil, nombre, a_paterno, a_materno, nss, curp, tipo_sangre, contacto, alergia, telefono, direccion, fk_medio, fk_estatus, reclutador, nombre_foto,fecha_contrato) VALUE (3,'{$nombre}', '{$a_paterno}', '{$a_materno}', '{$nss}','{$curp}','{$tipo_sangre}','{$contacto}','{$alergia}', '{$telefono_personal}', '', 1, 2, {$reclutador}, '{$nombre_foto}','{$fecha_ingreso}');";
		
		$conn->query($sql);

		if($conn->affected_rows == 1){
			  $last_id = $conn->insert_id;
			//Confirmando que se creeo el usuario asignamos a la vacante que se postulo
			 $sql = "INSERT INTO asignado(fk_vacante,fk_usuario) VALUES($servicio[0],$last_id)";
			 $conn->query($sql);
			 
			 if($conn->affected_rows == 1){ 
				  $returnJs['registrado'] = true;
				  rename($filename,"fotos/".$nombre_foto);
					  //Acomodando orientación de la foto
					  chmod("fotos/".$nombre_foto, 0755);
					  ExifCleaning::adjustImageOrientation("fotos/".$nombre_foto);
					  //Termina acomodo de orientación
				  echo "2/File transfer completed.";
				} else {
					echo "2/Error file.";
				}
		} else {
			
			header("HTTP/1.0 400 Bad Request");
			echo "Error al ingresar los datos";
		}
	
	 
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
  echo "Access denied";     //reports if accesskey is wrong
}

?>