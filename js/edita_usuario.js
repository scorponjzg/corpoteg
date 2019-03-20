function getQueryVariable(variable) {
   var query = window.location.search.substring(1);
   var vars = query.split("&");
  
  for (var i=0; i < vars.length; i++) {
       var pair = vars[i].replace('=','/').split("/");
      
       if(pair[0] == variable) {
           return pair[1];
       }
   }
   return false;
}
function validaForm(){
	var correcto = false;
	if($("#ap").val() == ''){
		alert("Debe de ingresar el apellido paterno");
		$("#ap").focus();
	} else if($("#nombre").val() == ''){
		alert("Debe de ingresar el nombre");
		$("#nombre").focus();
	} else if($("#usuario").val() == ''){
		alert("Debe de ingresar un usuario");
		$("#usuario").focus();
	}else if($("#clave").val() != $("#confirmacion").val() && $("#clave").val() != ''){
		alert("Las claves no son iguales");
		$("#confirmacion").focus();
	}else if($("#perfil").val() == '0'){
		alert("Debe seleccionar un perfil para el usuario");
		$("#perfil").focus();
	}else if($("#sucursal").val() == '0'){
		alert("Debe seleccionar una sucursal");
		$("#sucursal").focus();
	}else {
		correcto =  true;
	}
	return correcto;
}

function redireccion(){

	window.location.href="usuario.php";
	
}

function obtenerPerfilSucursal(){

	$.ajax({
		async: false,
		method: "POST",
		url:"php/obtener_perfil_sucursal_mtd.php",
		dataType: "json"

	}).done(function(data){
		
		var perfil = "";
		var sucursal = "";
		data.perfil.forEach(function(entry){
			perfil += "<option value="+entry.id+">"+entry.perfil+"</option>";
		});
		data.unidad.forEach(function(entry){
			sucursal += "<option value="+entry.id+">"+entry.unidad+"</option>";
		});
		$("#perfil").append(perfil);
		$("#sucursal").append(sucursal);
	}).fail(function(error){
		console.log(error.responseText);

	});
}


$(function(){

	obtenerPerfilSucursal();
	var usuario = getQueryVariable('usuario');
	//console.log(usuario);
	$.ajax({
		async: false,
		method: "POST",
		url: "php/detalle_usuario_mtd.php",
		dataType:"json",
		data: {'usuario' : usuario}
		
	}).done(function(data){
		console.log(data);
		$('#id').val(data.usuario.id);
		$('#nombre').val(data.usuario.nombre);
		$('#am').val(data.usuario.am);
		$('#ap').val(data.usuario.ap);
		$('#usuario').val(data.usuario.usuario);
		$('#perfil').val(data.usuario.idP);
		$('#sucursal').val(data.usuario.idU);


	}).fail(function(error){
		alert("Por el momento no est\u00E1 disponible el servicio, intente m\u00E1s tarde");
	});
	$("#formulario").submit(function(event){
		event.preventDefault();
		var usuario = $(this).serialize();
		console.log(usuario);
		if(validaForm()){
			$.ajax({
				method: "POST",
				url: "php/actualiza_usuario_mtd.php",
				dataType: "json",
				data: usuario 
			}).done(function(entry){
				console.log(entry);
				if(entry.editado == 'true'){
					alert("Estudio modificado correctamente.");
					redireccion();
				} else {
					alert(entry.editado);
				}
			}).fail(function(error){
				console.log(error.responseText);
			});
		}
	});

	$("#cancelar").on("click",redireccion);
	
	
	
});