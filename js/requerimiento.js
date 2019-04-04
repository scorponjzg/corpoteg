function obtener_requerimiento(){
		

		$.ajax({
			method: "POST",
			url: "php/obtener_requerimiento_mtd.php",
			dataType:"json"
		}).done(function(data){
			console.log(data);
			var resultado = "";
			data.servicio.forEach(function(entry){
			resultado += '<tr><td>'+entry.servicio+'</td>'+
			              '<td>'+entry.turno+'</td>'+
			              '<td>'+entry.solicitado+'</td>'+
			              '<td>'+entry.entrada+'</td>'+
			              '<td>'+entry.salida+'</td>'+
			              '<td>'+entry.t_e+'</td>'+
			              '<td>'+entry.t_s+'</td>';
						if(data.show == 'true'){
							resultado += '<td><a href="#" class="btn btn-default ver" role="button" data-id="'+entry.id+'">'+
								  '<span class="glyphicon glyphicon-eye-open"></span></a></td>';
						}
						resultado += '</tr>';
			
		    } );
		    //console.log(resultado);
			$('#get_servicio').empty();
			$('#get_servicio').append(resultado);
			$(".ver").on("click",verDetalle);

			
		}).fail(function(error){
			alert("Funcionalidad no disponible por el momento, intente mas tarde");
			
		});
   
}
function verDetalle(){
  
	window.location.replace("editar_requerimiento.php?"+btoa("requerimiento="+$(this).attr("data-id")));
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
	obtener_requerimiento();
	
});