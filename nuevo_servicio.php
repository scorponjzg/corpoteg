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
  <title>Nuevo servicio</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/nuevo_servicio.js"></script>
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
        <label for="nombre">*Cliente:</label>
        <select class="form-control" id="cliente" name="cliente">
          <option value="0">Seleccione un cliente</option>
        </select>       
      </div>
			<div class="form-group">		 
				<label for="nombre">*Nombre:</label>
				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese un nombre de servicio">
			</div>
      <div class="form-group checkbox">        
        <label><input type="checkbox" name="permitir" id="permitir" value="1">Permitir asistencia manual </label>

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