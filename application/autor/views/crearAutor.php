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
      <article class="breadcrumbs"><a href="../../inicio.php">Inicio</a> <div class="breadcrumb_divider"></div> <a class="current">Guardar Autor</a></article>
    </div>
  </section><!-- end of secondary bar -->
  
<?php include_once BASEPATH.'application/menuAdmin.php'; ?>
  
  <script type="text/javascript" src="<?php echo BASEURL;?>application/autor/views/js/reglasAutor.js"></script>
  <script type="text/javascript" src="<?php echo BASEURL;?>application/autor/views/js/autor.js"></script>
    
  <section id="main" class="column">
    
    <article class="module width_full">
      <header><h3>Informaci&oacute;n del Autor</h3></header>
        <div class="module_content">
          
          <form id="formAddAutor" method="post" action="../controllers/AutorController.php">
            <input type="hidden" id="accionFormAutor" name="accionFormAutor" value="guardar">
            
            <table>
               <tr>
                <td>
                  Primer Nombre: *
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
                  Primer Apellido: *
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
                  Tipo Autor:
                </td>
                <td>
                  <select id="cbxTipoAutor" name="cbxTipoAutor">
                  	<option value="">Seleccione...</option>
                  	<option value="PERSONAL">PERSONAL</option>
                  	<option value="INSTITUCIONAL">INSTITUCIONAL</option>
                  	<option value="CORPORATIVO">CORPORATIVO</option>
                  </select>
                </td>
              </tr>
              
            </table>
            <br />
            <input type="submit" id="btnGuardarAutor" name="btnGuardarAutor" value="Aceptar" />
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