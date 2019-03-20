function crearCSV(tabla,nombreCSV){
	var tablehtml = $("#"+tabla).html();
	//console.log(tablehtml);
	var datos = tablehtml.replace(/\s\s+/g,'')
						 .replace(/<tr>/g,'')
						 .replace(/\r|\n/g,'')
						 .replace(/<thead>/g,'')
						 .replace(/<\/thead>/g,'')
						 .replace(/<tbody [a-z]*="[^"]*">/g,'')
						 .replace(/<button [^@]*/g,'')
						 .replace(/<\/tbody>/g,'')
						 .replace(/<tr [a-z]*="[a-z|A-Z|0-9|%|:|;]*">/g,'')
						 .replace(/<\/tr>/g,'\r\n')
						 .replace(/<th [a-z]*="[a-z|A-Z|0-9|%|:|;]*">/g,'')
						 .replace(/<\/th>/g,',')
						 .replace(/<b>/g,'')
						 .replace(/<\/b>/g,'')
						 .replace(/<td>/g,'')
						 .replace(/<\/td>/g,',')
						 .replace(/<\t>/g,'')
						 .replace(/<\n>/g,'')
						 .replace(/<img src="/g,'')
						 .replace(/" class="[^>]*>/g,'');
	var csvFile = new Blob([datos], {type: "text/csv"});
	var link = document.createElement("a");
	link.download = nombreCSV+".csv";
	//link.href = "data.application/csv,"+escape(datos);
	link.href = window.URL.createObjectURL(csvFile);

	link.click();
	
	
}
function getQueryVariable(variable) {
   var query = window.location.search.substring(1);
   var vars = atob(query).split("&");
  
  for (var i=0; i < vars.length; i++) {
       var pair = vars[i].replace('=','/').split("/");
      
       if(pair[0] == variable) {
           return pair[1];
       }
   }
   return false;
}
function obtener_fechas(){
    var f_inicial = getQueryVariable("f_inicial");
	var f_final = getQueryVariable("f_final");
	var servicio = getQueryVariable("servicio");
	$.ajax({
			method: "POST",
			url: "php/obtener_fecha_mtd.php",
			dataType:"json",
			data : {servicio:servicio,f_final:f_final,f_inicial:f_inicial}
	}).done(function(data){
		
		var fecha = "";
			data.fecha.forEach(function(entry){
				fecha += '<option value="'+entry.fecha+'">'+entry.fecha+'</option>';
			});
		$("#fecha").append(fecha);
		obtener_asistencia();
	}).fail(function(){
		
		alert("Funcionalidad no desponible por el momento, intente m\u00E1s tarde");
		
	});
	
}
function obtener_asistencia(){
		
		var fecha = $("#fecha").val();
		var servicio = getQueryVariable("servicio");
		$.ajax({
			method: "POST",
			url: "php/obtener_asistencia_mtd.php",
			dataType:"json",
			data:{servicio:servicio,fecha:fecha}
		}).done(function(data){
			
			console.log(data);
			var resultado = "";
			data.fecha.forEach(function(entry){
			resultado += '<tr>'+
						'<td>'+entry.codigo+'</td>'+
						'<td>'+entry.nombre+'</td>'+
						'<td>'+entry.servicio+'</td>'+
						'<td>'+entry.entrada+'</td>'+
						'<td>'+entry.salida+'</td>'+
						'</tr>';
			
		    } );
		
			$('#asitencia').empty();
			$('#asitencia').append(resultado);

			
		}).fail(function(error){
			alert("Por el momento no est\u00E1 disponible el servicio, intente m\u00E1s tarde");
			
		});
   
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
	obtener_fechas();
	$('#fecha').change(obtener_asistencia);

});