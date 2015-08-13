$(document).ready(function() {
  
  $("#msgValidacion").text("");
  $("#msgValidacion").hide();
    
  
  //Dialog agregarAutor
  $("#dialogAddAutor").dialog({
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
          
          if($("#cbxAutor").val() != ""){
          	agregarAutor();
          }
          
          $( this ).dialog( "close" );
        },
        Cancelar: function() {
          $( this ).dialog( "close" );
        }
      }
    });
    
    //Agregar Autor
    $("#addAutor" ).click(function() {
      $("#dialogAddAutor" ).dialog( "open" );
    });
  
  inicializar();
  
    
  ////////////////////////Guardar libro     
  $("#btnGuardarLibro").click(function(){
  	validarGuardar();		
  });	
  //////////////////////////Fin guardar libro. 
  
  //Cargar combos
  cargarCombos('EDITORIAL','cbxEditorial');
  cargarCombos('AREA','cbxArea');
  cargarCombos('SEDE','cbxSede');
  cargarCombos('PAIS','cbxPais');
  cargarCombos('AUTOR','cbxAutor');
  
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
 *Funcion encargada de inicialiar variables 
 */
function inicializar(){
	$("#arrayAutores").val('');
	
	//Si esta en la pantalla de ListarLibros
	if ($('#tblListaLibros').length){
		//Listar Libros
		buscarLibros();
	}

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

/**
 *Funcion encargada de agregar el autor seleccionado al libro 
 */
function agregarAutor(){
  
  var idAutor = $("#cbxAutor").find("option:selected").val();
  var nombreAutor = $("#cbxAutor").find("option:selected").text();
  	
  var fila=''; 
  
  fila += '<tr>';
  fila += '<td style="display: none;"><input type="hidden" name="idAutor" value="'+idAutor+'"/></td>';
  fila += '<td>&#8226;'+nombreAutor+'</td>';
  fila += '<td style="cursor:pointer; width: 7%;" onclick="eliminarFila(this)" ><img style="cursor:pointer" src="../../../public/images/icn_trash.png" title="Eliminar"></td>';
  fila += '</tr>';
  
  $("#tblAutores").append(fila);
	
}

/**
 *Funcion encargada de validar los datos y posterior guardado 
 */
function validarGuardar(){
	
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
		cargarAutores();
	  $("#msgValidacion").text("");
	  $("#msgValidacion").hide();
	  $("#formAddLibro").submit();
	}
}


/**
 *Funcion encargada de cargar los idAutores asociados 
 */
function cargarAutores(){
	
	var arrayAutoresCargados = new Array();
	$('#tblAutores tr').each(function(i) {

		var idAutor = $(this).find("input").eq(0).val();;
		arrayAutoresCargados.push(idAutor);
	});

	$("#arrayAutores").val(arrayAutoresCargados);	
}

/**
 *Funcion encargada de listar los libros 
 */
function buscarLibros(){

  $.ajax({
    type : "POST",
    async: true,
    url : "../../../util/ControllerGeneral.php",
    data : {
      llamadoAjax : "true",
      opcion : "listadoLibros"
    }
  }).done(function(data) {
  	
	
    
  });

}

