<?php

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	
  session_start();
	
  require_once 'configMySQL.php';

	$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
		// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	function mes($mes){

		$separador = explode("-",$mes);

		switch($separador[1]){

			case 1:
				$mes = $separador[0].'-'.'ene'.'-'. $separador[2];
			break ;

			case 2:
				$mes = $separador[0].'-'.'feb'.'-'. $separador[2];
			break;

			case 3:
				$mes = $separador[0].'-'.'mar'.'-'. $separador[2];
			break;

			case 4:
				$mes = $separador[0].'-'.'abr'.'-'. $separador[2];
			break;

			case 5:
				$mes = $separador[0].'-'.'may'.'-'. $separador[2];
			break;

			case 6:
				$mes = $separador[0].'-'.'jun'.'-'. $separador[2];
			break;

			case 7:
				$mes = $separador[0].'-'.'jul'.'-'. $separador[2];
			break;

			case 8:
				$mes = $separador[0].'-'.'ago'.'-'.$separador[2];
			break;

			case 9:
				$mes = $separador[0].'-'.'sep'.'-'.$separador[2];
			break;

			case 10:
				$mes = $separador[0].'-'.'oct'.'-'.$separador[2];
			break;

			case 11:
				$mes = $separador[0].'-'.'nov'.'-'.$separador[2];
			break;

			case 12:
				$mes = $separador[0].'-'.'dic'.'-'.$separador[2];
			break;

		}

		return $mes;
	}

	$conn->set_charset("utf8");

	$entrada = array("entrada" => "No hay registro");
	$salida = array("salida" => "No hay registro");
	$returnJs = [];
	$returnJs['asistencia'] = ["entrada"=>"","salida"
		=>"","fecha"=>"", "codigo"=> "","nombre"=>"No se encuentra un horario registrado"];

	$fecha = isset($_POST['fecha']) ? $conn->real_escape_string($_POST['fecha']) : '';
	$pk_vacante = isset($_POST['turno']) ? $conn->real_escape_string($_POST['turno']) : '';
	$vacante = [];
	//error_log($fecha);
	$fecha_actual = date($fecha);
	//error_log(date("Y-m-d",strtotime($fecha_actual."+ 1 days"))); 
	
	$sql = "SELECT fk_servicio, SUBSTRING_INDEX(hora_entrada, ' ', -1) AS entrada, SUBSTRING_INDEX(hora_salida, ' ', -1) AS salida FROM vacante WHERE pk_vacante = $pk_vacante";

	$result = $conn->query($sql);
	
	
	if ($result->num_rows == 1) {//->num_rows = 1
			$vacante = $result->fetch_assoc();
			//error_log(print_r($vacante,true));
			$serprarar_entrada = explode(":",$vacante["entrada"]);
			$serparar_salida = explode(":",$vacante["salida"]);
			$entrada = $serprarar_entrada[0] - 1;
			$entrada2 = $serprarar_entrada[0] + 2;
			$salida = $serparar_salida[0] + 1;
			$salida2 = $serparar_salida[0] - 2;
			$temporal_entrada = "";
			$temporal_salida = "";


			if($entrada < 10){
				$entrada = '0'.$entrada;
			}

			if($salida < 10){
				$salida = '0'.$salida;
			}
			if($entrada2 < 10){
				$entrada2 = '0'.$entrada2;
			}

			if($salida2 < 10){
				$salida2 = '0'.$salida2;
			}

			$vacante['entrada'] = $fecha.' '.$entrada.':'.$serprarar_entrada[1];
			$temporal_entrada = $fecha.' '.$entrada2.':'.$serprarar_entrada[1];
			//Verificamos si la salida no es antes de las 7 am, sería horario nocturno, por lo que a fecha de salida se le aumenta un día
			if($serparar_salida[0] <= 7){

				$fecha_actual = date($fecha);
				$vacante['salida'] = (date("Y-m-d",strtotime($fecha_actual."+ 1 days")).' '.$salida.':'.$serparar_salida[1]);
				$temporal_salida = (date("Y-m-d",strtotime($fecha_actual."+ 1 days")).' '.$salida2.':'.$serparar_salida[1]);
			} else {

				$vacante['salida'] = $fecha.' '.$salida.':'.$serparar_salida[1];
				$temporal_salida = $fecha.' '.$salida2.':'.$serparar_salida[1];
			}
		
			$sql = "SELECT  nombre, IFNULL(codigo_usuario,'No registrado') as codigo FROM asistencia WHERE fk_servicio = {$vacante['fk_servicio']} && ((hora_registro BETWEEN '{$vacante['entrada']}' AND '{$temporal_entrada}' AND accion_registro = 1 ) || (hora_registro BETWEEN '{$temporal_salida}' AND '{$vacante['salida']}' AND accion_registro = 0 ))  GROUP BY nombre ORDER BY nombre ;";

			//error_log($sql);
			$returnJs['sql'] = ["sql"=>$sql];
			$result1 = $conn->query($sql);
			
			if ($result1->num_rows > 0) {
				$registro = [];
				while($resultado1 = $result1->fetch_assoc()){
					$registro = [];

					
					$sql = "SELECT IFNULL((SELECT  SUBSTRING_INDEX(hora_registro, ' ', -1) FROM asistencia WHERE  fk_servicio = {$vacante['fk_servicio']} && hora_registro BETWEEN '{$vacante['entrada']}' AND '{$temporal_entrada}' && accion_registro = 1 && nombre = '{$resultado1['nombre']}' LIMIT 1 ),'No registrada') AS entrada, IFNULL((SELECT   SUBSTRING_INDEX(hora_registro, ' ', -1) FROM asistencia WHERE  fk_servicio = {$vacante['fk_servicio']} && hora_registro BETWEEN '{$temporal_salida}' AND '{$vacante['salida']}' && accion_registro = 0 && nombre = '{$resultado1['nombre']}' ORDER BY pk_asistencia DESC LIMIT 1),'No registrado') AS salida FROM asistencia WHERE fk_servicio = {$vacante['fk_servicio']} && nombre = '{$resultado1['nombre']}' && hora_registro BETWEEN '{$vacante['entrada']}' AND '{$vacante['salida']}' LIMIT 1" ;
					//	error_log($sql);
					$result_acceso = $conn->query($sql);
						
							$registro= $result_acceso->fetch_assoc();
		
						$result_acceso ->free();
						
					$usuarios[] = array_merge($resultado1,$registro);
					

				}//fin while
				unset($registro);
				//error_log(print_r($resultado,true));
				//error_log(print_r($usuarios,true));
				$returnJs['asistencia'] = $usuarios;
				$returnJs['fecha'] = $fecha;
				unset($usuarios);
			}

    } else {
				
		$returnJs['asistencia'] = ["entrada"=>"","salida"
		=>"","fecha"=>"", "codigo"=> "","nombre"=>"No se encuentra un horario registrado"];
	}
		
	$result->free();
	$result1->free();
	$returnJs['fecha'] = mes($fecha);
	echo json_encode($returnJs);
	$conn->close();
}