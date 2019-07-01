<!DOCTYPE html>
<html lang="en">
<head>
  <title>reporte actividad</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/registro.js"></script>
</head>
<body> 
 
<div class="container">
  
  <div class="panel panel-default" style="width:50%; margin: 50px auto; text-align:center">
    <form action="#" style="margin: 10px;" id='formulario' autocomplete="off">
		<div class="well">			
			<div class="form-group">		 
				<label for="nombre">*Nombre:</label>
				<input type="text" class="form-control" id="nombre" name="nombre">
			</div>
			 <div class="form-group">		
				<label for="a_paterno">*Apellido paterno:</label>
				<input type="text" class="form-control" id="a_paterno" name="a_paterno">
			 </div>	
			 <div class="form-group">	
				<label for="a_materno">Apellido materno:</label>
				<input type="text" class="form-control" id="a_materno" name="a_materno">
			 </div>
			 <div class="form-group">	
				<label for="edad">Edad:</label>
				<input type="number" class="form-control" id="edad" name="edad" min="18"  >
			 </div>
			<div class="form-group">	
				<label for="direccion">Direcci&oacute;n:</label>
				<textarea rows="3" class="form-control" id="direccion" name="direccion"></textarea>
			 </div>
			<div class="form-group">
				  <label for="medio">Medio de contacto:</label>
				  <select class="form-control" id="medio" name="medio">
					<option value="1">Campo</option>
					<option value="2">Facebook</option>
					<option value="3">Referido</option>
					<option value="4">Indeed</option>
					<option value="5">Grupos facebook</option>
				  </select>
			</div>	 
			<div class="form-group">
				  <label for="estatus">Estatus:</label>
				  <select class="form-control" id="estatus" name="estatus">
					<option value="1">Contratado</option>
					<option value="2">Deje recado</option>
					<option value="3">Entrevista</option>
					<option value="1">Marcar despu&eacute;s</option>
					<option value="4" style="color:red;">No interesado</option>
				  </select>
			</div>	 			
			 <div class="form-group">		 
				<label for="servicio">Servicio:</label>
				<input type="text" class="form-control" id="servicio" name="servicio">
			</div>
			 <div class="form-group">		
				<label for="tel">Tel&eacute;fono / Celular:</label>
				<input type="text" class="form-control" id="tel" name="tel">
			 </div>	
			 <div class="form-group">
				  <label for="reclutador">Reclutador:</label>
				<select class="form-control" id="reclutador" name="reclutador">
					<option value="1">Ya contratado
					</option>
					<option value="2">ALEJANDRA CHAVEZ CISNEROS
					</option>
					
					
					</option>
				</select>
			</div>	 	
			 					
			  <button type="button" class="btn btn-danger" style="margin-right:25px" id="regresar">Regresar</button>
			  <button type="submit" class="btn btn-success" style="margin: 0 auto;">Registrarse</button>
			  <br>
			  <br>
		</div>
 </form>
  </div>
</div>

</body>
</html>