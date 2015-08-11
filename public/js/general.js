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
    
  //Cargar combos
  cargarCombos('EDITORIAL','cbxEditorial'); 
  
});

function cargarCombos(tabla,combo){
	
  $.ajax({
    type : "POST",
    async: true,
    dataType: 'json',
    url : "../../../util/CargarCombos.php",
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
        
      });

      $('#'+combo).append(html);   
  });
	
}
