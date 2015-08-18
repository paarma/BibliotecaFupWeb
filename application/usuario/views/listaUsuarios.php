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
      <article class="breadcrumbs"><a href="../../inicio.php">Inicio</a> <div class="breadcrumb_divider"></div> <a class="current">Usuarios</a></article>
    </div>
  </section><!-- end of secondary bar -->
  
<?php include_once BASEPATH.'application/menuAdmin.php'; ?>
  
  <script type="text/javascript" src="<?php echo BASEURL;?>application/usuario/views/js/reglasUsuario.js"></script>
  <script type="text/javascript" src="<?php echo BASEURL;?>application/usuario/views/js/usuario.js"></script>
    
  <section id="main" class="column">
    
    <article class="module width_full">
      <header><h3>Listado de Usuarios</h3></header>
        <div class="module_content">
          
		  <form id="formListarlibros" method="post" action="../views/crearUsuario.php">
              <table id="tblListaUsuarios" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
              <thead>
                <tr>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th style="width: 20%;">C&oacute;digo</th>
                  <th style="width: 20%;">Email</th>
                  <th style="width: 10%;">Detalles</th>
                </tr>
              </thead>
            </table>
            <br>
            
          <!-- Panel detalle usuario -->
          <div id="panelDetalleUsuario" align="center">
          	<h3>Detalle Usuario</h3>
          
          <hr />   			
			<table id="tblDetalleUsuario" width="80%" border="0">
              <tr>
                <td>
                  Cedula:
                </td>
                <td>
                  <input type="text" id="tbxCedula" name="tbxCedula" disabled="true" />
                </td>
                
                <td>
                  Tel&eacute;fono:
                </td>
                <td>
                  <input type="text" id="tbxTelefono" name="tbxTelefono" disabled="true" />
                </td>
              </tr>
              
              <tr>
                <td>
                  Primer Nombre:
                </td>
                <td>
                  <input type="text" id="tbxPrimerNombre" name="tbxPrimerNombre" class="textoMayusculas" disabled="true" />
                </td>
                
                <td>
                  Segundo Nombre:
                </td>
                <td>
                  <input type="text" id="tbxSegundoNombre" name="tbxSegundoNombre" class="textoMayusculas" disabled="true" />
                </td>
              </tr>
              
              <tr>
                <td>
                  Primer Apellido:
                </td>
                <td>
                  <input type="text" id="tbxPrimerApellido" name="tbxPrimerApellido" class="textoMayusculas" disabled="true" />
                </td>
                
                <td>
                  Segundo Apellido:
                </td>
                <td>
                  <input type="text" id="tbxSegundoApellido" name="tbxSegundoApellido" class="textoMayusculas" disabled="true" />
                </td>
              </tr>
              
              <tr>
                <td>
                  Direcci&oacute;n:
                </td>
                <td>
                  <input type="text" id="tbxDireccion" name="tbxDireccion" class="textoMayusculas" disabled="true" />
                </td>
                
                <td>
                  Email:
                </td>
                <td>
                  <input type="text" id="tbxEmail" name="tbxEmail" disabled="true" />
                </td>
              </tr>
              
              <tr>
                <td>
                  C&oacute;digo:
                </td>
                <td>
                  <input type="text" id="tbxCodigo" name="tbxCodigo" disabled="true" />
                </td>
                
                <td>
                  Clave:
                </td>
                <td>
                  <input type="text" id="tbxClave" name="tbxClave" disabled="true" />
                </td>
              </tr>
              
              <tr>
                <td>
                  Rol:
                </td>
                <td colspan="3">
				  <input type="text" id="tbxRol" name="tbxRol" disabled="true" />
                </td>
              </tr>

			</table>
			
			<br>
			
			<div>
				<input type="submit" id="btnEditarUsuario" name="btnEditarUsuario" value="Editar" />	
			</div>
			
		  </div>
		  <!-- Fin panel detalle libro -->	
            
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