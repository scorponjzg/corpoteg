
var resolucion = "60%";
function obtener_usuario(){
	
	$.ajax({
	  method: "POST",
	  url: "php/obtener_usuario_alta_imss_mtd.php",
	  dataType: "json"
	  
	}).done(function(data){
		
		$("#nombre_usuario").html(data.nombre);
		llenar_tabla(data.usuario);
		
		}).fail(function(error){
		  
				alert("Por el momento no esta disponible el servicio, intente m\u00E1s tarde");
			  
		});
}

function guardar(){
	
	var identificador = $(this).attr("data-codigo");
	if($("#folio"+identificador).val() != "" && $("#alta"+identificador).val() != ""){

		$.ajax({
		  method: "POST",
		  url: "php/guardar_folio_fecha_mtd.php",
		  dataType: "json",
		  data: {"id": identificador, "folio": $("#folio"+identificador).val(), "fecha": $("#alta"+identificador).val()}
		  
		}).done(function(data){
		
			if(data.editado == 'true'){
				alert("Folio y fecha ingresados correctamente");
				$("#row"+identificador).remove();
			} else {
				alert("1.-Por el momento no esta disponible el servicio, intente m\u00E1s tarde");
			}
			
			}).fail(function(error){
		  
				alert("Por el momento no esta disponible el servicio, intente m\u00E1s tarde");
			  
		});

	} else {

		alert("Debe de ingresar el folio y la fecha");
		$("#folio"+identificador).focus();

	}
	/*
	identificador = btoa("identificador="+identificador)
	window.location.replace("editar.html?"+identificador);*/
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



function llenar_tabla(reporte){
	var fila = "";
	var credencial = '';
	var referencia = '';
	//console.log(reporte);
	reporte.forEach(function(entry){
			
			fila += '<tr class="success" id="row'+entry.identificador+'">'+
			'<td><b>'+safe_tags_replace(entry.codigo)+'</b></td>'+
			'<td><b>'+safe_tags_replace(entry.nombre)+'</b></td>'+
			'<td><b>'+safe_tags_replace(entry.empresa)+'</b></td>'+
			'<td><b>'+safe_tags_replace(entry.servicio)+'</b></td>'+
			'<td><b>'+safe_tags_replace(entry.turno)+'</b></td>'+
			'<td><b><input type="text" class="form-control" id="folio'+entry.identificador+'"  placeholder="Alta IMSS"></b></td>'+
			'<td><b><input type="date" id="alta'+entry.identificador+'" class="form-control"></b></td>'+
			'<td style="text-align: center;"><button id="ver'+entry.identificador+'" type="button" class="btn btn-success guardar" data-codigo="'+entry.identificador+'" data-accion="1" style="width:'+resolucion+'; color: white;"><span class="glyphicon glyphicon-share" aria-hidden="true"></span></button></td></tr>';
			
	});
					 
	$("#reporte").append(fila);

	$(".guardar").on('click',guardar);
				
	};
	

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

	
});