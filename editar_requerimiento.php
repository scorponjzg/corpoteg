<?php 
session_start();
if (!isset($_SESSION["tipo_corpoteg"]) && !isset($_SESSION["tipo_corpoteg"])) {
    header("Location: index.php"); /* Redirect browser */
	
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edita requerimiento</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/edita_requerimiento.js"></script>
</head>
<body> 
 <style>
 	
 	input {
 		text-align: center;
 	}

 	.read{
 		border: #ccc 1px solid;
 		padding: 6px 12px;
 		border-radius: 4px;
 		font-size: 14px;
 		color: #555;
 	}
 </style>
<div class="container">
  <?php include 'navMenu.php'?>
  <div class="panel panel-default" style="width:50%; margin: 70px auto; text-align:center">
   <form action="#" style="margin: 10px;" id='formulario' autocomplete="off">
		<div class="well">
			<input type="hidden" id="pk" name="pk">	
			  <div class="form-group">		 
				<label for="servicio">*Servicio:</label>
				<select class="form-control" id="servicio" name="servicio" placeholder="Ingrese un nombre del turno">
		          <option value="0">Seleccione un servicio</option>    
		        </select>
			  </div>
		      <div class="form-group">     
		        <label for="turno">*Turno:</label>
		        <select class="form-control" id="turno" name="turno" placeholder="Ingrese un nombre del turno">
		          <option value="0">Seleccione un turno</option>  
		        </select>
		      </div>
		      <div class="form-group">     
		        <label for="personal">*Personal requerido:</label>
		        <input type="number" class="form-control" id="personal" name="personal" min="1" placeholder="Ingrese la cantiad personal solicitado">
		      </div>
		      <div class="form-group">     
		        <label for="entrada">*Hora entrada:</label>
		        <input type="time" class="form-control" id="entrada" name="entrada" placeholder="Ingrese un nombre del turno">
		      </div>
		      <div class="form-group">     
		        <label for="salida">*Hora salida:</label>
		        <input type="time" class="form-control" id="salida" name="salida" placeholder="Ingrese un nombre del turno">
		      </div>
		      <div class="form-group">     
		        <label for="te">*Tolerancia entrada:</label>
		        <input type="time" class="form-control" id="te" name="te" placeholder="Ingrese un nombre del turno">
		      </div>
		      <div class="form-group">     
		        <label for="ts">*Tolerancia salida:</label>
		        <input type="time" class="form-control" id="ts" name="ts" placeholder="Ingrese un nombre del turno">
		      </div>

		  <button type="submit" class="btn btn-info" style="margin-right:25px;" id="editar">Guardar cambios</button>
		   <button type="button" class="btn btn-danger" style="margin-right:25px;" id="eliminar" >Eliminar</button>
		  <button type="button" class="btn btn-warning" style="margin: 0 auto;" id="cancelar">Cancelar</button>
		  <br>
		  <br>
		</div>
 </form>
  </div>
</div>

</body>
</html>