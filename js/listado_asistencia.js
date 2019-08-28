
function obtener_servicio(){
	
	var resultado = '<option value="0">Seleccione un servicio</option>';
		
		$.ajax({
			method: "POST",
			url: "php/obtener_servicio_mtd.php",
			dataType:"json"
		}).done(function(data){
			
			data.servicio.forEach(function(entry){
				
				resultado += '<option value="'+entry.id+'">'+entry.nombre+'</option>';
				
			});
			$('#servicio').empty();
			$('#servicio').append(resultado);
					
		}).fail(function(error){
			alert("Funcionalidad no disponible por el momento, intente mas tarde");
			
		});
   
}

function regresar(){
	
	if(confirm("Realmente quiere salir de la captura?"))
	window.location.replace("reclutamiento.php");
	
}

function resolucion_pantalla(){	
 
	if (screen.width<1024){
		
		$(".panel").css("width","100%");
	} 
	
}
function obtenerTurno(){

	var resultado = '<option value="0">Seleccione un turno</option>';
		
		$.ajax({
			method: "POST",
			url: "php/obtener_turno_de_servicio_mtd.php",
			dataType:"json",
			data: {servicio: $("#servicio").val()}

		}).done(function(data){
			//console.log(data);
			data.turno.forEach(function(entry){
				
				resultado += '<option value="'+entry.id+'">'+entry.nombre+'  --  '+entry.turno+'  |  E.- '+entry.entrada+'  |  S.- '+entry.salida+ '</option>';
				
			});
			$('#turno').empty();
			$('#turno').append(resultado);
					
		}).fail(function(error){
			alert("Funcionalidad no disponible por el momento, intente mas tarde");
			
		});
}

function validar(){
	var correcto = true;
	if($("#f_inicial").val() == ""){
		alert("Debe seleccionar una fecha de inicio");
		$("#f_inicial").focus();
		correcto = false;
	} else if($("#servicio").val() == "0"){
		alert("Debe seleccionar un servicio");
		$("#servicio").focus();
		correcto = false;
	} else if($("#turno").val() == "0"){
		alert("Debe seleccionar un turno");
		$("#turno").focus();
		correcto = false;
	}
	return correcto;
}
function obtener_lista_asistencia(){
	var servicio = $("#servicio").val();
	var turno = $("#turno").val();
			
		if(validar()){
			
			$.ajax({
				url: "php/obtener_usuario_servicio_turno_mtd.php",
				method : "POST",
				dataType:"json",
				data: {"turno": turno}
				
			}).done(function(respuesta){
				console.log(respuesta);
				
				 /*if(respuesta.correcto == 'true'){
					 
					alert(respuesta.ingresado);
					window.location.replace("reclutamiento.php");

				 } else {
					 
					 alert("1.-Funcionalidad no disponible por el momento, intente m\u00E1s tarde");
				 }*/
				 
			}).fail(function(){
				
				alert("Funcionalidad no desponible por el momento, intente m\u00E1s tarde");
				
			});
			
		} 
	}
$(function(){
	resolucion_pantalla();
	obtener_servicio();
	

	$("#servicio").change(function(){
		$("#turno").empty();
		$("#turno").append('<option value="0">Seleccione un turno</option>');
		obtenerTurno();

	})
   $("#regresar").on('click',regresar);
	
	
});