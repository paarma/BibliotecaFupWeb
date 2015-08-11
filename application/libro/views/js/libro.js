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
  
  //Cargar combos
  cargarCombos('EDITORIAL','cbxEditorial');
  cargarCombos('AREA','cbxArea');
  cargarCombos('SEDE','cbxSede');
  cargarCombos('PAIS','cbxPais');
  
  //Cargar cbx Ciudades segun pais
  $("#cbxPais").change(function(){
  	
  	//Se limpia el combo Ciudades y se recarga
  	$("#cbxCiudad option").remove();
  	if(this.value != ""){
  		cargarComboCiudades(this.value);
  	}
  
  });
  
    
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
 
 
 /**
 *Funcion encargada de cargar los combos dinamicamente 
 * @param {Object} tabla
 * @param {Object} combo
 */
function cargarCombos(tabla,combo){
	
  $.ajax({
    type : "POST",
    async: true,
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
        
      });

      $('#'+combo).append(html);   
  });

}


/**
 * Funcion encargada de cargar el combo ciudades segun el pais seleccionado 
 * @param {Object} idPais
 */	
 function cargarComboCiudades(idPais){
  	
  	$.ajax({
    type : "POST",
    async: true,
    dataType: 'json',
    url : $("#baseUrl").val()+"util/CargarCombos.php",
    data : {
      llamadoAjax : "true",
      opcion : "cargarCombo",
      tabla : "CIUDAD",
      idPais : idPais
    }
  }).done(function(data) {
      var html = "";
      html +=  '<option value="">Seleccione...</option>';

      var selected = "";
      
      $.each(data, function (index, item) 
      {
          html += '<option value='+item.ID_CIUDAD+'>'+item.NOM_CIUDAD+'</option>';
      });

      $("#cbxCiudad").append(html);   
  });
  
}

