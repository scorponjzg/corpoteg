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

	window.location.href="servicio.php";
	
}

function obtenerServicio(){
	var servicio = getQueryVariable('servicio');
	
	$.ajax({

		method: "POST",
		url:"php/obtener_sevicio_mtd.php",
		dataType: "json",
		data: {"servicio":servicio}

	}).done(function(data){
		
		$("#nombre").val(data.servicio.servicio);
		$("#clave").val(data.servicio.id);
		
	}).fail(function(error){
		console.log(error.responseText);

	});
}
function eliminar(){
	$.ajax({

		method: "POST",
		url:"php/eliminar_sevicio_mtd.php",
		dataType: "json",
		data: {"id":$("#clave").val()}

	}).done(function(data){
		console.log(data);
		
		if(data.eliminado == 'true'){
			alert("Servicio eliminado correctamente");
			window.location.href="servicio.php";
		}
		
	}).fail(function(error){
		console.log(error.responseText);

	});
}

function editarServicio(){
	$.ajax({
		method: "POST",
		url:"php/editar_sevicio_mtd.php",
		dataType: "json",
		data: {"id":$("#clave").val(),"servicio":$("#nombre").val()}
	}).done(function(data){
		if(data.editado == 'true'){
			alert("Servicio editado correctamente");
			window.location.href="servicio.php";
		} else {
			alert(data.editado);
		}
	}).fail(function(error){
		console.log(error.responseText);
	});
}
$(function(){

	obtenerServicio();
	
	$("#cancelar").on("click",redireccion);
	$("#eliminar").on("click",eliminar);
	$("#editar").on("click",editarServicio);
	
	
	
});