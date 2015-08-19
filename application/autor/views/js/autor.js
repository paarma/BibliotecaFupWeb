$(document).ready(function() {
  
  $("#msgValidacion").text("");
  $("#msgValidacion").hide();
    
  
  //Boton buscar autor
  $("#btnBuscarAutor").click(function(){
  	buscarAutor();
  });
  
  
  inicializar();
    
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
      	html += '<td><input type="radio" name="rbtEditar" value='+item.idAutor+'  ></td>';
      	html += '</tr>';
      	      	
      });
      
      $("#tblListaAutores").append(html);
      
      $("#tblListaAutores").dataTable({
         "bJQueryUI": true,
         "sPaginationType": "full_numbers"
      });
	
    
  });

}




