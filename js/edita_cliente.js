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

	window.location.href="cliente.php";
	
}

function obtenerServicio(){
	var cliente = getQueryVariable('cliente');
	 console.log(cliente);
	$.ajax({

		method: "POST",
		url:"php/obtener_cliente_id_mtd.php",
		dataType: "json",
		data: {"cliente":cliente}

	}).done(function(data){
		console.log(data)
		
		if (data.cliete.estado == "1"){
			$("#estado").attr('checked', true);
		}
		$("#nombre").val(data.cliete.nombre);
		$("#clave").val(data.cliete.id);
		
	}).fail(function(error){
		console.log(error.responseText);

	});
}

function editarServicio(){
	if($("#nombre").val() !=""){	
		var estado = $('#estado').is(':checked') ? 1:0;
		$.ajax({
			method: "POST",
			url:"php/editar_cliente_mtd.php",
			dataType: "json",
			data: {"id":$("#clave").val(),"cliente":$("#nombre").val(), "estado": estado}
		}).done(function(data){
			if(data.editado == 'true'){
				alert("Cliente editado correctamente");
				window.location.href="cliente.php";
			} else {
				alert(data.editado);
			}
		}).fail(function(error){
			console.log(error.responseText);
		});
	} else {
		alert("Debe ingresar un nombre de servicio")
	}
}
$(function(){

	obtenerServicio();
	
	$("#cancelar").on("click",redireccion);
	
	$("#editar").on("click",editarServicio);
	
	
	
});