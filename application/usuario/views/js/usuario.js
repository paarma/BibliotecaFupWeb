$(document).ready(function() {
  
  $("#msgValidacion").text("");
  $("#msgValidacion").hide();
  
  inicializar();  
    
  ////////////////////////Guardar libro     
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




