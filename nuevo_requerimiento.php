<?php 
session_start();
if (!isset($_SESSION["tipo_corpoteg"]) && !isset($_SESSION["usuario_corpoteg"]) && $_SESSION['tipo_corpoteg'] == 1) {
    header("Location: index.php"); /* Redirect browser */
	
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Nuevo requerimiento</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/nuevo_requerimiento.js"></script>
</head>
<body> 
 <style>
 	
 	input {
 		text-align: center;
 	}

 	
 </style>
<div class="container">
  <?php include 'navMenu.php'?>
  <div class="panel panel-default" style="width:50%; margin: 80px auto; text-align:center">
    <form action="#" style="margin: 10px;" id='formulario' autocomplete="off">
		<div class="well">		
			<div class="form-group">		 
				<label for="servicio">*Servicio:</label>
				<select class="form-control" id="servicio" name="servicio" placeholder="Ingrese un nombre del turno">
          <option>No hay servicios registrados</option>    
        </select>
			</div>
      <div class="form-group">     
        <label for="turno">*Turno:</label>
        <select class="form-control" id="turno" name="turno" placeholder="Ingrese un nombre del turno">
          <option>No hay turnos registrados</option>  
        </select>
      </div>
      <div class="form-group">     
        <label for="nombre">*Personal requerido:</label>
        <input type="number" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el personal solicitado">
      </div>
      <div class="form-group">     
        <label for="nombre">*Hora entrada:</label>
        <input type="time" class="form-control" id="nombre" name="nombre" placeholder="Ingrese un nombre del turno">
      </div>
      <div class="form-group">     
        <label for="nombre">*Hora salida:</label>
        <input type="time" class="form-control" id="nombre" name="nombre" placeholder="Ingrese un nombre del turno">
      </div>
      <div class="form-group">     
        <label for="nombre">*Tolerancia entrada:</label>
        <input type="time" class="form-control" id="nombre" name="nombre" placeholder="Ingrese un nombre del turno">
      </div>
      <div class="form-group">     
        <label for="nombre">*Tolerancia salida:</label>
        <input type="time" class="form-control" id="nombre" name="nombre" placeholder="Ingrese un nombre del turno">
      </div>

			 
			  <button type="commit" class="btn btn-info " style="margin-right:25px;" >Guardar</button>
			  <button type="button" class="btn btn-danger " style="margin: 0 auto;" onclick="window.location.replace('servicio.php');">Cancelar</button>
			  <br>
			  <br>
		</div>
 </form>
  </div>
</div>

</body>
</html>