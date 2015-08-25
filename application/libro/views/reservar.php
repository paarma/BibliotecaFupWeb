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
      <article class="breadcrumbs"><a href="../../inicio.php">Inicio</a> <div class="breadcrumb_divider"></div> <a class="current">Reservar</a></article>
    </div>
  </section><!-- end of secondary bar -->
  
<?php include_once BASEPATH.'application/menuUser.php'; ?>
  
  <script type="text/javascript" src="<?php echo BASEURL;?>application/libro/views/js/reservar.js"></script>
    
  <section id="main" class="column">
    
    <article class="module width_full">
      <header><h3>Listado de Libros</h3></header>
        <div class="module_content">
          
		  <form id="formListarlibros" method="post" action="../../solicitud/controllers/SolicitudController.php">
		  	  <input type="hidden" id="accionFormReservar" name="accionFormReservar" value="reservar">
		  	  <input type="hidden" id="idLibro" name="idLibro" value="0">

              <table id="tblListaLibros" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
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
			<table id="tblDetalleLibro" width="90%" border="0">
              <tr>
                <td style="width: 20%;">
                  T&iacute;tulo:
                </td>
                <td style="width: 30%;">
                  <input type="text" id="tbxTitulo" name="tbxTitulo" class="textoMayusculas" disabled="true" />
                </td>
                
                <td style="width: 10%;">
                  ISBN:
                </td>
                <td style="width: 40%;">
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
                  Estado:
                </td>
                <td>
                  <input type="text" id="tbxEstado" name="tbxEstado" disabled="true" />
                </td>
                
                 <td>
                  A&ntilde;o:
                </td>
                <td>
                  <input type="text" id="tbxAnio" name="tbxAnio" disabled="true" />
                </td>
                
              </tr>
              
              <tr>
              	<td>
              		&nbsp;
              	</td>
              </tr>
              
              <tr>
                <td>
                  Disponibilidad:
                </td>
                <td>
                  <input type="text" id="tbxDisponiblidad" name="tbxDisponiblidad" disabled="true" />
                </td>
                
                 <td>
                  Fecha Reserva:
                </td>
                <td>
                  <input type="text" id="tbxFechaReserva" name="tbxFechaReserva" disabled="true" />
                </td>
                
              </tr>
              
			</table>
			
			<br>
			
			<div>
				<input type="submit" id="btnReservar" name="btnReservar" value="Reservar" />	
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