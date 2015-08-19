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
      <article class="breadcrumbs"><a href="../../inicio.php">Inicio</a> <div class="breadcrumb_divider"></div> <a class="current">Guardar Editorial</a></article>
    </div>
  </section><!-- end of secondary bar -->
  
<?php include_once BASEPATH.'application/menuAdmin.php'; ?>
  
  <script type="text/javascript" src="<?php echo BASEURL;?>application/editorial/views/js/editorial.js"></script>
    
  <section id="main" class="column">
    
    <article class="module width_full">
      <header><h3>Informaci&oacute;n de Editorial</h3></header>
        <div class="module_content">
          
          <form id="formAddEditorial" method="post" action="../controllers/EditorialController.php">
            <input type="hidden" id="accionFormEditorial" name="accionFormEditorial" value="guardar">
            
            <!-- Validacion datos editar-->
            <input type="hidden" id="idEditorial" name="idEditorial" value="0">
            <input type="hidden" id="descripcionOriginal" name="descripcionOriginal" value="">
            
            <table>
              
               <tr>
                <td>
                  Editorial: *
                </td>
                <td>
                  <input type="text" id="tbxEditorial" name="tbxEditorial" class="textoMayusculas" />
                </td>
              </tr>
              
            </table>
            <br />
            <input type="button" id="btnGuardarEditorial" name="btnGuardarEditorial" value="Aceptar" />
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