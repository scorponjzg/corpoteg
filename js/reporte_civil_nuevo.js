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

function restarHoras(inicio, fin) {
  
  var inicioHoras = parseInt(inicio.substr(0,2));
  var inicioMinutos = parseInt(inicio.substr(3,2));
  
  var finHoras = parseInt(fin.substr(0,2));
  var finMinutos = parseInt(fin.substr(3,2));
  if(fin == ""){
  	console.log(typeof(finHoras));
  	console.log(typeof(finMinutos));
  }

  var transcurridoHoras = finHoras - inicioHoras;
  var transcurridoMinutos = finMinutos - inicioMinutos;
  //para horario nocturno
  if(inicioHoras > 20 && finHoras < 8 || finHoras < 8 && inicio == "" || fin == "" && inicioHoras > 20){

  		if(inicio == ""){
  			transcurridoHoras = finHoras;
  			transcurridoMinutos = finMinutos;
  		} else if(fin == "") {
  			transcurridoHoras = (24 - inicioHoras);
  			transcurridoMinutos = 0 - inicioMinutos;
  		} else {
  			transcurridoHoras = (24 - inicioHoras) + finHoras;
  			transcurridoMinutos = finMinutos - inicioMinutos;
  			
  		}

  } 
  // termina horario nocturno
  
  if (transcurridoMinutos < 0) {
    transcurridoHoras--;
    transcurridoMinutos = 60 + transcurridoMinutos;
  }
  
  horas = transcurridoHoras.toString();
  minutos = transcurridoMinutos.toString();
  
  if (horas.length < 2) {
    horas = "0"+horas;
  }
  
  if (horas.length < 2) {
    horas = "0"+horas;
  }
  	return horas+":"+minutos;

}

function valida_formulario(){
	
	var inicial = $("#f_inicial").val();
	
	var turno = $("#turno").val();
	var correcto = true;
	
	if(turno == '0'){
		alert("Debe seleccionar un turno");
		$("#turno").focus();
		correcto = false;
	} else if( inicial ==''){
		alert("Debe seleccionar una fecha");
		$("#f_inicial").focus();		
		correcto = false;
	}
	
		return correcto;
}
function obtener_turno(){
	
		$.ajax({
			method:"POST",
			url: "php/obtener_turno_civil_mtd.php",
			dataType: "json"
		}).done(function(data){
			console.log(data);
			var turno = "";
			data.turno.forEach(function(entry){
				turno += '<option value="'+entry.id+'">'+entry.nombre+'</option>';
			});
			$("#turno").append(turno);
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
		
		var fecha = $("#f_inicial").val();
		var turno = $("#turno").val();
		var foto =  "";
		var contador_usuarios = 0;
		var registro;
		var listaHorario = 0;

		$.ajax({
			method: "POST",
			url: "php/obtener_asistencia_civil_mtd.php",
			dataType:"json",
			data:{'fecha':fecha, 'turno': turno}
		}).done(function(data){
			console.log(data);
			var resultado = "";
		
			data.fecha.forEach(function(entry){					
					
						resultado += '<tr>'+
								'<td>'+entry.codigo+'</td>'+
								'<td>'+entry.nombre+'</td>'+
								'<td>Fecha</td>'+
								'<td>'+entry.nombre+'</td>'+
								'<td>'+entry.nombre+'</td>';
							
						
			});
			
			$('#asitencia').empty();
			$('#asitencia').append(resultado);

			
		}).fail(function(error){
			alert("Por el momento no est\u00E1 disponible el servicio, intente m\u00E1s tarde");
			
		});
    } else {
    	$('#asitencia').empty();
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
	obtener_turno();
	
});