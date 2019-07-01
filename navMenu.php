<?php
if (!isset($_SESSION))
    session_start();
if (!isset($_SESSION["tipo_corpoteg"]) && !isset($_SESSION["usuario_corpoteg"])) {
    header("Location: index.php"); /* Redirect browser */
    exit();
}
?>

<nav class="navbar navbar-default navbar-fixed-top" ;>
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <img src="img/logo-laveco.png" class="navbar-brand" alt="Vivilab" style="padding: 4px;">
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="visor_general.php">Inicio</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Sistema
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="asistencia.php">Asitencias</a></li>
            <li><a href="servicio.php">Servicios</a></li>
            <li><a href="turno.php">Turno</a></li>
            <li><a href="requerimiento.php">Requerimiento de servicio</a></li>
            <li><a href="asistencia_manual.php">Captura manual de asistencia</a></li>
           
            
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reclutamiento
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="reclutamiento.php">Colaboradores</a></li>
            <li><a href="#">Estadisticas</a></li>
           
            
          </ul>
        </li>
	       <?php if($_SESSION['tipo_corpoteg'] == 1) { ?>
        <li ><a href="#">Usuario</a></li>
        <?php  }; ?>
        <?php if($_SESSION['tipo_corpoteg'] == 1 || $_SESSION['tipo_corpoteg'] == 3) { ?>
        <li ><a href="reporte_civil_nuevo.php">Reporte Civil nuevo</a></li>
        <?php  }; ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        
        <li><label class="navbar-text"><span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo $_SESSION['nombre_corpoteg']?></span></label></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
       
      </ul>
    </div>
  </div>
</nav>