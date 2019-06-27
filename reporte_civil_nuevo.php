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
  <title>Reporte Civil</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/reporte_civil_nuevo.js"></script>
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
									<div class="col-md-4 col-md-offset-4 col-sm-12">
										<label>Fecha &nbsp;</label>
										<br>
										<input type="date" name="f_inicial" id="f_inicial">
									</div>
									
									
								</div>
								<br>
								<div class="row">
									<div class="col-md-6 col-md-offset-3">
										<select class="form-control" id="turno">
										    <option value="0">Seleccione un turno</option>
										    
										</select>
									</div>
								</div>
								<br>
							
								<br>
								<div class="row">
									<div class="col-md-6 col-md-offset-3">
										<button id="nuevo" type="button" class="btn btn-success" style="width:100%;text-align:center; color: white; background:rgb(32,190,198);" onclick="obtener_asistencia()"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>Buscar registros</button>
									</div>

								</div>
								
								<br>
								<input type="text" placeholder="Ingrese el nombre o una parte para buscar" style="width:60%;margin: 18px auto ;text-align: center" id="buscar">

								<br>
								<button onclick="crearCSV('asistencia','generico')">Exportar a CSV</button>
							</div>
						</div>
					
				</div>
				
				<div class="tab-content">
					
						<div class="table-responsive">
							<table class="table table-bordered"style="margin-top: 20px;" id="asistencia" name="asistencia">
								<thead >
								  <tr class="info">
									<th style="width:15%;">  C&oacute;digo </th>
									<th style="width:40%;"> Nombre </th>
									<th style="width:15%;"> Fecha </th>
									<th style="width:15%;"> Entrada </th>
									<th style="width:15%;"> Salida </th>
								
								  </tr>
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