<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registro</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-3.1.0.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/registro.js"></script>
</head>
<body> 
<style>
 .btn-file {
  position: relative;
  overflow: hidden;
  }
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}
</style>
<div class="container">
  
  <div class="panel panel-default" style="width:50%; margin: 50px auto; text-align:center">
    <form action="#" style="margin: 10px;" id='formulario' autocomplete="off" enctype="multipart/form-data">
		<div class="well">	
			
			<div class="form-group">		 
				<label for="codigo">*C&oacute;digo:</label>
				<input type="text" class="form-control" id="codigo" name="codigo">
			</div>		
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
				<label for="nacimiento">*Fecha de nacimiento:</label>
				<input type="date" class="form-control" id="nacimiento" name="nacimiento"  >
			 </div>
			 
			 <div class="form-group" style="text-align: center">
				<span class="btn btn-default btn-file">
			    Seleccione foto del usuario <input type="file" name="file" onchange="previewImage(1);" id="uploadImage1">
			</span>
				<br>
				<br>
				<img id="uploadPreview1" width="150" height="150" src="img/image_not_available.png" />
			</div>
			 <div class="form-group">	
				<label for="nss">*N&uacute;mero de seguro social:</label>
				<input type="text" class="form-control" id="nss" name="nss"  >
			 </div>
			 <div class="form-group">	
				<label for="curp">*CURP:</label>
				<input type="text" class="form-control" id="curp" name="curp"  >
			 </div>
			  <div class="form-group">	
				<label for="sangre">*Tipo de sangre:</label>
				<input type="text" class="form-control" id="sangre" name="sangre"  >
			 </div>
			 <div class="form-group">	
				<label for="alegia">*Alergias:</label>
				<input type="text" class="form-control" id="alegia" name="alegia"  >
			 </div>
			 <div class="form-group">	
				<label for="contacto">*Contacto emergencia (nombre y tel.):</label>
				<input type="text" class="form-control" id="contacto" name="contacto"  >
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
			 
				  <label for="reclutador">Reclutador:</label>
				<select class="form-control" id="reclutador" name="reclutador">
					<option value="1">Ya contratado
					</option>
					<option value="2">ALEJANDRA CHAVEZ CISNEROS
					</option>
					
					
					
				</select>
			 <div class="form-group">		
				<label for="tel">Tel&eacute;fono / Celular:</label>
				<input type="text" class="form-control" id="tel" name="tel">
			 </div>	
			 <div class="form-group">
			</div>	
			<div class="form-group">		 
				<label for="servicio">Servicio:</label>
				<select  class="form-control" id="servicio" name="servicio">
					<option value="0">Seleccione un servicio</option>
				</select>
				
			</div> 	
			<div class="form-group">		 
				<label for="turno">Turno:</label>
				<select  class="form-control" id="turno" name="turno">
					<option value="0">Seleccione un turno</option>
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