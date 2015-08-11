$(document).ready(function() {
  
  $("#msgValidacion").text("");
  $("#msgValidacion").hide();
    
    
  ////////////////////////Guardar libro     
  $("#btnGuardarLibro").click(function(){
	var validaciones = true;
	
	//Validacion ISBN
	if($("#tbxIsbn").val().trim() != ""){
	  if(verficarDatoEnBd('LIBRO','ISBN',$("#tbxIsbn").val().trim())){
        $("#msgValidacion").text("ISBN ya registrado");
        $("#msgValidacion").show();
        validaciones = false;
      }
	}
	
	//Validacion Cod.Topografico
	if($("#tbxCodTopografico").val().trim() != ""){
	  if(verficarDatoEnBd('LIBRO','COD_TOPOGRAFICO',$("#tbxCodTopografico").val().trim())){
        $("#msgValidacion").text("Cod Topografico ya registrado");
        $("#msgValidacion").show();
        validaciones = false;
      }
	}
	
	if(validaciones){
      $("#msgValidacion").text("");
      $("#msgValidacion").hide();
      $("#formAddLibro").submit();
    }
	
  });	
  //////////////////////////Fin guardar libro. 
    
});


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

