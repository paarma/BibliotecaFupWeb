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
      <article class="breadcrumbs"><a href="inicio.php">Inicio</a> <div class="breadcrumb_divider"></div> <a class="current">Crear Libro</a></article>
    </div>
  </section><!-- end of secondary bar -->
  
<?php include_once BASEPATH.'application/menuAdmin.php'; ?>
  
  <script type="text/javascript" src="<?php echo BASEURL;?>application/libro/views/js/reglasLibro.js"></script>
  <script type="text/javascript" src="<?php echo BASEURL;?>application/libro/views/js/libro.js"></script>
    
  <section id="main" class="column">
    
    <article class="module width_full">
      <header><h3>Informaci&oacute;n del Libro</h3></header>
        <div class="module_content">
          
          <form id="formAddLibro" method="post" action="../controllers/LibroController.php">
            <input type="hidden" id="accionFormLibro" name="accionFormLibro" value="guardar">
            
            <table>
              <tr>
                <td>
                  T&iacute;tulo: *
                </td>
                <td>
                  <input type="text" id="tbxTitulo" name="tbxTitulo" class="textoMayusculas" />
                </td>
              </tr>
              
               <tr>
                <td>
                  ISBN: *
                </td>
                <td>
                  <input type="text" id="tbxIsbn" name="tbxIsbn" class="textoMayusculas" />
                </td>
              </tr>
              
              <tr>
                <td>
                  Cod. Topografico: *
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
                  Paginas:
                </td>
                <td>
                  <input type="text" id="tbxPaginas" name="tbxPaginas" />
                </td>
              </tr>
              
             <tr>
                <td>
                  Valor:
                </td>
                <td>
                  <input type="text" id="tbxValor" name="tbxValor" />
                </td>
              </tr>
              
              <tr>
                <td>
                  Radicado:
                </td>
                <td>
                  <input type="text" id="tbxRadicado" name="tbxRadicado" />
                </td>
              </tr>
              
              <tr>
                <td>
                  Serie:
                </td>
                <td>
                  <input type="text" id="tbxSerie" name="tbxSerie" />
                </td>
              </tr>
              
              <tr>
                <td>
                  Cantidad:
                </td>
                <td>
                  <input type="text" id="tbxCantidad" name="tbxCantidad" />
                </td>
              </tr>
              
             <tr>
                <td>
                  A&ntilde;o:
                </td>
                <td>
                  <input type="text" id="tbxAnio" name="tbxAnio" />
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
                  &Aacute;rea:
                </td>
                <td>
                  <select id="cbxArea" name="cbxArea">
                  </select>
                </td>
              </tr>
              
              <tr>
                <td>
                  Sede:
                </td>
                <td>
                  <select id="cbxSede" name="cbxSede">
                  </select>
                </td>
              </tr>
              
              <tr>
                <td>
                  Pais:
                </td>
                <td>
                  <select id="cbxPais" name="cbxPais">
                  </select>
                </td>
              </tr>
              
              <tr>
                <td>
                  Ciudad:
                </td>
                <td>
                  <select id="cbxCiudad" name="cbxCiudad">
                  </select>
                </td>
              </tr>
              
              <tr>
                <td>
                  Adquisici&oacute;n:
                </td>
                <td>
                  <select id="cbxAdquisicion" name="cbxAdquisicion">
                  </select>
                </td>
              </tr>
              
              <tr>
                <td>
                  Estado:
                </td>
                <td>
                  <select id="cbxEstado" name="cbxEstado">
                  </select>
                </td>
              </tr>
              
            </table>
            <br />
            <input type="button" id="btnGuardarLibro" name="btnGuardarLibro" value="Aceptar" />
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