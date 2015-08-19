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
      <article class="breadcrumbs"><a href="../../inicio.php">Inicio</a> <div class="breadcrumb_divider"></div> <a class="current">Buscar Usuario</a></article>
    </div>
  </section><!-- end of secondary bar -->
  
<?php include_once BASEPATH.'application/menuAdmin.php'; ?>
  
  <script type="text/javascript" src="<?php echo BASEURL;?>application/usuario/views/js/reglasUsuario.js"></script>
  <script type="text/javascript" src="<?php echo BASEURL;?>application/usuario/views/js/usuario.js"></script>
    
  <section id="main" class="column">
    
    <article class="module width_full">
      <header><h3>Informaci&oacute;n de B&uacute;squeda</h3></header>
        <div class="module_content">
          
          <form id="formSearchUsuario" method="post" action="../views/listaUsuarios.php">
            
            <table>
              <tr>
                <td>
                  Cedula:
                </td>
                <td>
                  <input type="text" id="tbxCedula" name="tbxCedula" />
                </td>
              </tr>
              
               <tr>
                <td>
                  Primer Nombre:
                </td>
                <td>
                  <input type="text" id="tbxPrimerNombre" name="tbxPrimerNombre" class="soloLetras textoMayusculas" />
                </td>
              </tr>
              
              <tr>
                <td>
                  Segundo Nombre:
                </td>
                <td>
                  <input type="text" id="tbxSegundoNombre" name="tbxSegundoNombre" class="soloLetras textoMayusculas" />
                </td>
              </tr>
              
               <tr>
                <td>
                  Primer Apellido:
                </td>
                <td>
                  <input type="text" id="tbxPrimerApellido" name="tbxPrimerApellido" class="soloLetras textoMayusculas" />
                </td>
              </tr>
              
              <tr>
                <td>
                  Segundo Apellido:
                </td>
                <td>
                  <input type="text" id="tbxSegundoApellido" name="tbxSegundoApellido" class="soloLetras textoMayusculas" />
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
            <input type="button" id="btnBuscarUsuario" name="btnBuscarUsuario" value="Buscar" />
          </form>
          
          <br />
          
        </div>
    </article><!-- end of styles article -->
    <div class="spacer"></div>
  </section>

<?php include_once '../../layouts/footer.php';?>