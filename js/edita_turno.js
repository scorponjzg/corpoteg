function getQueryVariable(variable) {
   var query = window.location.search.substring(1);
   var vars = atob(query).split("&");
  
  for (var i=0; i < vars.length; i++) {
       var pair = vars[i].replace('=','/').split("/");
      
       if(pair[0] == variable) {
           return pair[1];
       }
   }
   return false;
}

function redireccion(){

	window.location.href="turno.php";
	
}

function obtenerTurno(){
	var turno = getQueryVariable('turno');
	
	$.ajax({

		method: "POST",
		url:"php/detalle_turno_mtd.php",
		dataType: "json",
		data: {"turno":turno}

	}).done(function(data){
		//console.log(data);
		$("#nombre").val(data.turno.turno);
		$("#clave").val(data.turno.id);
		
	}).fail(function(error){
		console.log(error.responseText);

	});
}
function eliminar(){
	$.ajax({

		method: "POST",
		url:"php/eliminar_turno_mtd.php",
		dataType: "json",
		data: {"id":$("#clave").val()}

	}).done(function(data){
		console.log(data);
		
		if(data.eliminado == 'true'){
			alert("Turno eliminado correctamente");
			window.location.href="turno.php";
		}
		
	}).fail(function(error){
		console.log(error.responseText);

	});
}

function editarTurno(){
	$.ajax({
		method: "POST",
		url:"php/editar_turno_mtd.php",
		dataType: "json",
		data: {"id":$("#clave").val(),"turno":$("#nombre").val()}
	}).done(function(data){
		if(data.editado == 'true'){
			alert("Turno editado correctamente");
			window.location.href="turno.php";
		} else {
			alert(data.editado);
		}
	}).fail(function(error){
		consolo.log(error.responseText);
	});
}
$(function(){

	obtenerTurno();
	
	$("#cancelar").on("click",redireccion);
	$("#eliminar").on("click",eliminar);
	$("#editar").on("click",editarTurno);
	
	
	
});