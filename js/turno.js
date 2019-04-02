function obtener_turno(){
		

		$.ajax({
			method: "POST",
			url: "php/obtener_turno_mtd.php",
			dataType:"json"
		}).done(function(data){
			//console.log(data);
			var resultado = "";
			data.turno.forEach(function(entry){
			resultado += '<tr><td>'+entry.nombre+'</td>';
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
  
	window.location.replace("editar_turno.php?"+btoa("turno="+$(this).attr("data-id")));
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
	obtener_turno();
	
});