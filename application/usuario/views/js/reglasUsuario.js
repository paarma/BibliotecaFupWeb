$(document).ready(function() {

  $("#tbxCedula").numeric();
  $("#tbxTelefono").numeric();
  $("#tbxCodigo").numeric();
  
  // Agregar Libro
  $("#formAddUsuario").validate({
    rules: {
      tbxCedula: { required: true, minlength: 3},
      tbxPrimerNombre: {required: true},
      tbxPrimerApellido: { required: true},
      tbxCodigo: { required: true},
      tbxClave: { required: true},
      tbxEmail: {email: true},
      cbxRol: { required: true},
      /*telefono: { minlength: 2, maxlength: 15},
      mensaje: { required:true, minlength: 2},*/
    },
    messages: {
      /*tbxPrimerNombre: {"El campo es obligatorio."},
      tbxPrimerApellido: "El campo es obligatorio.",
      tbxNoIdentificacion: "El campo es obligatorio.",*/
      
      /*email : "El campo es obligatorio y debe tener formato de email correcto.",
      telefono : "El campo Tel&eacute;fono no contiene un formato correcto.",
      mensaje : "El campo Mensaje es obligatorio",*/
    }
  });
  
  
});