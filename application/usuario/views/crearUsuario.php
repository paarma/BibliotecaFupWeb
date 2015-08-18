<?php

include_once '../../layouts/header.php';

if(!isset($_SESSION['usuarioLogueado']))
{
	header('location:'.BASEURL.'index.php');
	exit();
}

?>

  <section id="secondary_bar">
    <div class="user">
      <?php include_once BASEPATH.'application/tabUsuario.php'; ?>
      <!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
    </div>
    <div class="breadcrumbs_container">
      <article class="breadcrumbs"><a href="../../inicio.php">Inicio</a> <div class="breadcrumb_divider"></div> <a class="current">Guardar Usuario</a></article>
    </div>
  </section><!-- end of secondary bar -->
  
<?php include_once BASEPATH.'application/menuAdmin.php'; ?>
  
  <script type="text/javascript" src="<?php echo BASEURL;?>application/usuario/views/js/reglasUsuario.js"></script>
  <script type="text/javascript" src="<?php echo BASEURL;?>application/usuario/views/js/usuario.js"></script>
    
  <section id="main" class="column">
    
    <article class="module width_full">
      <header><h3>Informaci&oacute;n del Usuario</h3></header>
        <div class="module_content">
          
          <form id="formAddUsuario" method="post" action="../controllers/UsuarioController.php">
            <input type="hidden" id="accionFormUsuario" name="accionFormUsuario" value="guardar">
            
            <!-- Validacion datos editar-->
            <input type="hidden" id="idUsuario" name="idUsuario" value="0">
            <input type="hidden" id="cedulaOriginal" name="cedulaOriginal" value="">
            <input type="hidden" id="emailOriginal" name="emailOriginal" value="">
            <input type="hidden" id="codigoOriginal" name="codigoOriginal" value="">
            
            <table>
              <tr>
                <td>
                  Cedula: *
                </td>
                <td>
                  <input type="text" id="tbxCedula" name="tbxCedula" />
                </td>
              </tr>
              
               <tr>
                <td>
                  Primer Nombre: *
                </td>
                <td>
                  <input type="text" id="tbxPrimerNombre" name="tbxPrimerNombre" class="textoMayusculas" />
                </td>
              </tr>
              
              <tr>
                <td>
                  Segundo Nombre:
                </td>
                <td>
                  <input type="text" id="tbxSegundoNombre" name="tbxSegundoNombre" class="textoMayusculas" />
                </td>
              </tr>
              
               <tr>
                <td>
                  Primer Apellido : *
                </td>
                <td>
                  <input type="text" id="tbxPrimerApellido" name="tbxPrimerApellido" class="textoMayusculas" />
                </td>
              </tr>
              
              <tr>
                <td>
                  Segundo Apellido:
                </td>
                <td>
                  <input type="text" id="tbxSegundoApellido" name="tbxSegundoApellido" class="textoMayusculas" />
                </td>
              </tr>
              
             <tr>
                <td>
                  Tel&eacute;fono:
                </td>
                <td>
                  <input type="text" id="tbxTelefono" name="tbxTelefono" />
                </td>
              </tr>
              
              <tr>
                <td>
                  Direcci&oacute;n:
                </td>
                <td>
                  <input type="text" id="tbxDireccion" name="tbxDireccion" class="textoMayusculas" />
                </td>
              </tr>
              
              <tr>
                <td>
                  Email:
                </td>
                <td>
                  <input type="text" id="tbxEmail" name="tbxEmail" />
                </td>
              </tr>
              
              <tr>
                <td>
                  C&oacute;digo: *
                </td>
                <td>
                  <input type="text" id="tbxCodigo" name="tbxCodigo" />
                </td>
              </tr>
              
             <tr>
                <td>
                  Clave:
                </td>
                <td>
                  <input type="text" id="tbxClave" name="tbxClave" />
                </td>
              </tr>
              
             <tr>
                <td>
                  Rol:
                </td>
                <td>
                  <select id="cbxRol" name="cbxRol">
                  	<option value="">Seleccione...</option>
                  	<option value="ADMINISTRADOR">ADMINISTRADOR</option>
                  	<option value="USUARIO">USUARIO</option>
                  </select>
                </td>
              </tr>
              
            </table>
            <br />
            <input type="button" id="btnGuardarUsuario" name="btnGuardarUsuario" value="Aceptar" />
          </form>          
          
          <br />
          <div id="msgValidacion" class="bad"></div>
          
         <?php if (isset($_GET['m']) && $_GET['m'] == '1'): ?>
                  <div class="bad" >Error! Hay campos obligatorios que se encuentran vacios...</div>
         <?php elseif (isset($_GET['m']) && $_GET['m'] == '2'): ?>
                  <div class="bad">Error almacenando la información, intenta enviar los datos nuevamente...</div>   
         <?php elseif (isset($_GET['m']) && $_GET['m'] == '3'): ?>
                  <div class="good">La información se almaceno exitosamente</div>          
        <?php endif; ?>
          
        </div>
    </article><!-- end of styles article -->
    <div class="spacer"></div>
  </section>

<?php include_once '../../layouts/footer.php';?>