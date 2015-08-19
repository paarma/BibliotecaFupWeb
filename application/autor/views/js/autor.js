$(document).ready(function() {
  
  $("#msgValidacion").text("");
  $("#msgValidacion").hide();
    
  
  //Boton buscar autor
  $("#btnBuscarAutor").click(function(){
  	buscarAutor();
  });
  
  
  inicializar();
  cargarDatosAutorSeleccionado();
    
});


/**
 *Funcion encargada de inicialiar variables 
 */
function inicializar(){
	
	////////////Si esta en la interfaz de ListarAutores
	if ($('#tblListaAutores').length){
		//Listar Autores
		buscarAutores();
	}
	
	///////////Si esta en la interfaz de buscarAutor
	//Se inicializa el formulario
	if($("#formSearchAutor").length){
		$("#formSearchAutor")[0].reset();
	}
	
}


/**
 *Funcion encargada de verificar si existe un autor seleccionado por el admin
 * y posterior carga de datos del mismo.
 */
function cargarDatosAutorSeleccionado(){
	
  $.ajax({
    type : "POST",
    async: false,
    dataType: 'json',
    url : "../controllers/AutorController.php",
    data : {
      llamadoAjax : "true",
      opcion : "cargarDatosAutorSeleccionado"
    }
  }).done(function(data) {
  	
	if(data != null){
		
		$("#tbxPrimerNombre").val(data.primerNombre);
		$("#tbxSegundoNombre").val(data.segundoNombre);
		$("#tbxPrimerApellido").val(data.primerApellido);
		$("#tbxSegundoApellido").val(data.segundoApellido);
		$("#cbxTipoAutor").val(data.tipoAutor);
	}
	
  });
}

/**
 *Funcion encargada de listar los autores 
 */
function buscarAutores(){

  $.ajax({
    type : "POST",
    async: false,
    dataType: 'json',
    url : "../../../util/ControllerGeneral.php",
    data : {
      llamadoAjax : "true",
      opcion : "listadoAutores"
    }
  }).done(function(data) {
  	
  	  var html = "";
      $.each(data, function (index, item) 
      {
      	
      	html += '<tr>';
      	html += '<td>'+item.primerNombre+" "+item.segundoNombre+ '</td>';
      	html += '<td>'+item.primerApellido+" "+item.segundoApellido+ '</td>';
        html += '<td>'+item.tipoAutor+'</td>';    	
      	html += '<td><input type="radio" name="rbtEditar" value='+item.idAutor+' onClick="cargarEditar('+item.idAutor+')" ></td>';
      	html += '</tr>';
      	      	
      });
      
      $("#tblListaAutores").append(html);
      
      $("#tblListaAutores").dataTable({
         "bJQueryUI": true,
         "sPaginationType": "full_numbers"
      });
	
    
  });

}


/**
 *Funcion encargada de capturar el autorSeleccionado
 * @param {Object} idLibro
 */
function cargarEditar(idAutor){

	$.ajax({
	type : "POST",
	async: false,
	dataType: 'json',
	url : "../../../util/ControllerGeneral.php",
	data : {
      llamadoAjax : "true",
      opcion : "capurarAutorSeleccionado",
      idAutor: idAutor
    }
  }).done(function(data) {	
  	$("#formListarAutores").submit();
  });

}


/**
 *Funcion encargada de setear los datos de busqueda de un autor 
 */
 function buscarAutor(){
	
  $.ajax({
	type : "POST",
	async: false,
	url : "../controllers/AutorController.php",
	data : {
      llamadoAjax : "true",
      opcion : "buscarAutor",
      primerNombre: $("#tbxPrimerNombre").val(),
      segundoNombre: $("#tbxSegundoNombre").val(),
      primerApellido: $("#tbxPrimerApellido").val(),
      segundoApellido: $("#tbxSegundoApellido").val(),
      tipoAutor: $("#cbxTipoAutor").val()
    }
  }).done(function(data) {
  		$("#formSearchAutor").submit();
  	});
	
}




