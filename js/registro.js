function upload_image(){//Funcion encargada de enviar el archivo via AJAX
				$(".upload-msg").text('Cargando...');
				var inputFileImage = document.getElementById("fileToUpload");
				var file = inputFileImage.files[0];
				var data = new FormData();
				data.append('fileToUpload',file);
				
				/*jQuery.each($('#fileToUpload')[0].files, function(i, file) {
					data.append('file'+i, file);
				});*/
							
				$.ajax({
					url: "upload.php",        // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					success: function(data)   // A function to be called if request succeeds
					{
						$(".upload-msg").html(data);
						window.setTimeout(function() {
						$(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
						$(this).remove();
						});	}, 5000);
					}
				});
				
			}
			
function previewImage(nb) {        
    var reader = new FileReader();         
    reader.readAsDataURL(document.getElementById('uploadImage'+nb).files[0]);         
    reader.onload = function (e) {             
        document.getElementById('uploadPreview'+nb).src = e.target.result;         
    };     
}

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