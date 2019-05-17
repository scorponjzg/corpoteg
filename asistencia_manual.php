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
  <title>Asistencia manual</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/asistencia_manual.js"></script>
</head>
<body> 
 <style>
 	
 	input {
 		text-align: center;
 	}

 	
 </style>
<div class="container">
  <?php include 'navMenu.php'?>
  <div class="panel panel-default" style="width:50%; margin: 80px auto; text-align:center;">
    <form action="#" style="margin: 10px;" id='formulario' autocomplete="off">
		<div class="well">		
			<div class="form-group">		 
				<label for="servicio">*Servicio:</label>
				<select class="form-control" id="servicio" name="servicio">
          <option value="0">Seleccione un servicio</option>    
        </select>
			</div>
      <div class="form-group">     
        <label for="tipo">*Tipo de registro:</label>
        <select class="form-control" id="tipo" name="tipo">
           <option value="n">Seleccione el tipo de registro</option>
          <option value="1">Entrada</option>  
          <option value="0">Salida</option>  
        </select>
      </div>
      <div class="form-group">     
        <label for="fecha">*Fecha registro</label>
        <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Ingrese una fecha">
      </div>
      <div class="form-group">     
        <label for="hora">*Hora registro:</label>
        <input type="time" class="form-control" id="hora" name="hora" placeholder="Ingrese la hora del registro">
      </div>
      <div class="form-group">     
        <label for="codigo">*Código usuario:</label>
        <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Ingrese el código del usuario">
      </div>
      <div class="form-group">     
        <label for="nombre">*Nombre de usuario</label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese un nombre del usuario">
      </div>

			 
			  <button type="commit" class="btn btn-info " style="margin-right:25px;" >Guardar</button>
			  <button type="button" class="btn btn-danger " style="margin: 0 auto;" onclick="window.location.replace('requerimiento.php');">Cancelar</button>
			  <br>
			  <br>
		</div>
 </form>
  </div>
</div>

</body>
</html>