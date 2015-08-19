$(document).ready(function() {
  
  $("#msgValidacion").text("");
  $("#msgValidacion").hide();
  
  
  // Agregar Editorial
  $("#formAddEditorial").validate({
    rules: {
      tbxEditorial: { required: true},
    }
  });
  
  
  inicializar();
  cargarDatosEditorialSeleccionada();  
    
  ////////////////////////Guardar usuario     
  $("#btnGuardarEditorial").click(function(){
  	validarGuardar();		
  });	
  //////////////////////////Fin guardar libro.  
    
});


/**
 *Funcion encargada de inicialiar variables 
 */
function inicializar(){
	
	//inicializar variables
	$("#idEditorial").val(0);
	$("#descripcionOriginal").val('');
	
	////////////Si esta en la interfaz de ListarEditorial
	if ($('#tblListaEditoriales').length){
		//Listar Editoriales
		listadoEditoriales();
	}
	
}

/**
 *Funcion encargada de verificar si existe una Editorial seleccionada por el admin
 * y posterior carga de datos del mismo.
 */
function cargarDatosEditorialSeleccionada(){
	
  $.ajax({
    type : "POST",
    async: false,
    dataType: 'json',
    url : "../controllers/EditorialController.php",
    data : {
      llamadoAjax : "true",
      opcion : "cargarDatosEditorialSeleccionada"
    }
  }).done(function(data) {
  	
	if(data != null){
		
		$("#idEditorial").val(data.idEditorial);
		$("#descripcionOriginal").val(data.descripcion);
		
		$("#tbxEditorial").val(data.descripcion);
	}
	
  });
}

/**
 * Verifica si un elemento ya se encuentra registrado en la bd
 * Tabla ha verificar
 * Campo ha verificar
 * Valor ha verificar
 */
 function verficarDatoEnBd(tablaVerificar,campoVerificar,valorVerificar){

  var respuesta = false;
  
  $.ajax({
    type : "POST",
    async: false,
    url : "../../../util/ControllerGeneral.php",
    data : {
      llamadoAjax : "true",
      opcion : "verficarDatoEnBd",
      tabla : tablaVerificar,
      campo : campoVerificar,
      valor : valorVerificar
    }
  }).done(function(data) {
  	
  	if(data == 1){
  		respuesta = true;
  	}
    
  });
  return respuesta;
  
 }


/**
 *Funcion encargada de validar los datos y posterior guardado 
 */
function validarGuardar(){
	
	var validaciones = true;
	
	 /**
	 * Si esta creando una nueva editorial
	 */
	if($("#idEditorial").val() == 0){
		//Validacion descripcion
		if($("#tbxEditorial").val().trim() != ""){
		  if(verficarDatoEnBd('EDITORIAL','DESCRIPCION',$("#tbxEditorial").val().trim())){
		    $("#msgValidacion").text("Editorial ya registrada");
		    $("#msgValidacion").show();
		    validaciones = false;
		  }
		}
	}
	
	/**
	 *Si esta editando una editorial
	 */
	if($("#idEditorial").val() != 0){
		//Validacion cedula
		if($("#tbxEditorial").val().trim() != "" && $("#descripcionOriginal").val() != $("#tbxEditorial").val().trim()){
		  if(verficarDatoEnBd('EDITORIAL','DESCRIPCION',$("#tbxEditorial").val().trim())){
		    $("#msgValidacion").text("Editorial ya registrada");
		    $("#msgValidacion").show();
		    validaciones = false;
		  }
		}		
	}
	
	if(validaciones){
	  $("#msgValidacion").text("");
	  $("#msgValidacion").hide();
	  $("#formAddEditorial").submit();
	}
}


/**
 *Funcion encargada de listar los usuarios 
 */
function listadoEditoriales(){

  $.ajax({
    type : "POST",
    async: false,
    dataType: 'json',
    url : "../../../util/ControllerGeneral.php",
    data : {
      llamadoAjax : "true",
      opcion : "listadoEditorial"
    }
  }).done(function(data) {
  	
  	  var html = "";
      $.each(data, function (index, item) 
      {
      	
      	html += '<tr>';
      	html += '<td>'+item.descripcion+'</td>';    	
      	html += '<td><input type="radio" name="rbtSeleccion" value='+item.idEditorial+' onClick="cargarEditar('+item.idEditorial+')" ></td>';
      	html += '</tr>';
      	      	
      });
      
      $("#tblListaEditoriales").append(html);
      
      $("#tblListaEditoriales").dataTable({
         "bJQueryUI": true,
         "sPaginationType": "full_numbers"
      });
    
  });

}

/**
 *Funcion encargada de capturar la editorial seleccionada
 * @param {Object} idEditorial
 */
function cargarEditar(idEditorial){

  $.ajax({
	type : "POST",
	async: false,
	dataType: 'json',
	url : "../controllers/EditorialController.php",
	data : {
      llamadoAjax : "true",
      opcion : "capurarEditorialSeleccionada",
      idEditorial: idEditorial
    }
  }).done(function(data) {	
  	$("#formListarEditoriales").submit();
  });

}




