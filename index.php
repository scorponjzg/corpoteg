<?php 
session_start();

if (isset($_SESSION["tipo_corpoteg"]) && isset($_SESSION["usuario_corpoteg"])) {
   // header("Location: visor_general_laboratorio.php"); /* Redirect browser */
	
	//exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/acreditar_usuario.js"></script>
</head>
<body> 
 
<div class="container">
	<!--div style="text-align: center;">
		<img src="img/logo-laveco.png" alt="ViviLab" width="360" height="140">
	</div-->
			 <div class="panel panel-default" style="width:50%; margin: 50px auto; text-align:center">
			<form action="/action_page.php" style="margin: 10px;" id='formulario'>
				<div class="form-group">
					<div style="display: none; color: red" id="incorrecto">
						<label>Usuario o contrase&ntilde;a incorrectos...</label>
					</div>
					<label for="usuario">Usuario:</label>
					<input type="text" class="form-control" id="usuario" name="usuario">
				</div>
				<div class="form-group">
					<label for="contrasena">Contrase&ntilde;a:</label>
					<input type="password" class="form-control" id="contrasena" name="contrasena">
				</div>
				  
				<button type="submit" class="btn btn-info" style="margin: 0 auto;">
				 Ingresar</button>
				<br>
				
			</form>
	  </div>
</div>

</body>
</html>