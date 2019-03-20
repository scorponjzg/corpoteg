$(function(){
	
	// var contenido = '<p>Lorem ipsum...</p>';
 
// var temporal = document.createElement("div");
// temporal.innerHTML = contenido;
 
// var texto = temporal.textContent || temporal.innerText || "";
// console.log(texto);
// console.log(temporal.textContent );
// console.log(temporal.innerText);
// console.log($("#prueba").text());
	$("#usuario").focus();
	$("#formulario").submit(function(event){
			
		event.preventDefault();
		var usuario = $("#usuario").val();
		var contrasena = $("#contrasena").val(); 
		if(usuario == ''){
			
			alert("El campo usuario no debe estar vac\u00EDo");
			$("#usuario").focus();
		} else if(contrasena == ''){
			
			alert("El campo contrase\u00F1a no debe estar vac\u00EDo");
			$("#contrasena").focus();
			
		} else {
							
			var serializada = $(this).serialize();
			$.ajax({
				url: "php/autenticacion_usuario.php",
				method : "POST",
				dataType : "json",
				data : serializada
				
			}).done(function(respuesta){
				
				if(respuesta.registrado == true){
					 
					window.location.replace("visor_general.php");
					
				 } else {
					 
					 alert("El usuario o contrase\u00F1a incorrectos");
					 $("#contrasena").val('');
				 }
			}).fail(function(){
				
				alert("Funcionalidad no desponible por el momento, intente m\u00E1s tarde");
				
			});
			
		}
	});
});