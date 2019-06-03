


function responsive_menu(){
	
   if($(window).width() < 800){
	   
	   $('.navbar-right').hide();
	   $('#fecha').css('width','60%');
   } else {
	   
	   $('.navbar-right').show();
	   
   }
	
}
$('#fecha').css('width','40%');

$(function(){
	responsive_menu();
	$(window).resize(function(){
		responsive_menu();
	});
	$("#formulario").submit(function(event){
		event.preventDefault();
		var servicio = $(this).serialize();
		console.log(servicio);
		if($("#nombre").val() !=""){	
				
				$.ajax({
				method: "POST",
				url: "php/nuevo_servicio_mtd.php",
				dataType: "json",
				data: servicio 
				}).done(function(entry){
					console.log(entry);
					if(entry.ingresado == 'true'){
						alert("Servicio creado correctamente.");
						window.location.replace("servicio.php");
					} else {
						alert(entry.ingresado);
					}
				}).fail(function(error){
					console.log(error);
				});
			
		} else {
			alert("Debe ingresar el nombre del servicio");
			$("#nombre").focus();
		}
	})
});