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
      <article class="breadcrumbs"><a href="../../inicio.php">Inicio</a> <div class="breadcrumb_divider"></div> <a class="current">Buscar Libro</a></article>
    </div>
  </section><!-- end of secondary bar -->
  
<?php include_once BASEPATH.'application/menuAdmin.php'; ?>
  
  <script type="text/javascript" src="<?php echo BASEURL;?>application/libro/views/js/reglasLibro.js"></script>
  <script type="text/javascript" src="<?php echo BASEURL;?>application/libro/views/js/libro.js"></script>
    
  <section id="main" class="column">
    
    <article class="module width_full">
      <header><h3>Informaci&oacute;n de B&uacute;squeda</h3></header>
        <div class="module_content">
          
          <form id="formSearchLibro" method="post" action="../views/listaLibrosAdmin.php">
            
            <table>
              <tr>
                <td>
                  T&iacute;tulo:
                </td>
                <td>
                  <input type="text" id="tbxTitulo" name="tbxTitulo" class="textoMayusculas" />
                </td>
              </tr>
              
               <tr>
                <td>
                  ISBN:
                </td>
                <td>
                  <input type="text" id="tbxIsbn" name="tbxIsbn" class="textoMayusculas" />
                </td>
              </tr>
              
              <tr>
                <td>
                  Cod. Topografico:
                </td>
                <td>
                  <input type="text" id="tbxCodTopografico" name="tbxCodTopografico" class="textoMayusculas" />
                </td>
              </tr>
              
               <tr>
                <td>
                  Temas:
                </td>
                <td>
                  <input type="text" id="tbxTemas" name="tbxTemas" class="textoMayusculas" />
                </td>
              </tr>
              
             <tr>
                <td>
                  Editorial:
                </td>
                <td>
                  <select id="cbxEditorial" name="cbxEditorial">
                  </select>
                </td>
              </tr>
              
             <tr>
                <td>
                  Autor:
                </td>
                <td>
                  <select id="cbxAutor" name="cbxAutor">
                  </select>
                </td>
              </tr>
              
            </table>
            <br />
            <input type="button" id="btnBuscarLibro" name="btnBuscarLibro" value="Buscar" />
          </form>
          
          <br />
          
        </div>
    </article><!-- end of styles article -->
    <div class="spacer"></div>
  </section>

<?php include_once '../../layouts/footer.php';?>