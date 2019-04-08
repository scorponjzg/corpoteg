


function responsive_menu(){
	
   if($(window).width() < 800){
	   
	   $('.navbar-right').hide();
	   $('#fecha').css('width','60%');
   } else {
	   
	   $('.navbar-right').show();
	   
   }
	
}
function obtener_servicio(){
	
		$.ajax({
			method:"POST",
			url: "php/obtener_servicio_mtd.php",
			dataType: "json"
		}).done(function(data){
			//console.log(data);
			var servicio = "";
			data.servicio.forEach(function(entry){
				servicio += '<option value="'+entry.pk+'">'+entry.servicio+'</option>';
			});
			//$("#servicio").empty(servicio);
			$("#servicio").append(servicio);
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
		}).fail(function(error){
			alert(error.responseText);
		});
	
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
$(function(){
	responsive_menu();
	obtener_turno();
	obtener_servicio();
	$(window).resize(function(){
		responsive_menu();
	});
	$("#formulario").submit(function(event){
		event.preventDefault();
		var servicio = $(this).serialize();
		if(valdaForm()){	
		console.log(servicio);
				
				$.ajax({
				method: "POST",
				url: "php/nuevo_requerimiento_mtd.php",
				dataType: "json",
				data: servicio 
				}).done(function(entry){
					console.log(entry);
					if(entry.ingresado == 'true'){
						alert("Servicio creado correctamente.");
						window.location.replace("requerimiento.php");
					} else {
						alert(entry.ingresado);
					}
				}).fail(function(error){
					console.log(error);
				});
			
		} 
	})
});