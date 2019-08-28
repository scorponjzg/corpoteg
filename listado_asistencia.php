<?php 
session_start();
if (!isset($_SESSION["tipo_corpoteg"]) && !isset($_SESSION["usuario_corpoteg"])) {
    header("Location: index.php"); /* Redirect browser */
	
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Listado asistecia</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/listado_asistencia.js"></script>
</head>
<body>

<style>
th {
	
	text-align:center;
}
</style>
	<div class="container centrado" style="padding-left: 0px;">
	<?php include 'navMenu.php'?>
	
<div class="starter-template" style="text-align:center">
	<br>
	

	<div class="tab-content">
		<div id="resultados" class="tab-pane fade in active">
			<div class="centrado">
				
				<div class="panel panel-default" style="width: 60%; margin:6% auto 0 auto; ">
					
						<div class="panel panel-body" style="margin-bottom: 0px;">
						
							<div style="text-align: center; margin-top: 12px" id="boton_nuevo">
								<div class="row">
									<div class="col-md-6 col-md-offset-3">
										<label>Fecha inicial &nbsp;<span style="color: red" class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="auto" title="El listado es de la fecha seleccionada más 7 días" aria-hidden="true"></span></label>
										<br>
										<input type="date" name="f_inicial" id="f_inicial">
									</div>
									
									
								</div>
								<br>
								
								<div class="row">
									<div class="form-group col-md-6 col-md-offset-3">		 
										<label for="servicio">*Servicio:</label>
										<select  class="form-control" id="servicio" name="servicio">
											<option value="0">Seleccione un servicio</option>
										</select>
										
									</div>
								</div>
								<div class="row"> 	
									<div class="form-group col-md-6 col-md-offset-3">		 
										<label for="turno">*Turno:</label>
										<select  class="form-control" id="turno" name="turno">
											<option value="0">Seleccione un turno</option>
										</select>
									</div> 
								</div>
							</div> 	
							<br>
								<div class="row">
									<div class="col-md-6 col-md-offset-3">
										<button id="nuevo" type="button" class="btn btn-success" style="width:100%;text-align:center; color: white; background:rgb(32,190,198);" onclick="obtener_lista_asistencia()"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>Buscar registros</button>
									</div>

								</div>
								
								<br>
							</div>
						</div>
					
				</div>
				
				<div class="tab-content">
					
						<div class="table-responsive">
							<table class="table table-bordered"style="margin-top: 20px;" id="asistencia" name="asistencia">
								<thead id="encabezado">
								  <!--tr class="info">
									
								  </tr-->
								</thead>
								<tbody id="asitencia">
								  
								</tbody>
							</table>
						
							<br>
					</div>
				</div>
			</div>
		</div>
			 
	</div>
</div>

	</div><!-- /.container -->

    </body>
</html>