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
  <title>General</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="css/bootstrap-select.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/bootstrap-select.js" type="text/javascript"></script>
  <script src="js/numerosALetras.js"></script>
  <script src="js/visor_general.js"></script>
</head>
<body>

<style>
th {
	
	text-align:center;
}
.selectores{
	width:45%;
	margin: 20px auto;
}
button{
	width:45%;
}
</style>
<div class="container centrado" style="padding-left: 0px;">
	<?php include 'navMenu.php'?>
	
	<div class="starter-template" style="text-align:center">
		<br>
		

		
	</div>


</div><!-- /.container -->

    </body>
</html>