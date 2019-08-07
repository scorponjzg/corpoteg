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
  <title>Requerimiento</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-3.1.0.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/requerimiento.js"></script>
</head>
<body> 
 <style>
 	
 	input {
 		text-align: center;
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
								<?php if($_SESSION['tipo_corpoteg'] == 1){ ?>
									<button id="nuevo" type="button" class="btn btn-success" style="width:40%;text-align:center; color: white; background:rgb(32,190,198);" onclick="window.location.replace('nuevo_requerimiento.php')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo requerimiento</button>
									<br>
									<br>
								<?php }?>
								
								<br>
								<input type="text" placeholder="Ingrese el nombre o una parte para buscar" style="width:60%;margin: 18px auto ;text-align: center" id="buscar">
								<button onclick="encotrarEstudio()">Buscar</button>
							</div>
						</div>
					
				</div>
				
				<div class="tab-content">
					
						<div class="table-responsive">
							<table class="table table-bordered"style="margin: 20px auto;width:80%;" id="servicio" name="servicio">
								<thead >
								  <tr class="info">
									<th style="width:30%;text-align: center">Servicio</th>
									<th style="width:10%;text-align: center">turno</th>
									<th style="width:10%;text-align: center">Personal</th>
									<th style="width:10%;text-align: center">Entrada</th>
									<th style="width:10%;text-align: center">Salida</th>
									<th style="width:10%;text-align: center">Tolerancia entrada</th>
									<th style="width:10%;text-align: center">Tolerancia salida</th>
									
									
									<?php if($_SESSION['tipo_corpoteg'] == 1){ ?>
										<th style="width:10%;">Detalles</th>
									<?php } ?>
								  </tr>
								</thead>
								<tbody id="get_servicio">
								  
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