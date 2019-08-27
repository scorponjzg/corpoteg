<?php 
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	if(isset($_SESSION['tipo_corpoteg']) && $_SESSION['tipo_corpoteg'] == 1){

		require_once 'configMySQL.php';
		
		$returnJs = [];
		$returnJs['ingresado'] = 'Por el momento no se encuentra en la funcionalidad activa, intente más tarde.';
		$returnJs['correcto'] = 'false';
		$correcto_horario = false;
		$correcto_usuario = false;
		$correto_imagen = false;
		$correcto_vacante = false;
		$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
		
		//check connection_aborted
		if($conn -> connect_error) {
			die("Connection failed: " . $conn -> connect_error);		
		}
		
		$conn -> set_charset('utf8');
		/*
		if (($_FILES["file"]["type"] == "image/pjpeg")
		    || ($_FILES["file"]["type"] == "image/jpeg")
		    || ($_FILES["file"]["type"] == "image/png")
		    || ($_FILES["file"]["type"] == "image/gif")) {
		    if (move_uploaded_file($_FILES["file"]["tmp_name"], "images/".$_FILES['file']['name'])) {
		        //more code here...
		        echo "images/".$_FILES['file']['name'];
		    } else {
		        echo 0;
		    }
		} else {
		    echo 0;
		}*/
		
		$codigo = isset($_POST['codigo']) ? $conn->real_escape_string($_POST['codigo']) : '';
		$nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : '';
		$a_paterno = isset($_POST['a_paterno']) ? $conn->real_escape_string($_POST['a_paterno']) : '';
		$a_materno = isset($_POST['a_materno']) ? $conn->real_escape_string($_POST['a_materno']) : '';
		$nacimiento = isset($_POST['nacimiento']) ? $conn->real_escape_string($_POST['nacimiento']) : '';
		$nss = isset($_POST['nss']) ? $conn->real_escape_string($_POST['nss']) : '';
		$curp = isset($_POST['curp']) ? $conn->real_escape_string($_POST['curp']) : '';
		$sangre = isset($_POST['sangre']) ? $conn->real_escape_string($_POST['sangre']) : '';
		$alergia = isset($_POST['alergia']) ? $conn->real_escape_string($_POST['alergia']) : '';
		$contacto = isset($_POST['contacto']) ? $conn->real_escape_string($_POST['contacto']) : '';
		$direccion = isset($_POST['direccion']) ? $conn->real_escape_string($_POST['direccion']) : '';
		$medio = isset($_POST['medio']) ? $conn->real_escape_string($_POST['medio']) : '';
		$estatus = isset($_POST['estatus']) ? $conn->real_escape_string($_POST['estatus']) : '';
		$reclutador = isset($_POST['reclutador']) ? $conn->real_escape_string($_POST['reclutador']) : '';
		$tel = isset($_POST['tel']) ? $conn->real_escape_string($_POST['tel']) : '';
		$servicio = isset($_POST['servicio']) ? $conn->real_escape_string($_POST['servicio']) : '';
		$id_vacante = isset($_POST['turno']) ? $conn->real_escape_string($_POST['turno']) : '';
		$empresa = isset($_POST['empresa']) ? $conn->real_escape_string($_POST['empresa']) : '';
		$l_e = isset($_POST['l-e']) ? $conn->real_escape_string($_POST['l-e']) : '';
		$l_s = isset($_POST['l-s']) ? $conn->real_escape_string($_POST['l-s']) : '';
		$m_e = isset($_POST['m-e']) ? $conn->real_escape_string($_POST['m-e']) : '';
		$m_s = isset($_POST['m-s']) ? $conn->real_escape_string($_POST['m-s']) : '';
		$mi_e = isset($_POST['mi-e']) ? $conn->real_escape_string($_POST['mi-e']) : '';
		$mi_s = isset($_POST['mi-s']) ? $conn->real_escape_string($_POST['mi-s']) : '';
		$j_e = isset($_POST['j-e']) ? $conn->real_escape_string($_POST['j-e']) : '';
		$j_s = isset($_POST['j-s']) ? $conn->real_escape_string($_POST['j-s']) : '';
		$v_e = isset($_POST['v-e']) ? $conn->real_escape_string($_POST['v-e']) : '';
		$v_s = isset($_POST['v-s']) ? $conn->real_escape_string($_POST['v-s']) : '';
		$s_e = isset($_POST['s-e']) ? $conn->real_escape_string($_POST['s-e']) : '';
		$s_s = isset($_POST['s-s']) ? $conn->real_escape_string($_POST['s-s']) : '';
		$d_e = isset($_POST['d-e']) ? $conn->real_escape_string($_POST['d-e']) : '';
		$d_s = isset($_POST['d-s']) ? $conn->real_escape_string($_POST['d-s']) : '';
		$salario = isset($_POST['salario']) ? $conn->real_escape_string($_POST['salario']) : '';
		$horas = isset($_POST['horas']) ? $conn->real_escape_string($_POST['horas']) : '';
		$alta = isset($_POST['alta']) ? $conn->real_escape_string($_POST['alta']) : '';
		$folio = isset($_POST['folio']) ? $conn->real_escape_string($_POST['folio']) : '';
		$nombre_foto = "";
		$insert_horario = "";
		



		$alta_imss = $alta != '' ? ", `activo_imss`, `folio_imss`" : '';
		$folio_imss = $alta != '' ? ", '{".$alta."}','{".$folio."}'" : '';

		if (move_uploaded_file($_FILES["file"]["tmp_name"], "../img/foto/".$curp.'.jpg')) {

				$nombre_foto = $curp.'jgp';
				$correto_imagen =  true;
		    } 
			$sql = "INSERT INTO `usuario`(`codigo`,  `nombre`, `a_paterno`, `a_materno`, `telefono`, `nss`, `curp`, `tipo_sangre`, `contacto`, `alergia`, `direccion`, `fk_medio`, `fk_perfil`, `fk_estatus`, `reclutador`, `nombre_foto`, `quincena`, `jornada`, `fecha_nacimiento`, `fk_empresa`".$alta_imss.") VALUES ('{$codigo}', '{$nombre}', '{$a_paterno}', '{$a_materno}','{$tel}', '{$nss}', '{$curp}', '{$sangre}', '{$contacto}', '{$alergia}', '{$direccion}', {$medio}, 4, {$estatus}, 1, '{$nombre_foto}',{$salario}, {$horas}, '{$nacimiento}', {$empresa}".$folio_imss." );";

			$conn->query($sql);
			
			if($conn->affected_rows == 1){

					$last_id = $conn->insert_id;

					if( $l_e != "" && $l_s != ""){

					$insert_horario = $insert_horario != "" ? $insert_horario.",(".$last_id.", 1, '".$l_e."','".$l_s."')" : "(".$last_id.", 1, '".$l_e."','".$l_s."')"; 
					}
					if( $m_e != "" && $m_s != ""){

					$insert_horario = $insert_horario != "" ? $insert_horario.",(".$last_id.", 2, '".$m_e."','".$m_s."')" : "(".$last_id.", 2, '".$m_e."','".$m_s."')"; 
					}
					if( $mi_e != "" && $mi_s != ""){

						$insert_horario = $insert_horario != "" ? $insert_horario.",(".$last_id.", 3, '".$mi_e."','".$mi_s."')" : "(".$last_id.", 3, '".$mi_e."','".$mi_s."')" ;
					}
					if( $j_e != "" && $j_s != ""){

						$insert_horario = $insert_horario != "" ? $insert_horario.",(".$last_id.", 4, '".$j_e."','".$j_s."')" : "(".$last_id.", 4, '".$j_e."','".$j_s."')" ;
					}
					if( $v_e != "" && $v_s != ""){

						$insert_horario = $insert_horario != "" ? $insert_horario.",(".$last_id.", 5, '".$v_e."','".$v_s."')" : "(".$last_id.", 5, '".$v_e."','".$v_s."')" ;
					}
					if( $s_e != "" && $s_s != ""){

						$insert_horario = $insert_horario != "" ? $insert_horario.",(".$last_id.", 6, '".$s_e."','".$s_s."')" : "(".$last_id.", 6, '".$s_e."','".$s_s."')" ;
					}
					if( $d_e != "" && $d_s != ""){

						$insert_horario = $insert_horario != "" ? $insert_horario.",(".$last_id.", 7, '".$d_e."','".$d_s."')" : "(".$last_id.", 7, '".$d_e."','".$d_s."')" ;
					}

					$sql = "INSERT INTO labora(fk_usuario, fk_dia, entrada, salida ) VALUES ".$insert_horario;
			
			$conn->query($sql);

			if($conn->affected_rows >= 1){

				$correcto_horario = 'true';
			}

			$sql = "INSERT INTO asignado(fk_usuario, fk_vacante) VALUES ({$last_id},{$id_vacante})";
			
			$conn->query($sql);

			if($conn->affected_rows == 1){

				$correcto_vacante = 'true';
			}
			
				$correcto_usuario = 'true';
			
			}

			if($correcto_usuario == true && $correcto_horario ==  true && $correto_imagen == true && $correcto_vacante == true){

				$returnJs['ingresado'] = 'Usuario registrado correctamente.';
				$returnJs['correcto'] = 'true';
			} else if($correcto_usuario == true ){

				$returnJs['ingresado'] = 'Usuario registrado con error en el horario, la foto o turno, favor de verificar.';
				$returnJs['correcto'] = 'true';
			} 
		
		echo json_encode($returnJs);
		$conn->close();
	} else {

		header("HTTP/1.0 400 Bad Request");

		echo "No tiene los permisos requieridos";
	}

}