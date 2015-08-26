$(document).ready(function(){

    //Campos solo letras
    $('.soloLetras').keypress(function(key) { //tecla
    //if((tecla.charCode < 97 || tecla.charCode > 122) && (tecla.charCode < 65 || tecla.charCode > 90)) return false;

     window.console.log(key.charCode)
                if ((key.charCode < 97 || key.charCode > 122)//letras mayusculas
                    && (key.charCode < 65 || key.charCode > 90) //letras minusculas
                    && (key.charCode != 45) //retroceso
                    && (key.charCode != 241) //ñ
                     && (key.charCode != 209) //Ñ
                     && (key.charCode != 32) //espacio
                     && (key.charCode != 225) //á
                     && (key.charCode != 233) //é
                     && (key.charCode != 237) //í
                     && (key.charCode != 243) //ó
                     && (key.charCode != 250) //ú
                     && (key.charCode != 193) //Á
                     && (key.charCode != 201) //É
                     && (key.charCode != 205) //Í
                     && (key.charCode != 211) //Ó
                     && (key.charCode != 218) //Ú
                     && (key.charCode != 0) //Borrar
     
                    )
                    return false;

  });
  
  
    // Formato datepiker
   $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy/mm/dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
  
  
  /**
   *Funcionalidades para limpiar variables se session segun opcion de menu seleccionada 
   */
  $("#menuCrearLibroAdmin").click(function(){
  	inicializarVariablesSession();
  });
  
  $("#menuLibrosAdmin").click(function(){
  	inicializarVariablesSession();
  });
  
  $("#menuBuscarLibroAdmin").click(function(){
  	inicializarVariablesSession();
  });
  
  $("#menuUsuariosAdmin").click(function(){
  	inicializarVariablesSession();
  });
  
  $("#menuAutores").click(function(){
  	inicializarVariablesSession();
  });
  
  $("#menuEditoriales").click(function(){
  	inicializarVariablesSession();
  });
  
  $("#menuSolicitudes").click(function(){
  	inicializarVariablesSession();
  });
  
  $("#menuReservarUser").click(function(){
  	inicializarVariablesSession();
  });
  
  $("#menuMisLibros").click(function(){
  	inicializarVariablesSession();
  });

});

//Funcion encargada de eliminar una fina de una tabla
function eliminarFila(fila) {
	$(fila).parent().remove();
}

//Funcion encargada de inicializar variables de sesion
function inicializarVariablesSession(){
	
	$.ajax({
    type : "POST",
    async: false,
    url : $("#baseUrl").val()+"util/ControllerGeneral.php",
    data : {
      llamadoAjax : "true",
      opcion : "inicializarVariablesSession"
    }
  }).done(function(data) {

  });
  	  
}
