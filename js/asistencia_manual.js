


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
			console.log(data);
			var servicio = "";
			data.servicio.forEach(function(entry){

				if(entry.permitido == "Permitido"){
					servicio += '<option value="'+entry.id+'">'+entry.nombre+'</option>';
				}
			});
			//$("#servicio").empty(servicio);
			$("#servicio").append(servicio);
		}).fail(function(error){
			alert(error.responseText);
		});
	
}

function valdaForm(){

	if ($("#servicio").val()=='0'){
		alert("Debe seleccionar un servicio");
		$("#servicio").focus();
	}else if ($("#tipo").val()=='n'){
		alert("Debe seleccionar el tipo de registro a aplicar");
		$("#tipo").focus();
	}else if ($("#fecha").val()==''){
		alert("Debe ingresar la fecha de asitencia");
		$("#fecha").focus();
	}else if ($("#hora").val()==''){
		alert("Debe ingresar la hora del registro");
		$("#hora").focus();
	}else if ($("#codigo").val()==''){
		alert("Debe ingresar el código del usuario");
		$("#codigo").focus();
	}else if ($("#nombre").val()==''){
		alert("Debe ingresar el nombre de usuario");
		$("#nombre").focus();
	}else{
		return true;
	}
}
$(function(){
	responsive_menu();
	
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
				url: "php/asistencia_manual_mtd.php",
				dataType: "json",
				data: servicio 
				}).done(function(entry){
					console.log(entry);
					if(entry.ingresado == 'true'){
						alert("Servicio creado correctamente.");
						window.location.replace("asistencia_manual.php");
					} else {
						alert(entry.ingresado);
					}
				}).fail(function(error){
					console.log(error);
				});
			
		} 
	})
});