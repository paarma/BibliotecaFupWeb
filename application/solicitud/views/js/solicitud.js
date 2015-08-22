$(document).ready(function() {
  
  $("#msgValidacion").text("");
  $("#msgValidacion").hide();
  
  $("#tbxValorCancelado").numeric();
  
    //Dialog multas
  $("#dialogMultas").dialog({
      autoOpen: false,
      resizable: false,
      /*height:370,*/
      width: 350,
      modal: true,
      show: {
        effect: "clip",
        duration: 300
      },
      hide: {
        effect: "explode",
        duration: 300
      },
      buttons: {
        Aceptar: function() {          
          //$( this ).dialog( "close" );
          guardarMulta();
        },
        Cancelar: function() {	
          $( this ).dialog( "close" );
        }
      }
    });
  
  ////////////Si esta en la interfaz de ListarSolicitudes
  if ($('#tblListaSolicitudes').length){
	  $("#panelDetalleSolicitud").hide();
  }
    
  
  inicializar();  
  
  //Boton accionSolicitud
  $("#btnAccionSolicitud").click(function(){
  	gestionSolicitud();
  });
    
});


/**
 *Funcion encargada de inicialiar variables 
 */
function inicializar(){
	
	$("#idSolicitud").val(0);
	$("#estadoOriginal").val('');
	$("#diasMora").val(0);
	
	$("#msgValidacion").text("");
    $("#msgValidacion").css("display", "none");
    
    //Se limpia la tabla de listado solicitudes
    //$("#tblListaSolicitudes tbody").remove();
    //$("#tblListaSolicitudes td").parent().remove();
	
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
	
  $("#msgValidacion").text("");
  $("#msgValidacion").css("display", "none");
  
	$("#panelDetalleSolicitud").show();
	
	$("#idSolicitud").val(0);
	$("#estadoOriginal").val('');
	$("#diasMora").val(0);

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
  		
  		$("#idSolicitud").val(data.idSolicitud);
		$("#estadoOriginal").val(data.estado);
  		
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
		
		//Despliega el boton de accion segun el estado de la solicitud
		if(data.estado == "FINALIZADO"){
			$("#btnAccionSolicitud").hide();
		}else{
			$("#btnAccionSolicitud").show();
			
			if(data.estado == "EN PROCESO"){
				$("#btnAccionSolicitud").val('PRESTAR');
			}else if(data.estado == "PRESTADO" || data.estado == "EN MORA"){
				$("#btnAccionSolicitud").val('REGRESAR');
			}
		}
				
	}
  	
  });

}

/**
 * Funcion engargada de gestionar la solicitud
 */
function gestionSolicitud(){
	
	var estadoFinalSolicitud = "";
	
	/////////////////////////Se fija el estado en el cual quedara la solicitud.
    //Si la solicitud esta en estado "EN PROCESO", pasa a estado "PRESTADO"
	if($("#estadoOriginal").val() == "EN PROCESO"){
		estadoFinalSolicitud = "PRESTADO";
	}else{
		//De lo contrario indica que se esta regresando un libro.
		estadoFinalSolicitud = "FINALIZADO";
	}
	
  $.ajax({
	type : "POST",
	async: false,
	url : "../controllers/SolicitudController.php",
	data : {
      llamadoAjax : "true",
      opcion : "actualizarSolicitudes",
      idSolicitud: $("#idSolicitud").val(),
      estado : estadoFinalSolicitud
    }
  }).done(function(data) {

  	if(data == 1){
  		//Si la solicitud tenia estado es "EN  MORA", se gestiona la funcionalidad de multas.
  		if($("#estadoOriginal").val() == "EN MORA"){
  			llamarMultas();
  		}
  		
	  	  //$("#msgValidacion").removeClass("bad");
		  $("#msgValidacion").addClass("good");
		  $("#msgValidacion").text("La información se almaceno exitosamente");
		  $("#msgValidacion").css("display", "block");
  		
  	}else{
  		//Error almacenando los datos
  		  $("#msgValidacion").addClass("bad");
		  $("#msgValidacion").text("Error almacenando la información, intenta enviar los datos nuevamente...");
		  $("#msgValidacion").css("display", "block");
  	}	
  		
  });
 
}

/**
 * Funcion encargada de desplegar la funcionalidad de multas
 */
function llamarMultas(){
	
 //Se obtiene el valor de la multa
  $.ajax({
	type : "POST",
	async: false,
	url : "../controllers/SolicitudController.php",
	data : {
	  llamadoAjax : "true",
	  opcion : "obtenerDatosMulta",
	  fechaReserva : $("#tbxFechaReserva").val()
	    }
	  }).done(function(data) {
		
		//Se obtiene los dias de mora concatenados con el valor base de la multa
		var arrayData = data.split('_');
		
		var diasMora = arrayData[0];
		var valorMultaBase = arrayData[1];
		var valorTotal = diasMora * valorMultaBase; 
		
		$("#diasMora").val(diasMora);
		$("#tbxValorSugerido").val(valorTotal);
	  	$("#dialogMultas").dialog( "open" );
	  	
	});
	
}


/**
 * Funcion engargada de guardar las multas
 */
function guardarMulta(){
	
 $.ajax({
	type : "POST",
	async: false,
	url : "../controllers/SolicitudController.php",
	data : {
	  llamadoAjax : "true",
	  opcion : "guardarMulta",
	  idSolicitud : $("#idSolicitud").val(),
	  valorSugerido : $("#tbxValorSugerido").val(),
	  valorCancelado : $("#tbxValorCancelado").val(),
	  diasMora : $("#diasMora").val(),
	  nota : $("#tbxNota").val()
	    }
	  }).done(function(data) {
		$("#dialogMultas").dialog( "close" );
	});
	
}


