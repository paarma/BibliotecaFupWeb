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
    
    ////////////Si esta en la interfaz de ListarLibros
	if ($('#tblListaLibros').length){
		$("#panelDetalleLibro").hide();
	}
    
    //Agregar Autor
    $("#addAutor" ).click(function() {
      $("#dialogAddAutor" ).dialog( "open" );
    });
  
  inicializar();
  cargarDatosLibroSeleccionado();
  
    
  ////////////////////////Guardar libro     
  $("#btnGuardarLibro").click(function(){
  	validarGuardar();		
  });	
  //////////////////////////Fin guardar libro. 
  
  
  //Cargar cbx Ciudades segun pais
  $("#cbxPais").change(function(){
  	
  	//Se limpia el combo Ciudades y se recarga
  	$("#cbxCiudad option").remove();
  	if(this.value != ""){
  		cargarComboCiudades(this.value);
  	}
  
  });
  
  
  //Boton buscar libro
  $("#btnBuscarLibro").click(function(){
  	buscarLibro();
  });
  
    
});


/**
 *Funcion encargada de inicialiar variables 
 */
function inicializar(){
	
	//inicializar variables
	$("#arrayAutores").val('');
	$("#idLibro").val(0);
	$("#isbnOriginal").val('');
	$("#codTopograficoOriginal").val('');
	
	  //Cargar combos
	  cargarCombos('EDITORIAL','cbxEditorial');
	  cargarCombos('AREA','cbxArea');
	  cargarCombos('SEDE','cbxSede');
	  cargarCombos('PAIS','cbxPais');
	  cargarCombos('AUTOR','cbxAutor');
	
	////////////Si esta en la interfaz de ListarLibros
	if ($('#tblListaLibros').length){
		//Listar Libros
		buscarLibros();
		$("#panelDetalleLibro").hide();
	}
	
	///////////Si esta en la interfaz de buscarLibro
	//Se inicializa el formulario
	if($("#formSearchLibro").length){
		$("#formSearchLibro")[0].reset();
	}

}

/**
 *Funcion encargada de verificar si existe un libro seleccionado por el admin
 * y posterior carga de datos del mismo.
 */
function cargarDatosLibroSeleccionado(){
	
  $.ajax({
    type : "POST",
    async: false,
    dataType: 'json',
    url : "../controllers/LibroController.php",
    data : {
      llamadoAjax : "true",
      opcion : "cargarDatosLibroSeleccionado"
    }
  }).done(function(data) {
  	
	if(data != null){
		
		//idLibro
		$("#idLibro").val(data.idLibro);
		$("#isbnOriginal").val(data.isbn);
		$("#codTopograficoOriginal").val(data.codigoTopografico);
		
		$("#tbxTitulo").val(data.titulo);
		$("#tbxIsbn").val(data.isbn);
		$("#tbxCodTopografico").val(data.codigoTopografico);
		$("#tbxTemas").val(data.temas);
		$("#tbxPaginas").val(data.paginas);
		$("#tbxValor").val(data.valor);
		$("#tbxRadicado").val(data.radicado);
		$("#tbxSerie").val(data.serie);
		$("#tbxCantidad").val(data.cantidad);
		$("#tbxAnio").val(data.anio);
		
		//Combobox
		if(data.editorial != null){
			$("#cbxEditorial").val(data.editorial.idEditorial);
		}
		
		if(data.area != null){
			$("#cbxArea").val(data.area.idArea);
		}
		
		if(data.sede != null){
			$("#cbxSede").val(data.sede.idSede);
		}
		
		//Pais/Ciudad. //Si existe Ciudad, se carga el combo Ciudades con la respectiva ciudad del libro.
		if(data.ciudad != null){
			cargarComboCiudades(data.ciudad.pais.idPais);
			
			$("#cbxPais").val(data.ciudad.pais.idPais);
			$("#cbxCiudad").val(data.ciudad.idCiudad);
		}
		
		$("#cbxAdquisicion").val(data.adquisicion);	
		$("#cbxEstado").val(data.estado);
		
		cargarAutoresAsociados(data.idLibro);			
		
	}
	
  });
	
}

/**
 *Funcion encargada de obtener los autores asociados de un determinado libro 
 */
 function cargarAutoresAsociados(idLibro){
 	
 $.ajax({
    type : "POST",
    async: false,
    dataType: 'json',
    url : "../controllers/LibroController.php",
    data : {
      llamadoAjax : "true",
      opcion : "cargarAutoresAsociados",
      idLibro : idLibro
    }
  }).done(function(data) {

	  var fila = "";
      $.each(data, function (index, item) 
      {
		var nombreAutor = item.PRIMER_NOMBRE+" "+item.SEGUNDO_NOMBRE+" "+item.PRIMER_APELLIDO+" "+item.SEGUNDO_APELLIDO;
		  
		fila += '<tr>';
		fila += '<td style="display: none;"><input type="hidden" name="idAutor" value="'+item.ID_AUTOR+'"/></td>';
		fila += '<td>&#8226;'+nombreAutor+'</td>';
		fila += '<td style="cursor:pointer; width: 7%;" onclick="eliminarFila(this)" ><img style="cursor:pointer" src="../../../public/images/icn_trash.png" title="Eliminar"></td>';
		fila += '</tr>';
      });
			  
	  $("#tblAutores").append(fila);	
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
 * Funcion encargada de cargar el combo ciudades segun el pais seleccionado 
 * @param {Object} idPais
 */	
 function cargarComboCiudades(idPais){
  	
  	$.ajax({
    type : "POST",
    async: false,
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
	
	 /**
	 * Si esta creando un nuevo libro
	 */
	if($("#idLibro").val() == 0){
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
	}
	
	/**
	 *Si esta editando un libro 
	 */
	if($("#idLibro").val() != 0){
		//Validacion ISBN
		if($("#tbxIsbn").val().trim() != "" && $("#isbnOriginal").val() != $("#tbxIsbn").val().trim()){
		  if(verficarDatoEnBd('LIBRO','ISBN',$("#tbxIsbn").val().trim())){
		    $("#msgValidacion").text("ISBN ya registrado");
		    $("#msgValidacion").show();
		    validaciones = false;
		  }
		}
		
		//Validacion Cod.Topografico
		if($("#tbxCodTopografico").val().trim() != "" && 
			$("#codTopograficoOriginal").val() != $("#tbxCodTopografico").val().trim()){
					
		  if(verficarDatoEnBd('LIBRO','COD_TOPOGRAFICO',$("#tbxCodTopografico").val().trim())){
		    $("#msgValidacion").text("Cod Topografico ya registrado");
		    $("#msgValidacion").show();
		    validaciones = false;
		  }
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
    async: false,
    dataType: 'json',
    url : "../../../util/ControllerGeneral.php",
    data : {
      llamadoAjax : "true",
      opcion : "listadoLibros"
    }
  }).done(function(data) {
  	
  	  var html = "";
      $.each(data, function (index, item) 
      {
      	
      	html += '<tr>';
      	html += '<td>'+item.titulo+'</td>';
      	html += '<td>'+item.isbn+'</td>';
      	html += '<td>'+item.codigoTopografico+'</td>';
      	
      	if(item.editorial != null){
      		html += '<td>'+item.editorial.descripcion+'</td>';
      	}else{
      		html += '<td></td>';
      	}
      	
      	html += '<td><input type="radio" name="rbtSeleccion" value='+item.idLibro+' onClick="verDetalleLibro('+item.idLibro+')" ></td>';
      	html += '</tr>';
      	      	
      });
      
      $("#tblListaLibros").append(html);
      
      $("#tblListaLibros").dataTable({
         "bJQueryUI": true,
         "sPaginationType": "full_numbers"
      });
	
    
  });

}


/**
 *Funcion encargada de desplegar los atributos de un libro seleccionado
 * @param {Object} idLibro
 */
function verDetalleLibro(idLibro){
	
	//$("#formListarlibros")[0].reset();
	$("#panelDetalleLibro").show();

	$.ajax({
	type : "POST",
	async: false,
	dataType: 'json',
	url : "../../../util/ControllerGeneral.php",
	data : {
      llamadoAjax : "true",
      opcion : "verDetalleLibroAdmin",
      idLibro: idLibro
    }
  }).done(function(data) {	
  	
  	if(data != null){
		
		$("#tbxTitulo").val(data.titulo);
		$("#tbxIsbn").val(data.isbn);
		$("#tbxCodTopografico").val(data.codigoTopografico);
		$("#tbxTemas").val(data.temas);
		$("#tbxPaginas").val(data.paginas);
		$("#tbxValor").val(data.valor);
		$("#tbxRadicado").val(data.radicado);
		$("#tbxSerie").val(data.serie);
		$("#tbxCantidad").val(data.cantidad);
		$("#tbxAnio").val(data.anio);
		
		if(data.editorial != null){
			$("#tbxEditorial").val(data.editorial.descripcion);
		}else{
			$("#tbxEditorial").val('');
		}
		
		if(data.area != null){
			$("#tbxArea").val(data.area.descripcion);
		}else{
			$("#tbxArea").val('');
		}
		
		if(data.sede != null){
			$("#tbxSede").val(data.sede.descripcion);
		}else{
			$("#tbxSede").val('');
		}
		
		
		//Pais/Ciudad.
		if(data.ciudad != null){
			
			$("#tbxPais").val(data.ciudad.pais.nombre);
			$("#tbxCiudad").val(data.ciudad.nombre);
		}else{
			
			$("#tbxPais").val('');
			$("#tbxCiudad").val('');
		}
		
		$("#tbxAdquisicion").val(data.adquisicion);	
		$("#tbxEstado").val(data.estado);			
		
	}
  	
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


