
function obtener_servicio(){
		

		$.ajax({
			method: "POST",
			url: "php/obtener_servicio_mtd.php",
			dataType:"json"
		}).done(function(data){
			console.log(data);
			var resultado = "";
			data.servicio.forEach(function(entry){
			resultado += '<tr><td>'+entry.cliente+'</td>'+
							'<td>'+entry.nombre+'</td>'+
							 '<td>'+entry.permitido+'</td>';
						if(data.show == 'true'){
							resultado += '<td><a href="#" class="btn btn-default ver" role="button" data-id="'+entry.id+'">'+
								  '<span class="glyphicon glyphicon-eye-open"></span></a></td>';
						}
						resultado += '</tr>';
			
		    } );
			$('#get_servicio').empty();
			$('#get_servicio').append(resultado);
			$(".ver").on("click",verDetalle);
			

			
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