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

function obtenerCliente(){
	var resultado = '<option value="0">Seleccione un cliene</option>';
	$.ajax({
				method: "POST",
				url: "php/obtener_cliente_mtd.php",
				dataType: "json"
				}).done(function(data){
					
					data.cliente.forEach(function(entry){
						if(entry.estado == "Activo"){
							resultado += '<option value="'+entry.id+'">'+entry.cliente+'</option>';
						}
					
				    } );
					$('#cliente').empty();
					$('#cliente').append(resultado);

					obtenerServicio();

				}).fail(function(error){
					console.log(error);
				});
}

function obtenerServicio(){
	var servicio = getQueryVariable('servicio');
	
	$.ajax({

		method: "POST",
		url:"php/obtener_servicio_id_mtd.php",
		dataType: "json",
		data: {"servicio":servicio}

	}).done(function(data){
		
		if (data.servicio.permitido == "1"){
			$("#permitir").attr('checked', true);
		}
		$("#nombre").val(data.servicio.servicio);
		$("#clave").val(data.servicio.id);
		$("#cliente").val(data.servicio.cliente);
		
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
		
		if(data.eliminado == 'true'){
			alert("Servicio eliminado correctamente");
			window.location.href="servicio.php";
		}
		
	}).fail(function(error){
		console.log(error.responseText);

	});
}

function validaForm(){

	if($("#nombre").val() ==""){	
		alert("Debe ingresar el nombre del servicio");
			$("#nombre").focus();
		
	} else if($("#cliente").val() =="0"){
		alert("Debe seleccionar un cliente");
			$("#cliente").focus();

	} else {
		return true;
	}

}

function editarServicio(){
	if(validaForm()){	
		var permitido = $('#permitir').is(':checked') ? 1:0;
		$.ajax({
			method: "POST",
			url:"php/editar_servicio_mtd.php",
			dataType: "json",
			data: {"id":$("#clave").val(),"servicio":$("#nombre").val(), "permitir": permitido, "cliente": $("#cliente").val()}
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
}
$(function(){
	obtenerCliente();
	
	
	$("#cancelar").on("click",redireccion);
	$("#eliminar").on("click",eliminar);
	$("#editar").on("click",editarServicio);
	
	
	
});