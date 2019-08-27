<?php 
session_start();
if (!isset($_SESSION["tipo_corpoteg"]) && !isset($_SESSION["tipo_corpoteg"])) {
    header("Location: index.php"); /* Redirect browser */
	
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Baja IMSS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/baja_imss.js"></script>
</head>
<body>

<style>

th, td{
	
	text-align:center !important;
}

</style>
	
<div class="container">
	 <?php include 'navMenu.php'?>
 <div id="resultados" class="tab-pane fade in active">
			<div class="centrado">
				
				<div class="panel panel-default" style=" margin:6% auto 0 auto; text-align: center ">
					
						<label>Baja de IMSS</label>
					
				</div>
				
				<div class="tab-content">
					
						<div class="table-responsive">
							<table class="table table-bordered"style="margin-top: 20px;" id="reclutados" name="reclutados">
								<thead >
								  <tr class="info">
									<th style="width:6%;">Código</th>
									<th style="width:20%;">Nombre</th>
									<th style="width:10%;">Empresa</th>
									<th style="width:10%;">Servicio</th>
									<th style="width:10%;">Turno</th>
									<th style="width:14%;">Folio</th>
									<th style="width:10%;">Alta IMSS</th>
									<th style="width:10%;">Fecha de baja</th>
									<th style="width:8%;">Guardar</th>
								  </tr>
								</thead>
								<tbody id="reporte">
								  
								</tbody>
							</table>
						
							<br>
					</div>
				</div>
			</div>
		</div>
</div>

</body>
</html>