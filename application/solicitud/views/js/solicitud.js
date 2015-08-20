$(document).ready(function() {
  
  $("#msgValidacion").text("");
  $("#msgValidacion").hide();
  
  ////////////Si esta en la interfaz de ListarSolicitudes
  if ($('#tblListaSolicitudes').length){
	  $("#panelDetalleSolicitud").hide();
  }
    
  
  inicializar();  
    
});


/**
 *Funcion encargada de inicialiar variables 
 */
function inicializar(){
	
	////////////Si esta en la interfaz de ListarSolicitudes
	if ($('#tblListaSolicitudes').length){
		//Listar Solicitudes
		listarSolicitudes();
		$("#panelDetalleSolicitud").hide();
	}
	
	///////////Si esta en la interfaz de buscarSolicitud
	//Se inicializa el formulario
	if($("#formSearchSolicitud").length){
		$("#formSearchSolicitud")[0].reset();
	}	
}


/**
 *Funcion encargada de listar las solicitudes 
 */
function listarSolicitudes(){

  $.ajax({
    type : "POST",
    async: false,
    dataType: 'json',
    url : "../../../util/ControllerGeneral.php",
    data : {
      llamadoAjax : "true",
      opcion : "listadoSolicitudes"
    }
  }).done(function(data) {
  	
  	  var html = "";
      $.each(data, function (index, item) 
      {
      	
      	html += '<tr>';
      	html += '<td>'+item.libro.titulo+'</td>';
      	html += '<td>'+item.libro.isbn+'</td>';
      	html += '<td>'+item.usuario.codigo+'</td>';
      	
      	if(item.fechaSolicitud != null){
      		html += '<td>'+item.fechaSolicitud+'</td>';
      	}else{
      		html += '<td></td>';
      	}
      	
      	html += '<td>'+item.estado+'</td>';
      	html += '<td><input type="radio" name="rbtSeleccion" value='+item.idSolicitud+' onClick="verDetalleSolicitud('+item.idSolicitud+')" ></td>';
      	html += '</tr>';
      	      	
      });
      
      $("#tblListaSolicitudes").append(html);
      
      $("#tblListaSolicitudes").dataTable({
         "bJQueryUI": true,
         "sPaginationType": "full_numbers"
      });
	
    
  });

}


/**
 *Funcion encargada de desplegar los atributos de una solicitud seleccionada
 * @param {Object} idSolicitud
 */
function verDetalleSolicitud(idSolicitud){
	
	$("#panelDetalleSolicitud").show();

	$.ajax({
	type : "POST",
	async: false,
	dataType: 'json',
	url : "../../../util/ControllerGeneral.php",
	data : {
      llamadoAjax : "true",
      opcion : "verDetalleSolicitud",
      idSolicitud: idSolicitud
    }
  }).done(function(data) {	
  	
  	if(data != null){
  		
		$("#tbxTitulo").val(data.libro.titulo);
		$("#tbxIsbn").val(data.libro.isbn);
		$("#tbxCodTopografico").val(data.libro.codigoTopografico);
		$("#tbxTemas").val(data.temas);
		
		if(data.libro.editorial != null){
			$("#tbxEditorial").val(data.libro.editorial.descripcion);
		}else{
			$("#tbxEditorial").val('');
		}
		
		$("#tbxValor").val(data.libro.valor);
		$("#tbxCantidad").val(data.libro.cantidad);
		$("#tbxAnio").val(data.libro.anio);
		$("#tbxEstadoLibro").val(data.libro.estado);
		
		
		if(data.libro.area != null){
			$("#tbxArea").val(data.libro.area.descripcion);
		}else{
			$("#tbxArea").val('');
		}
		
		//Datos usuario
		$("#tbxCodUsuario").val(data.usuario.codigo);
		$("#tbxEmailUsuario").val(data.usuario.email);
		$("#tbxPrimerNombre").val(data.usuario.primerNombre);
		$("#tbxSegundoNombre").val(data.usuario.segundoNombre);
		$("#tbxPrimerApellido").val(data.usuario.primerApellido);
		$("#tbxSegundoApellido").val(data.usuario.segundoApellido);	
		
		//Datos solicitud
		$("#tbxFechaReserva").val(data.fechaReserva);
		$("#tbxFechaDevolucion").val(data.fechaDevolucion);
			
	}
  	
  });

}

