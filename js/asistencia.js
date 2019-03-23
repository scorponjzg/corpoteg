
function valida_formulario(){
	
	var inicial = $("#f_inicial").val();
	var final = $("#f_final").val();
	var servicio = $("#servicio").val();
	var correcto = true;
	
	if(servicio == '0'){
		alert("Debe seleccionar un servicio");
		$("#servicio").focus();
		correcto = false;
	} else if(final == '' && inicial ==''){
		alert("Debe seleccionar una fecha");
		$("#f_inicial").focus();		
		correcto = false;
	}
	
		return correcto;
}
function obtener_servicio(){
	
		$.ajax({
			method:"POST",
			url: "php/obtener_servicio_mtd.php",
			dataType: "json"
		}).done(function(data){
			
			var servicio = "";
			data.servicio.forEach(function(entry){
				servicio += '<option value="'+entry.pk+'">'+entry.servicio+'</option>';
			});
			$("#servicio").append(servicio);
		}).fail(function(error){
			alert(error.responseText);
		});
	
}

function obtener_asistencia(){
    
	if(valida_formulario() && $("#fecha").val() !='0'){
		
		var inicial = $("#f_inicial").val();
		var final = $("#f_final").val();
		var servicio = $("#servicio").val();
		var foto =  "";
		var asistencia = "";

		$.ajax({
			method: "POST",
			url: "php/obtener_asistencia_mtd.php",
			dataType:"json",
			data:{servicio:servicio,f_inicial:inicial, f_final:final}
		}).done(function(data){
			
			var resultado = "";
			console.log(data);
			data.fecha.forEach(function(entry){
				resultado += '<tr>'+
						'<td>'+entry.fecha+'</td>'+
						'<td>'+entry.codigo+'</td>'+
						'<td>'+entry.nombre+'</td>';
				entry.registros.forEach(function(acceso){
				
					foto += '<img src="php/fotosAsistencia/'+acceso.foto+'" alt="Foto" class="img-rounded" style="width:60px">';
					asistencia += '<span>'+acceso.accion+'-'+acceso.registro+'</span><br>';

				});
				resultado += '<td>'+ foto +'</td>'+
						'<td>'+asistencia+'</td>'+
						'</tr>';
					foto="";
					asistencia = "";
		    } );
		$("#reporte").empty();
		$("#reporte").append(resultado);
			$('#asitencia').empty();
			$('#asitencia').append(resultado);

			
		}).fail(function(error){
			alert("Por el momento no est\u00E1 disponible el servicio, intente m\u00E1s tarde");
			
		});
    } else {
    	$('#asitencia').empty();
    }
}
function limpiar_fecha(){
	
	$("#fecha").empty();
	$('#asitencia').empty();
	$("#fecha").append('<option value="0">Seleccione una fecha</option>');
}

function getAbsolutePath() {
	if(valida_formulario()){
	    var loc = window.location;
	    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
	    var urlAbsolute = loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
	    var search = "servicio="+$("#servicio").val()+"&f_inicial="+$("#f_inicial").val()+"&f_final="+$("#f_final").val();
	     $("#url_input").val(urlAbsolute+"visor_asistencia.php?"+btoa(search));
    }
}

$(function(){
	//encotrarEstudio();
	$("#buscar").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#asitencia tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
	obtener_servicio();
	$("#url_button").on('click',getAbsolutePath);
	$("#servicio").change(limpiar_fecha);
	
});