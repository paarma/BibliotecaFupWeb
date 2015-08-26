$(document).ready(function() {
  
  $("#msgValidacion").text("");
  $("#msgValidacion").hide();

  
  ////////////Si esta en la interfaz de ListarMisLibros
  if ($('#tblListaMisLibros').length){
	$("#panelDetalleLibro").hide();
  } 
	
  inicializar(); 
  
    //Boton buscar libro
  $("#btnBuscarLibro").click(function(){
  	buscarLibro();
  });
  
  
});


/**
 *Funcion encargada de inicialiar variables 
 */
function inicializar(){
	
	//Cargar combos
	cargarCombos('EDITORIAL','cbxEditorial');
	cargarCombos('AUTOR','cbxAutor');
	
	////////////Si esta en la interfaz de ListarMisLibros
	if ($('#tblListaMisLibros').length){
		//Listar Libros
		listarMisLibros();
		$("#panelDetalleLibro").hide();
	}
	
	///////////Si esta en la interfaz de buscarLibro
	//Se inicializa el formulario
	if($("#formSearchLibro").length){
		$("#formSearchLibro")[0].reset();
	}

}


/**
 *Funcion encargada de listar los libros 
 */
function listarMisLibros(){

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
      	html += '<td>'+item.libro.codigoTopografico+'</td>';
      	
      	if(item.libro.editorial != null){
      		html += '<td>'+item.libro.editorial.descripcion+'</td>';
      	}else{
      		html += '<td></td>';
      	}
      	
      	html += '<td><input type="radio" name="rbtSeleccion" value='+item.idSolicitud+' onClick="verDetalleSolicitud('+item.idSolicitud+')" ></td>';
      	html += '</tr>';
      	      	
      });
      
      $("#tblListaMisLibros").append(html);
      
      $("#tblListaMisLibros").dataTable({
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
	
	//$("#formListarlibros")[0].reset();
	$("#panelDetalleLibro").show();
	
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
		$("#tbxTemas").val(data.libro.temas);
		$("#tbxPaginas").val(data.libro.paginas);
		$("#tbxValor").val(data.libro.valor);
		
		if(data.libro.editorial != null){
			$("#tbxEditorial").val(data.libro.editorial.descripcion);
		}else{
			$("#tbxEditorial").val('');
		}
		
		if(data.libro.area != null){
			$("#tbxArea").val(data.libro.area.descripcion);
		}else{
			$("#tbxArea").val('');
		}
		
		
		//Pais/Ciudad.
		if(data.libro.ciudad != null){
			
			$("#tbxPais").val(data.libro.ciudad.pais.nombre);
			$("#tbxCiudad").val(data.libro.ciudad.nombre);
		}else{
			
			$("#tbxPais").val('');
			$("#tbxCiudad").val('');
		}
		
		$("#tbxEstadoLibro").val(data.libro.estado);
		$("#tbxAnio").val(data.libro.anio);
		
		//Datos solicitud
		$("#tbxFechaReserva").val(data.fechaReserva);
		$("#tbxFechaDevolucion").val(data.fechaDevolucion);
		$("#tbxEstadoReserva").val(data.estado);
		
	}
  	
  });

}


/**
 *Funcion encargada de cargar los combos dinamicamente 
 * @param {Object} tabla
 * @param {Object} combo
 */
function cargarCombos(tabla,combo){
	
  $.ajax({
    type : "POST",
    async: false,
    dataType: 'json',
    url : $("#baseUrl").val()+"util/CargarCombos.php",
    data : {
      llamadoAjax : "true",
      opcion : "cargarCombo",
      tabla : tabla
    }
  }).done(function(data) {
      var html = "";
      html +=  '<option value="">Seleccione...</option>';

      var selected = "";
      
      $.each(data, function (index, item) 
      {
        
        if(tabla == 'EDITORIAL'){
          html += '<option value='+item.ID_EDITORIAL+'>'+item.DESCRIPCION+'</option>';
        }
        
        if(tabla == 'AREA'){
          html += '<option value='+item.ID_AREA+'>'+item.DESCRIPCION+'</option>';
        }
        
        if(tabla == 'SEDE'){
          html += '<option value='+item.ID_SEDE+'>'+item.DESCRIPCION+'</option>';
        }
        
        if(tabla == 'PAIS'){
          html += '<option value='+item.ID_PAIS+'>'+item.NOMBRE+'</option>';
        }
        
        if(tabla == 'AUTOR'){
          	var nombreAutor = item.PRIMER_NOMBRE+" "+item.SEGUNDO_NOMBRE+" "+
          	item.PRIMER_APELLIDO+" "+item.SEGUNDO_APELLIDO;
          	
          html += '<option value='+item.ID_AUTOR+'>'+nombreAutor+" "+'</option>';
        }
        
      });

      $('#'+combo).append(html);   
  });

}


/**
 *Funcion encargada de setear los datos de busqueda de un libro 
 */
 function buscarLibro(){
	
  $.ajax({
	type : "POST",
	async: false,
	url : "../../../util/ControllerGeneral.php",
	data : {
      llamadoAjax : "true",
      opcion : "buscarLibro",
      titulo: $("#tbxTitulo").val(),
      isbn: $("#tbxIsbn").val(),
      codTopografico: $("#tbxCodTopografico").val(),
      temas: $("#tbxTemas").val(),
      idEditorial: $("#cbxEditorial").val(),
      idAutor: $("#cbxAutor").val()
    }
  }).done(function(data) {
  		
  	   $("#formSearchLibro").submit();
  		
  	});
	
}

