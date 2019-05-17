function crearCSV(tabla,nombreCSV){
	var tablehtml = $("#"+tabla).html();
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
						 .replace(/<a [^>]*>/g,'')
						 .replace(/<span [a-z]*="[a-z]* [a-z|-]*">/g,'')
						 .replace(/<br>/g,'|')
						 .replace(/<\/a>/g,'')
						 .replace(/<\/span>/g,'')
						 .replace(/<\/b>/g,'')
						 .replace(/<td>/g,'')
						 .replace(/<\/td>/g,',')
						 .replace(/<\t>/g,'')
						 .replace(/<\n>/g,'')
						 .replace(/<img src="/g,'')
						 .replace(/" class="[^>]*>/g,'')
						 .replace(/<[^>]+>/g,'');
						 
	
	var csvFile = new Blob([datos], {type: "text/csv"});
	var link = document.createElement("a");
	//link.download = nombreCSV+".csv";
	link.download = $("#f_inicial").val()+"/"+$("#f_final").val()+"-"+$("#servicio option:selected").text()+".csv";
	link.href = window.URL.createObjectURL(csvFile);

	link.click();
	
}

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
				servicio += '<option value="'+entry.id+'">'+entry.nombre+'</option>';
			});
			$("#servicio").append(servicio);
		}).fail(function(error){
			alert(error.responseText);
		});
	
}
function hora_a_enteros(hora){

	var numero = hora.split(":");
	
	return parseFloat(numero[0]+"."+numero[1]);
}
function obtener_asistencia(){
    
	if(valida_formulario() && $("#fecha").val() !='0'){
		
		var inicial = $("#f_inicial").val();
		var final = $("#f_final").val();
		var servicio = $("#servicio").val();
		var foto =  "";
		var asistencia = "";
		var contador_usuarios = 0;
		var registro;
		var listaHorario = 0;

		$.ajax({
			method: "POST",
			url: "php/obtener_asistencia_mtd.php",
			dataType:"json",
			data:{servicio:servicio,f_inicial:inicial, f_final:final}
		}).done(function(data){
			
			var resultado = "";
			var cambio_fecha = "";
			var turno = "";
			var temporal = "";
			var asistio = 0;
			console.log(data);	
			data.fecha.forEach(function(entry){
			
				data.requerimiento.forEach(function(turno){
					
					entry.usuarios.forEach(function(usuario){

						cambio_fecha = entry.fecha;
						temporal += '<tr>'+
								'<td>'+entry.fecha+'</td>'+
								'<td>'+turno.turno+'</td>'+
								'<td>'+usuario.codigo+'</td>'+
								'<td>'+usuario.nombre+'</td>';
						usuario.registros.forEach(function(acceso){

							if(acceso.accion == 'E'){

								if(hora_a_enteros(acceso.registro) >= hora_a_enteros(turno.entrada)-1 && hora_a_enteros(acceso.registro) <= hora_a_enteros(turno.te)){
									asistio = 1;
									registro = "blue";
								}else{
									registro = "red";
								}

							}else{
									if(hora_a_enteros(acceso.registro) >= hora_a_enteros(turno.ts)-1 && hora_a_enteros(acceso.registro) <= hora_a_enteros(turno.salida)+1 ){
										//asistio = 1;
									registro = "green";
								}else{
									registro = "red";
								}


							}
							
							//console.log(hora_a_enteros(acceso.registro));
							foto += '<img src="php/fotosAsistencia/'+acceso.foto+'" alt="Foto" class="img-rounded" style="width:60px">';
							asistencia += '<span style="color:'+registro+'">'+acceso.accion+'-'+acceso.registro+'</span><br>';

						});
						//'<td>'+ foto +'</td>'+
							temporal += '<td>'+asistencia+'</td>'+
								'</tr>';
							foto="";
							asistencia = "";
							if(asistio == 1 || data.requerimiento.length ==1){
								contador_usuarios ++;
								resultado += temporal;
							}
							asistio = 0;
							temporal = "";
				    });
				    if(contador_usuarios > 0){
					    resultado += '<tr>'+
						'<td></td>'+
						'<td></td>'+
						'<td></td>'+
						'<td style="color: blue">Personal solicitado: '+turno.personal+'. Asistentes: '+contador_usuarios+'.   Asitencia: '+parseInt(contador_usuarios * 100 /turno.personal) +'% </td>'+
						'<td></td></tr>';
					}
					contador_usuarios = 0;
				});
				
				resultado += '<tr>'+
					'<td></td>'+
					'<td></td>'+
					'<td></td>'+
					'<td></td>'+
					'<td></td></tr>';
						
			});
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