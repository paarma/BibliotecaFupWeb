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
      <article class="breadcrumbs"><a href="../../inicio.php">Inicio</a> <div class="breadcrumb_divider"></div> <a class="current">Mis Libros</a></article>
    </div>
  </section><!-- end of secondary bar -->
  
<?php include_once BASEPATH.'application/menuUser.php'; ?>
  
  <script type="text/javascript" src="<?php echo BASEURL;?>application/libro/views/js/misLibros.js"></script>
    
  <section id="main" class="column">
    
    <article class="module width_full">
      <header><h3>Listado de Mis Libros</h3></header>
        <div class="module_content">
          
		  <form id="formListarlibros" method="post" action="">

              <table id="tblListaMisLibros" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
              <thead>
                <tr>
                  <th>T&iacute;tulo</th>
                  <th>ISBN</th>
                  <th style="width: 20%;">Cod. topografico</th>
                  <th style="width: 20%;">Editorial</th>
                  <th style="width: 10%;">Detalles</th>
                </tr>
              </thead>
            </table>
            <br>
            
          <!-- Panel detalle libro -->
          <div id="panelDetalleLibro" align="center">
          	<h3>Detalle Libro</h3>
          
          <hr />   			
			<table id="tblDetalleLibro" width="80%" border="0">
              <tr>
                <td>
                  T&iacute;tulo:
                </td>
                <td>
                  <input type="text" id="tbxTitulo" name="tbxTitulo" class="textoMayusculas" disabled="true" />
                </td>
                
                <td>
                  ISBN:
                </td>
                <td>
                  <input type="text" id="tbxIsbn" name="tbxIsbn" class="textoMayusculas" disabled="true" />
                </td>
              </tr>
              
              <tr>
                <td>
                  Cod. Topografico:
                </td>
                <td>
                  <input type="text" id="tbxCodTopografico" name="tbxCodTopografico" class="textoMayusculas" disabled="true" />
                </td>
                
                <td>
                  Temas:
                </td>
                <td>
                  <input type="text" id="tbxTemas" name="tbxTemas" class="textoMayusculas" disabled="true" />
                </td>
              </tr>
              
              <tr>
                <td>
                  Paginas:
                </td>
                <td>
                  <input type="text" id="tbxPaginas" name="tbxPaginas" disabled="true" />
                </td>
                
                <td>
                  Valor:
                </td>
                <td>
                  <input type="text" id="tbxValor" name="tbxValor" disabled="true" />
                </td>
              </tr>
              
              <tr>
                <td>
                  Editorial:
                </td>
                <td>
				  <input type="text" id="tbxEditorial" name="tbxEditorial" disabled="true" />
                </td>
                
                <td>
                  &Aacute;rea:
                </td>
                <td>
                  <input type="text" id="tbxArea" name="tbxArea" disabled="true" />
                </td>
              </tr>
              
              <tr>
              	
              	<td>
                  Pais:
                </td>
                <td>
                  <input type="text" id="tbxPais" name="tbxPais" disabled="true" />
                </td>
              	
                <td>
                  Ciudad:
                </td>
                <td>
                  <input type="text" id="tbxCiudad" name="tbxCiudad" disabled="true" />
                </td>
                
              </tr>
              
              <tr>
                <td>
                  Estado Libro:
                </td>
                <td>
                  <input type="text" id="tbxEstadoLibro" name="tbxEstadoLibro" disabled="true" />
                </td>
                
                 <td>
                  A&ntilde;o:
                </td>
                <td>
                  <input type="text" id="tbxAnio" name="tbxAnio" disabled="true" />
                </td>
                
              </tr>
         	</table>
         	
         	<br>
			<h3>DATOS SOLICITUD</h3>
			<hr />
         	
            <table width="80%" border="0">  
              <tr>                
                 <td style="width: 20%;">
                  Fecha Reserva:
                </td>
                <td>
                  <input type="text" id="tbxFechaReserva" name="tbxFechaReserva" disabled="true" />
                </td>
                
                <td style="width: 15%;">
                  Fecha Devoluci&oacute;n:
                </td>
                <td>
                  <input type="text" id="tbxFechaDevolucion" name="tbxFechaDevolucion" disabled="true" />
                </td>
              </tr>
              
              <tr>
              	<td>
                  Estado Reserva:
                </td>
                <td>
                  <input type="text" id="tbxEstadoReserva" name="tbxEstadoReserva" disabled="true" />
                </td>
              </tr>
              
			</table>
			
		  </div>
		  <!-- Fin panel detalle libro -->	
            
          </form>

          <br />
          <div id="msgValidacion" class="bad"></div>

          
        </div>
    </article><!-- end of styles article -->
    <div class="spacer"></div>
  </section>

<?php include_once '../../layouts/footer.php';?>