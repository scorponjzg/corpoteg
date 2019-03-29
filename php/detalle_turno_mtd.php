<?php

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	
  session_start();
	
  require_once 'configMySQL.php';

	$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
		// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$returnJs = [];

	$id = isset($_POST['turno']) ? $_POST['turno'] + 0 : 0;
	

	$sql = "SELECT turno, pk_turno as id from turno WHERE pk_turno= ".$id;
   								
	$result = $conn->query($sql);
	
	if ($result->num_rows == 1) {
	
		$returnJs['turno']= $result->fetch_assoc();
	
	} else{
		
		$returnJs['turno'][]= "No hay turnos registados";
	}
	
		$result->free();
					
	echo json_encode($returnJs);
	$conn->close();
}