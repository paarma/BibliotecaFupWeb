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

