<!DOCTYPE html>
<html lang="en">
<head>
  <title>Servicio</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  
  <script src="js/mostrar_asistencia.js"></script>
</head>
<body>

<style>
th {
	
	text-align:center;
}

</style>
	<div class="container centrado" style="padding-left: 0px;">
	<?php //include 'navMenu.php'?>
	
<div class="starter-template" style="text-align:center">
	<br>
	<nav class="navbar navbar-default navbar-fixed-top" >
  <div class="container-fluid">
    <div class="navbar-header">
      
      
	  <img src="img/logo-laveco.png" class="img-fluid" alt="Responsive image" style="margin:5px;">
    </div>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="#" style="font-size:20px;"><span class="glyphicon glyphicon-ok"></span > Asistencia.</a></li>
    </ul>
    
  </div>
</nav>

	<div class="tab-content">
		<div id="resultados" class="tab-pane fade in active">
			<div class="centrado">
				<div class="panel panel-default" style="width: 80%; margin:80px auto 0 auto; ">
					
					<div class="panel panel-body" style="margin-bottom: 0px;">
					
						<div style="text-align: center; " id="boton_nuevo">
							<label>Seleccione una fecha</label>
							<select class="form-control" id="fecha" style="width:40%; margin: 0px auto 10px auto;">
							
							</select>
							
							
							<button onclick="crearCSV('registro','asistencia')">Exportar a CSV</button>
						</div>
					</div>
					
				</div>
				
				<div class="tab-content">
					
					<div class="table-responsive">
						<table class="table table-bordered"style="margin-top: 20px;" id="registro">
							<thead >
							  <tr class="info">
								<th style="width:10%;">C&oacute;digo</th>
								<th style="width:45%;">Nombre</th>
								<th style="width:25%;">Servicio</th>
								<th style="width:10%;">Entrada(s)</th>
								<th style="width:10%;">Salida(S)</th>
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