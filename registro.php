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

.row {

	margin-bottom : 10px !important; 
}
</style>
<div class="container">
  
  <div class="panel panel-default" style="width:50%; margin: 50px auto; text-align:center">
    <form action="#" style="margin: 10px;" id='formulario' autocomplete="off" enctype="multipart/form-data">
		<div class="well">	
			<div class="form-group">
				  <label for="empresa">*Empresa:</label>
				  <select class="form-control" id="empresa" name="empresa">

				  </select>
			</div>	 
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
				<img id="uploadPreview1" width="110" height="150" src="img/image_not_available.png" />
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
				<label for="alergia">Alergias:</label>
				<input type="text" class="form-control" id="alergia" name="alergia"  >
			 </div>
			 <div class="form-group">	
				<label for="contacto">*Contacto emergencia (nombre y tel.):</label>
				<input type="text" class="form-control" id="contacto" name="contacto"  >
			 </div>

			<div class="form-group">	
				<label for="direccion">*Direcci&oacute;n:</label>
				<textarea rows="3" class="form-control" id="direccion" name="direccion"></textarea>
			 </div>
			<div class="form-group">
				  <label for="medio">Medio de contacto:</label>
				  <select class="form-control" id="medio" name="medio">
					
				  </select>
			</div>	 
			<div class="form-group">
				  <label for="estatus">Estatus:</label>
				  <select class="form-control" id="estatus" name="estatus">
					
				  </select>
			</div>	 			
			 <div class="form-group">
				  <label for="reclutador">Reclutador:</label>
				<select class="form-control" id="reclutador" name="reclutador">
					<option value="1">Ya contratado
					</option>
					<option value="2">ALEJANDRA CHAVEZ CISNEROS
					</option>
					
					
					
				</select>
			</div>
			 <div class="form-group">		
				<label for="tel">*Tel&eacute;fono / Celular:</label>
				<input type="text" class="form-control" id="tel" name="tel">
			 </div>	
			 <div class="form-group">
			</div>	
			<div class="form-group">		 
				<label for="servicio">*Servicio:</label>
				<select  class="form-control" id="servicio" name="servicio">
					<option value="0">Seleccione un servicio</option>
				</select>
				
			</div> 	
			<div class="form-group">		 
				<label for="turno">*Turno:</label>
				<select  class="form-control" id="turno" name="turno">
					<option value="0">Seleccione un turno</option>
				</select>
				
			</div> 	
			<div class="row">
			  <div class="col-sm-4">*Horario: </div>
			  <div class="col-sm-4">*Entrada</div>
			  <div class="col-sm-4">*Salida</div>
			</div>
			<div class="row">
			  <div class="col-sm-4">Lunes: </div>
			  <div class="col-sm-4"><input type="time" name="l-e" id="l-e"></div>
			  <div class="col-sm-4"><input type="time" name="l-s" id="l-s"></div>
			</div>
			<div class="row">
			  <div class="col-sm-4">Martes: </div>
			  <div class="col-sm-4"><input type="time" name="m-e" id="m-e"></div>
			  <div class="col-sm-4"><input type="time" name="m-s" id="m-s"></div>
			</div>
			<div class="row">
			  <div class="col-sm-4">Miércoles: </div>
			  <div class="col-sm-4"><input type="time" name="mi-e" id="mi-e"></div>
			  <div class="col-sm-4"><input type="time" name="mi-s" id="mi-s"></div>
			</div>
			<div class="row">
			  <div class="col-sm-4">Jueves: </div>
			  <div class="col-sm-4"><input type="time" name="j-e" id="j-e"></div>
			  <div class="col-sm-4"><input type="time" name="j-s" id="j-s"></div>
			</div>
			<div class="row">
			  <div class="col-sm-4">Viernes: </div>
			  <div class="col-sm-4"><input type="time" name="v-e" id="v-e"></div>
			  <div class="col-sm-4"><input type="time" name="v-s" id="v-s"></div>
			</div>
			<div class="row">
			  <div class="col-sm-4">Sábado: </div>
			  <div class="col-sm-4"><input type="time" name="s-e" id="s-e"></div>
			  <div class="col-sm-4"><input type="time" name="s-s" id="s-s"></div>
			</div>
			<div class="row">
			  <div class="col-sm-4">Domingo: </div>
			  <div class="col-sm-4"><input type="time" name="d-e" id="d-e"></div>
			  <div class="col-sm-4"><input type="time" name="d-s" id="d-s"></div>
			</div>
			<div class="form-group">		
				<label for="salario">*Salario quincenal:</label>
				<input type="text" class="form-control" id="salario" name="salario">
			 </div>	
			 <div class="form-group">		
				<label for="horas">*Horas que se laboran al día:</label>
				<input type="number" class="form-control" id="horas" name="horas" min="1">
			 </div>	
			 <div class="row">
			  <div class="col-sm-4">Fecha y folio de alta en IMSS: </div>
			  <div class="col-sm-4"><input type="date" name="alta" id="alta"></div>
			  <div class="col-sm-4"><input type="text" class="form-control" id="folio" name="folio" placeholder="Folio de alta IMSS"></div>
			</div>
			 					
			  <button type="button" class="btn btn-danger" style="margin-right:25px" id="regresar">Cancelar</button>
			  <button type="submit" class="btn btn-success" style="margin: 0 auto;">Registrarse</button>
			  <br>
			  <br>
		</div>
 </form>
  </div>
</div>

</body>
</html>