$(document).ready(function() {
  
  $("#msgValidacion").text("");
  $("#msgValidacion").hide();
  
  
  $("#tbxFechaReserva").datepicker({
	changeMonth : true,
	changeYear : false
  });
  
  
   //Reservar
  $("#formListarlibros").validate({
    rules: {
      tbxFechaReserva: { required: true},
    }
  });
  
  
  ////////////Si esta en la interfaz de ListarLibros
  if ($('#tblListaLibros').length){
	$("#panelDetalleLibro").hide();
  } 
	
  inicializar(); 
  
});


/**
 *Funcion encargada de inicialiar variables 
 */
function inicializar(){
	
	$("#idLibro").val(0);
	
	////////////Si esta en la interfaz de ListarLibros
	if ($('#tblListaLibros').length){
		//Listar Libros
		listarLibros();
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
function listarLibros(){

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
	$("#tbxFechaReserva").val('');
	$("#btnReservar").hide();
	$("#idLibro").val(0);

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
		
		$("#idLibro").val(data.idLibro);
		
		$("#tbxTitulo").val(data.titulo);
		$("#tbxIsbn").val(data.isbn);
		$("#tbxCodTopografico").val(data.codigoTopografico);
		$("#tbxTemas").val(data.temas);
		$("#tbxPaginas").val(data.paginas);
		$("#tbxValor").val(data.valor);
		
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
		
		
		//Pais/Ciudad.
		if(data.ciudad != null){
			
			$("#tbxPais").val(data.ciudad.pais.nombre);
			$("#tbxCiudad").val(data.ciudad.nombre);
		}else{
			
			$("#tbxPais").val('');
			$("#tbxCiudad").val('');
		}
		
		$("#tbxEstado").val(data.estado);
		$("#tbxAnio").val(data.anio);
		
		//Se verifica la disponibilidad segun la cantidad de copias del libro
        if(data.cantidad > 0){
            $("#tbxDisponiblidad").val("SI");
            $("#tbxFechaReserva").removeAttr('disabled'); //Se remueve el atributo
            $("#btnReservar").show();
        }else{
            $("#tbxDisponiblidad").val("NO");
            $("#tbxFechaReserva").attr('disabled',true); //Se agrega el atributo
            $("#btnReservar").hide();
        }
        
        
        //Autores Asociados
		cargarAutoresAsociadosVista(idLibro);
        
	}
  	
  });

}


 /**
 *Funcion encargada de obtener los autores asociados de un determinado libro 
 *Establecida para el caso de ver los detalles de un libro (no edicion)
 */
 function cargarAutoresAsociadosVista(idLibro){
 	
 	//Se limpia la tabla
 	$("#tblAutores tr").remove();
 	
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
		fila += '<td>&#8226;'+nombreAutor+'</td>';
		fila += '</tr>';
      });
			  
	  $("#tblAutores").append(fila);	
  });  	
  	
 }


