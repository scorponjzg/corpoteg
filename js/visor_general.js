

function encotrarOrden(){

	var buscar = $("#buscar").val();
	var sucursal = $("#sucursal").val();
	var fecha = $("#fecha").val();
	total = costo = utilidad = 0.00;
	$.ajax({
		method: "POST",
		url: "php/obtener_orden_mtd.php",
		dataType:"json",
		data:{"buscar":buscar,"sucursal":sucursal,"fecha":fecha}
	}).done(function(data){
		console.log(data);
		var orden = activo = "";
		var  estadoLetra = "";
		if(typeof(data.orden) != 'undefined'){
			data.orden.forEach(function(entry){
				
				if(entry.estado == 1){
					
					estadoLetra = "Activo"; 
					activo = "";
				} else{
					
					estadoLetra = "Cacelado";
					activo = "disabled"; 
				}
				
				orden += '<tr><td>'+entry.folio+'</td>'+
								'<td>'+entry.estudios+'</td>'+
								'<td>'+entry.atendio+'</td>'+
								'<td>'+entry.registro+'</td>'+
								'<td>'+entry.total+'</td>';
				if(entry.estado == 1){
					total += parseFloat(entry.total);
				}				
				if(data.show == true){
					orden +='<td>'+entry.costo+'</td>'+
							  '<td>'+(entry.total - entry.costo)+'</td>';
					if(entry.estado == 1){
					    costo += parseFloat(entry.costo);
					    utilidad += parseFloat(entry.total - entry.costo);
					}
				}

				orden +='<td>'+estadoLetra+'</td>';
				if(data.show == true){
					orden +='<td><a href="#" class="btn btn-danger cancelar" role="button" data-id="'+entry.id+'"'+activo+' id="cancelar"'+atob(entry.id)+'>'+
							  '<span class="glyphicon glyphicon-remove"></span></a></td>';
				}
				orden +='</tr>';
			});
		}
		$('#orden').empty();
		$('#orden').append(orden);
		$("#total").html(dobleDecimal(total));
		$("#costo").html(dobleDecimal(costo));
		$("#utilidad").html(dobleDecimal(utilidad));
		$("#totalEnLetra").html("("+NumerosaLetras(dobleDecimal(total))+")");
		$(".cancelar").on("click",cancelarOrden);

	}).fail(function(error){
		alert("Por el momento no est\u00E1 disponible el servicio, intente m\u00E1s tarde");
		
	});
}
$(function(){
	
});