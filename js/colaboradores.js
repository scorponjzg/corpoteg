
var resolucion = "60%";
function obtener_usuario(){
	
	$.ajax({
	  method: "POST",
	  url: "php/obtener_colaborador.php",
	  dataType: "json"
	  
	}).done(function(data){
		
		llenar_tabla(data.usuario);
		
		}).fail(function(error){
		  
			alert("Por el momento no esta disponible el servicio, intente m\u00E1s tarde");
			  
		});
}

function actualizar(){
	
	var identificador = $(this).attr("data-codigo");
	identificador = btoa("identificador="+identificador)
	window.location.replace("editar.html?"+identificador);
}

var tagsToReplace = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;'
};

function replaceTag(tag) {
    return tagsToReplace[tag] || tag;
}

function safe_tags_replace(str) {
    return str.replace(/[&<>]/g, replaceTag);
}

function crearCSV(tabla,nombreCSV){
	var tablehtml = $("#"+tabla).html();
	//console.log(tablehtml);
	var datos = tablehtml.replace(/\s\s+/g,'')
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

function llenar_tabla(reporte){
	var fila = "";
	var credencial = '';
	var referencia = '';
	console.log(reporte);
	reporte.forEach(function(entry){
			
			fila += '<tr class="success"><td><img src="'+entry.foto+'" class="img-rounded" alt="Cinque Terre" width="70%"></td><td><b>'+safe_tags_replace(entry.nombre)+'</b></td><td><b>'+safe_tags_replace(entry.telefono)+'</b></td><td><b>'+safe_tags_replace(entry.medio)+'</b></td><td><b> En proceso</b></td><td><b>'+safe_tags_replace(entry.servicio)+'</b></td><td><b>'+safe_tags_replace(entry.estatus)+'</b></td><td><b>Pendiente</b></td><td><b>'+entry.fecha+'</b></td><td><button id="ver'+entry.identificador+'" type="button" class="btn btn-success actualizar" data-codigo="'+entry.identificador+'" data-accion="1" style="width:'+resolucion+';text-align:center; color: white; padding: 0 0 0 0;"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td></tr>';
			
			credencial += '<div class="well"><div class="img"><img src="'+entry.foto+'" class="img-rounded" alt="Cinque Terre" width="" ></div> </div>';
	});
					 
	$("#reporte").append(fila);
	//$("#info").append(credencial);
	$(".actualizar").on('click',actualizar);
				
	};
	
function nuevo_reporte(){
	
	window.location.replace("registro.php");
}

function resolucion_pantalla(){	
    
	if (screen.width<1024){
		
		$(".panel-default").css("width","100%");
	    $(".panel-default").css("margin-top","100px");
		resolucion = "100%"
	}
		   	
}

$(function(){
	resolucion_pantalla();
    obtener_usuario();
	
	$("#nuevo").on('click',nuevo_reporte);		
	
});