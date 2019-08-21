
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
	var empresa = $("#empresa").val();
	var codigo = $("#codigo").val();
	var nacimiento = $("#nacimiento").val();
	var imagen = $("#uploadPreview1").attr('src');
	var nss = $("#nss").val();
	var curp = $("#curp").val();
	var sangre = $("#sangre").val();
	var direccion = $("#direccion").val();
	var tel = $("#tel").val();
	var servicio = $("#servicio").val();
	var turno = $("#turno").val();
	var correcto = true;

	if(empresa == '0'){
		alert("Debe asignarle una empresa a la persona a registrar");
		$("#empresa").focus();		
		correcto = false;
	} else if(codigo == ''){
		alert("Debe asignarle un código a la persona a registrar");
		$("#codigo").focus();
		correcto = false;
	} else if(nombre == ''){
		alert("El campo nombre no debe estar vac\u00EDo");
		$("#nombre").focus();
		correcto = false;
	} else if(a_paterno == ''){
		alert("El campo apellido paterno no debe estar vac\u00EDo");
		$("#a_paterno").focus();		
		correcto = false;
	} else if(nacimiento == ''){
		alert("Se tiene que registrar la fecha de nacimiento");
		$("#nacimiento").focus();		
		correcto = false;
	} else if(imagen == 'img/image_not_available.png'){
		alert("Debe de seleccionar una foto de la persona a registrar");
		$("#uploadImage1").focus();		
		correcto = false;
	} else if(nss == ''){
		alert("Se tiene que registrar el número de seguro social");
		$("#nss").focus();		
		correcto = false;
	} else if(curp == ''){
		alert("Se tiene que registrar la curp");
		$("#curp").focus();		
		correcto = false;
	} else if(sangre == ''){
		alert("Se tiene que registrar el tipo de sangre");
		$("#sangre").focus();		
		correcto = false;
	} else if(contacto == ''){
		alert("Se tiene que registrar un contacto de emegencia");
		$("#contacto").focus();		
		correcto = false;
	}  else if(direccion == ''){
		alert("Debe registrar la dirección del usuario registrar");
		$("#direccion").focus();		
		correcto = false;
	} else if(tel == ''){
		alert("Debe ingresar el teléfono de la persona a registrar");
		$("#tel").focus();		
		correcto = false;
	}  else if(servicio == '0'){
		alert("Debe seleccionar un servicio");
		$("#servicio").focus();		
		correcto = false;
	}  else if(turno == '0'){
		alert("Debe seleccionar un turno de servicio");
		$("#turno").focus();		
		correcto = false;
	}
		return correcto;
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
function estatusMedioEmpresa(){
	var estatus = '';
	var medio = '';
	var empresa = '<option value="0">Seleccione una empresa</option>';
		
		$.ajax({
			method: "POST",
			url: "php/obtener_medio_estatus_empresa_mtd.php",
			dataType:"json",
			data: {servicio: $("#servicio").val()}

		}).done(function(data){
			
			data.medio.forEach(function(entry){
				
				medio += '<option value="'+entry.id+'">'+entry.medio+'</option>';
				
			});
			data.estatus.forEach(function(entry){
				
				estatus += '<option value="'+entry.id+'">'+entry.estatus+'</option>';
				
			});

			data.empresa.forEach(function(entry){
				
				empresa += '<option value="'+entry.id+'">'+entry.empresa+'</option>';
				
			});
			
			$('#medio').append(medio);
			$('#estatus').append(estatus);
			$('#empresa').append(empresa);
					
		}).fail(function(error){
			alert("Funcionalidad no disponible por el momento, intente mas tarde");
			
		});
}
$(function(){
	resolucion_pantalla();
	obtener_servicio();
	estatusMedioEmpresa();

	$("#servicio").change(function(){
		$("#turno").empty();
		$("#turno").append('<option value="0">Seleccione un turno</option>');
		obtenerTurno();

	})
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