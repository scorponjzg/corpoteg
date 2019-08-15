


function responsive_menu(){
	
   if($(window).width() < 800){
	   
	   $('.navbar-right').hide();
	   $('#fecha').css('width','60%');
   } else {
	   
	   $('.navbar-right').show();
	   
   }
	
}
$('#fecha').css('width','40%');
function obtenerCliente(){
	var resultado = '<option value="0">Seleccione un cliene</option>';
	$.ajax({
				method: "POST",
				url: "php/obtener_cliente_mtd.php",
				dataType: "json"
				}).done(function(data){
					console.log(data.estado);
					data.cliente.forEach(function(entry){
						if(entry.estado == "Activo"){
							resultado += '<option value="'+entry.id+'">'+entry.cliente+'</option>';
						}
			
		    } );
			$('#cliente').empty();
			$('#cliente').append(resultado);
				}).fail(function(error){
					console.log(error);
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

$(function(){
	responsive_menu();
	obtenerCliente();
	$(window).resize(function(){
		responsive_menu();
	});
	$("#formulario").submit(function(event){
		event.preventDefault();
		var servicio = $(this).serialize();
		//console.log(servicio);
		if(validaForm()){	
				
				$.ajax({
				method: "POST",
				url: "php/nuevo_servicio_mtd.php",
				dataType: "json",
				data: servicio 
				}).done(function(entry){
					
					if(entry.ingresado == 'true'){
						alert("Servicio creado correctamente.");
						window.location.replace("servicio.php");
					} else {
						alert(entry.ingresado);
					}
				}).fail(function(error){
					console.log(error);
				});
			
		} 
	})
});