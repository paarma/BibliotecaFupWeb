$(document).ready(function() {
  
  $("#msgValidacion").text("");
  $("#msgValidacion").hide();
  
	  ////////////Si esta en la interfaz de ListarUsuarios
	if ($('#tblListaUsuarios').length){
		$("#panelDetalleUsuario").hide();
	}
  
  
  //Boton buscar usuario
  $("#btnBuscarUsuario").click(function(){
  	buscarUsuario();
  });
  
  
  inicializar();
  cargarDatosUsuarioSeleccionado();  
    
  ////////////////////////Guardar usuario     
  $("#btnGuardarUsuario").click(function(){
  	validarGuardar();		
  });	
  //////////////////////////Fin guardar libro.  
    
});


/**
 *Funcion encargada de inicialiar variables 
 */
function inicializar(){
	
	//inicializar variables
	$("#idUsuario").val(0);
	$("#cedulaOriginal").val('');
	$("#emailOriginal").val('');
	$("#codigoOriginal").val('');
	
	////////////Si esta en la interfaz de ListarUsuarios
	if ($('#tblListaUsuarios').length){
		//Listar Usuarios
		buscarUsuarios();
		$("#panelDetalleLibro").hide();
	}
	
	///////////Si esta en la interfaz de buscarUsuario
	//Se inicializa el formulario
	if($("#formSearchUsuario").length){
		$("#formSearchUsuario")[0].reset();
	}
	
}

/**
 *Funcion encargada de verificar si existe un usuario seleccionado por el admin
 * y posterior carga de datos del mismo.
 */
function cargarDatosUsuarioSeleccionado(){
	
  $.ajax({
    type : "POST",
    async: false,
    dataType: 'json',
    url : "../controllers/UsuarioController.php",
    data : {
      llamadoAjax : "true",
      opcion : "cargarDatosUsuarioSeleccionado"
    }
  }).done(function(data) {
  	
	if(data != null){
		
		//idUsuario
		$("#idUsuario").val(data.idUsuario);
		$("#cedulaOriginal").val(data.cedula);
		$("#emailOriginal").val(data.email);
		$("#codigoOriginal").val(data.codigo);
		
		$("#tbxCedula").val(data.cedula);
		$("#tbxTelefono").val(data.telefono);
		$("#tbxPrimerNombre").val(data.primerNombre);
		$("#tbxSegundoNombre").val(data.segundoNombre);
		$("#tbxPrimerApellido").val(data.primerApellido);
		$("#tbxSegundoApellido").val(data.segundoApellido);
		$("#tbxDireccion").val(data.direccion);
		$("#tbxEmail").val(data.email);
		$("#tbxCodigo").val(data.codigo);
		$("#tbxClave").val(data.clave);
		$("#cbxRol").val(data.rol);
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
	 * Si esta creando un nuevo usuario
	 */
	if($("#idUsuario").val() == 0){
		//Validacion cedula
		if($("#tbxCedula").val().trim() != ""){
		  if(verficarDatoEnBd('USUARIO','CEDULA',$("#tbxCedula").val().trim())){
		    $("#msgValidacion").text("Cedula ya registrada");
		    $("#msgValidacion").show();
		    validaciones = false;
		  }
		}
		
		//Validacion email
		if($("#tbxEmail").val().trim() != ""){
		  if(verficarDatoEnBd('USUARIO','EMAIL',$("#tbxEmail").val().trim())){
		    $("#msgValidacion").text("Email ya registrado");
		    $("#msgValidacion").show();
		    validaciones = false;
		  }
		}
		
		//Validacion código
		if($("#tbxCodigo").val().trim() != ""){
		  if(verficarDatoEnBd('USUARIO','CODIGO',$("#tbxCodigo").val().trim())){
		    $("#msgValidacion").text("Código ya registrado");
		    $("#msgValidacion").show();
		    validaciones = false;
		  }
		}
	}
	
	/**
	 *Si esta editando un usuario 
	 */
	if($("#idUsuario").val() != 0){
		//Validacion cedula
		if($("#tbxCedula").val().trim() != "" && $("#cedulaOriginal").val() != $("#tbxCedula").val().trim()){
		  if(verficarDatoEnBd('USUARIO','CEDULA',$("#tbxCedula").val().trim())){
		    $("#msgValidacion").text("Cedula ya registrada");
		    $("#msgValidacion").show();
		    validaciones = false;
		  }
		}
		
		//Validacion email
		if($("#tbxEmail").val().trim() != "" && 
			$("#emailOriginal").val() != $("#tbxEmail").val().trim()){
					
		  if(verficarDatoEnBd('USUARIO','EMAIL',$("#tbxEmail").val().trim())){
		    $("#msgValidacion").text("Email ya registrado");
		    $("#msgValidacion").show();
		    validaciones = false;
		  }
		}
		
		//Validacion código
		if($("#tbxCodigo").val().trim() != "" && 
			$("#codigoOriginal").val() != $("#tbxCodigo").val().trim()){
					
		  if(verficarDatoEnBd('USUARIO','CODIGO',$("#tbxCodigo").val().trim())){
		    $("#msgValidacion").text("Código ya registrado");
		    $("#msgValidacion").show();
		    validaciones = false;
		  }
		}
		
	}
	
	if(validaciones){
	  $("#msgValidacion").text("");
	  $("#msgValidacion").hide();
	  $("#formAddUsuario").submit();
	}
}


/**
 *Funcion encargada de listar los usuarios 
 */
function buscarUsuarios(){

  $.ajax({
    type : "POST",
    async: false,
    dataType: 'json',
    url : "../../../util/ControllerGeneral.php",
    data : {
      llamadoAjax : "true",
      opcion : "listadoUsuarios"
    }
  }).done(function(data) {
  	
  	  var html = "";
      $.each(data, function (index, item) 
      {
      	
      	html += '<tr>';
      	html += '<td>'+item.primerNombre+" "+item.segundoNombre+ '</td>';
      	html += '<td>'+item.primerApellido+" "+item.segundoApellido+ '</td>';
        html += '<td>'+item.codigo+'</td>';
        html += '<td>'+item.email+'</td>';     	
      	html += '<td><input type="radio" name="rbtSeleccion" value='+item.idUsuario+' onClick="verDetalleUsuario('+item.idUsuario+')" ></td>';
      	html += '</tr>';
      	      	
      });
      
      $("#tblListaUsuarios").append(html);
      
      $("#tblListaUsuarios").dataTable({
         "bJQueryUI": true,
         "sPaginationType": "full_numbers"
      });
	
    
  });

}

/**
 *Funcion encargada de desplegar los atributos de un libro seleccionado
 * @param {Object} idLibro
 */
function verDetalleUsuario(idUsuario){
	
	$("#panelDetalleUsuario").show();

	$.ajax({
	type : "POST",
	async: false,
	dataType: 'json',
	url : "../../../util/ControllerGeneral.php",
	data : {
      llamadoAjax : "true",
      opcion : "verDetalleUsuario",
      idUsuario: idUsuario
    }
  }).done(function(data) {	
  	
  	if(data != null){
		
		$("#tbxCedula").val(data.cedula);
		$("#tbxTelefono").val(data.telefono);
		$("#tbxPrimerNombre").val(data.primerNombre);
		$("#tbxSegundoNombre").val(data.segundoNombre);
		$("#tbxPrimerApellido").val(data.primerApellido);
		$("#tbxSegundoApellido").val(data.segundoApellido);
		$("#tbxDireccion").val(data.direccion);
		$("#tbxEmail").val(data.email);
		$("#tbxCodigo").val(data.codigo);
		$("#tbxClave").val(data.clave);
		$("#tbxRol").val(data.rol);
	}
  	
  });

}

/**
 *Funcion encargada de setear los datos de busqueda de un usuario 
 */
 function buscarUsuario(){
	
  $.ajax({
	type : "POST",
	async: false,
	url : "../../../util/ControllerGeneral.php",
	data : {
      llamadoAjax : "true",
      opcion : "buscarUsuario",
      cedula: $("#tbxCedula").val(),
      primerNombre: $("#tbxPrimerNombre").val(),
      segundoNombre: $("#tbxSegundoNombre").val(),
      primerApellido: $("#tbxPrimerApellido").val(),
      segundoApellido: $("#tbxSegundoApellido").val(),
      codigo: $("#tbxCodigo").val(),
      rol: $("#cbxRol").val()
    }
  }).done(function(data) {
  		$("#formSearchUsuario").submit();
  	});
	
}




