function valida_formulario(){
	
	var nombre = $("#nombre").val();
	var a_paterno = $("#a_paterno").val();
	
	var correcto = true;
	
	if(nombre == ''){
		alert("El campo nombre no debe estar vac\u00EDo");
		$("#nombre").focus();
		correcto = false;
	} else if(a_paterno == ''){
		alert("El campo apellido paterno no debe estar vac\u00EDo");
		$("#a_paterno").focus();		
		correcto = false;
	}
		return correcto;
}


function regresar(){
	
	window.location.replace("reclutamiento.php");
	
}

function resolucion_pantalla(){	
 
	if (screen.width<1024){
		
		$(".panel").css("width","100%");
	} 
	
}

$(function(){
	resolucion_pantalla();
   $("#regresar").on('click',regresar);
	
	$("#formulario").submit(function(event){
			
		event.preventDefault();
		if(valida_formulario()){
			
			var serializada = $(this).serialize();
			
			$.ajax({
				url: "php/guardar_usuario.php",
				method : "POST",
				dataType : "json",
				data : serializada
				
			}).done(function(respuesta){
				
				 if(respuesta.registrado == true){
					 
					window.location.replace("visor_general_reclutamiento.php");
					
				 } else {
					 
					 alert("Funcionalidad no disponible por el momento, intente m\u00E1s tarde");
				 }
				 
			}).fail(function(){
				
				alert("Funcionalidad no desponible por el momento, intente m\u00E1s tarde");
				
			});
			
		}
	});
});