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
  <title>Servicios</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/servicio.js"></script>
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
									<button id="nuevo" type="button" class="btn btn-success" style="width:40%;text-align:center; color: white; background:rgb(32,190,198);" onclick="window.location.replace('nuevo_servicio.php')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo servicio</button>
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
								  	<th style="width:40%;text-align: center;">Cliente</th>
									<th style="width:40%;text-align: center;">Nombre</th>
									<th style="width:10%;text-align: center;">Asistencia manual</th>
									
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