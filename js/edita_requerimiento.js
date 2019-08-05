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
function valdaForm(){

	if ($("#servicio").val()=='0'){
		alert("Debe seleccionar un servico");
		$("#servicio").focus();
	}else if ($("#turno").val()=='0'){
		alert("Debe seleccionar un turno");
		$("#turno").focus();
	}else if ($("#personal").val()==''){
		alert("Debe ingresar la cantidad de personal solicitado");
		$("#personal").focus();
	}else if ($("#entrada").val()==''){
		alert("Debe ingresar una hora de entrada");
		$("#entrada").focus();
	}else if ($("#salida").val()==''){
		alert("Debe ingresar una hora de salida");
		$("#salida").focus();
	}else if ($("#te").val()==''){
		alert("Debe ingresar una hora de tolerancia de entrada");
		$("#te").focus();
	}
	else if ($("#ts").val()==''){
		alert("Debe ingresar una hora de tolerancia de salida");
		$("#ts").focus();
	}else{
		return true;
	}
}
function redireccion(){

	window.location.href="requerimiento.php";
	
}
function obtener_servicio(){
	
		$.ajax({
			method:"POST",
			url: "php/obtener_servicio_mtd.php",
			dataType: "json"
		}).done(function(data){
			console.log(data);
			var servicio = "";
			data.servicio.forEach(function(entry){
				servicio += '<option value="'+entry.id+'">'+entry.nombre+'</option>';
			});
			//$("#servicio").empty(servicio);
			$("#servicio").append(servicio);

			obtener_turno();
	
		}).fail(function(error){
			alert(error.responseText);
		});
	
}
function obtener_turno(){
	
		$.ajax({
			method:"POST",
			url: "php/obtener_turno_mtd.php",
			dataType: "json"
		}).done(function(data){
			//console.log(data);
			var turno = "";
			data.turno.forEach(function(entry){
				turno += '<option value="'+entry.id+'">'+entry.nombre+'</option>';
			});
			//$("#turno").empty(turno);
			$("#turno").append(turno);

			detalleRequerimiento();

		}).fail(function(error){
			alert(error.responseText);
		});
	
}
function detalleRequerimiento(){
	var requerimiento = getQueryVariable('requerimiento');
	
	$.ajax({

		method: "POST",
		url:"php/detalle_requerimiento_mtd.php",
		dataType: "json",
		data: {"requerimiento":requerimiento}

	}).done(function(data){
		
		 $("#pk").val(data.requerimiento.id);
		 $("#servicio").val(data.requerimiento.servicio);
		 $("#turno").val(data.requerimiento.turno);
		 $("#personal").val(data.requerimiento.requeridos);
		 $("#entrada").val(data.requerimiento.entrada);
		 $("#salida").val(data.requerimiento.salida);
		 $("#te").val(data.requerimiento.te);
		 $("#ts").val(data.requerimiento.ts);
		
	}).fail(function(error){
		console.log(error.responseText);

	});
}
function eliminar(){
	console.log("eliminat");
	$.ajax({

		method: "POST",
		url:"php/eliminar_requerimiento_mtd.php",
		dataType: "json",
		data: {"id":$("#pk").val()}

	}).done(function(data){
		
		if(data.eliminado == 'true'){
			alert("Requerimiento eliminado correctamente");
			window.location.href="requerimiento.php";
		}
		
	}).fail(function(error){
		console.log(error.responseText);

	});
}


$(function(){

	$("#formulario").submit(function(event){
			event.preventDefault();
		if(valdaForm()){
			var requerimiento = $(this).serialize();
			console.log(requerimiento);
			$.ajax({
				method: "POST",
				url:"php/editar_requerimiento_mtd.php",
				dataType: "json",
				data: requerimiento
			}).done(function(data){
				if(data.editado == 'true'){
					alert("Requerimiento editado correctamente");
					window.location.href="requerimiento.php";
				} else {
					alert(data.editado);
				}
			}).fail(function(error){
				console.log(error.responseText);
			});
		}
	});
	obtener_servicio();
	
	$("#cancelar").on("click",redireccion);
	$("#eliminar").on("click",eliminar);
	
	
	
	
});