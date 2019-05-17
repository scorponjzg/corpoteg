
function obtener_servicio(){
		

		$.ajax({
			method: "POST",
			url: "php/obtener_sercvicio_mtd.php",
			dataType:"json"
		}).done(function(dato){
			console.log(dato.content.data);
			var resultado = "";
			dato.servicio.forEach(function(entry){
			resultado += '<tr><td>'+entry.nombre+'</td>'+
							  '<td>'+entry.permitido+'</td>';
					
						resultado += '</tr>';
			
		    } );
			$('#get_servicio').empty();
			$('#producto').append(resultado);
			

			
		}).fail(function(error){
			alert("Funcionalidad no disponible por el momento, intente mas tarde");
			
		});
   
}
function verDetalle(){
  
	window.location.replace("editar_servicio.php?"+btoa("servicio="+$(this).attr("data-id")));
}

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
	obtener_servicio();
	/*obtener_fechas();
	$('#fecha').change(obtener_asistencia);
	*/
});