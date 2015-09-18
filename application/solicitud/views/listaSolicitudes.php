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
      <article class="breadcrumbs"><a href="../../inicio.php">Inicio</a> <div class="breadcrumb_divider"></div> <a class="current">Solicitudes</a></article>
    </div>
  </section><!-- end of secondary bar -->
  
<?php include_once BASEPATH.'application/menuAdmin.php'; ?>
  
  <script type="text/javascript" src="<?php echo BASEURL;?>application/solicitud/views/js/solicitud.js"></script>
    
  <section id="main" class="column">
    
    <article class="module width_full">
      <header><h3>Listado de Solicitudes</h3></header>
        <div class="module_content">
          
		  <form id="formListarSolicitudes" method="post" action="../controllers/SolicitudController.php">
		  	<input type="hidden" id="accionFormSolicitudes" name="accionFormSolicitudes" value="guardar">
		  	
		  	<input type="hidden" id="idSolicitud" name="idSolicitud" value="0">
            <input type="hidden" id="estadoOriginal" name="estadoOriginal" value="">
            <input type="hidden" id="diasMora" name="diasMora" value="0">
		  	
              <table id="tblListaSolicitudes" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
              <thead>
                <tr>
                  <th style="width: 30%;">Libro</th>
                  <th>ISBN</th>
                  <th>Cod. Usuario</th>
                  <th style="width: 15%;">Fecha Solicitud</th>
                  <th style="width: 15%;">Estado</th>
                  <th style="width: 10%;">Detalles</th>
                </tr>
              </thead>
            </table>
            <br>
            
          <!-- Panel detalle Solicitud -->
          <div id="panelDetalleSolicitud" align="center">
          	<h3>Detalle Solicitud</h3>
          
          <hr />   			
			<table id="tblDetalleSolicitud" width="80%" border="0">
              <tr>
                <td>
                  Libro:
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
                  Editorial:
                </td>
                <td>
				  <input type="text" id="tbxEditorial" name="tbxEditorial" disabled="true" />
                </td>
                
                <td>
                  Valor:
                </td>
                <td>
                  <input type="text" id="tbxValor" name="tbxValor" disabled="true" />
                </td>
              </tr>
              
              <tr>
              	
              	<!-- Se omite la cantidad 
                <td>
                  Cantidad:
                </td>
                <td>
                  <input type="text" id="tbxCantidad" name="tbxCantidad" disabled="true" />
                </td> -->
                
                <td>
                  &Aacute;rea:
                </td>
                <td>
                  <input type="text" id="tbxArea" name="tbxArea" disabled="true" />
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
                  Estado Libro:
                </td>
                <td>
                  <input type="text" id="tbxEstadoLibro" name="tbxEstadoLibro" disabled="true" />
                </td>
                
              </tr>
			</table>
			
			<br>
			<h3>DATOS USUARIO</h3>
			<hr />
			
			<table width="80%" border="0">
			  <tr>
                <td>
                  C&oacute;digo:
                </td>
                <td>
                  <input type="text" id="tbxCodUsuario" name="tbxCodUsuario" class="textoMayusculas" disabled="true" />
                </td>
                
                <td>
                  Email:
                </td>
                <td>
                  <input type="text" id="tbxEmailUsuario" name="tbxEmailUsuario" disabled="true" />
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
			</table>
			
		    <br>
			<h3>DATOS SOLICITUD</h3>
			<hr />
			
			<table width="80%" border="0">
			  <tr>
                <td>
                  Fecha Reserva:
                </td>
                <td>
                  <input type="text" id="tbxFechaReserva" name="tbxFechaReserva" disabled="true" />
                </td>
                
                <td>
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

			<br>
			
			<div>
				<input type="button" id="btnAccionSolicitud" name="btnAccionSolicitud" value="Accion" />	
			</div>
			
		  </div>
		  <!-- Fin panel detalle solicitud -->	
            
          </form>
          
       <!-- Reporte -->  
       <div id="divRepoListaReservas" style="display: none;">
           <form id="formReporte" name="formReporte" method="post" action="../controllers/SolicitudController.php">
	           	<input type="hidden" id="accionFormReporte" name="accionFormReporte" value="reporteListadoReservas">
	            <b>Exportar: </b> 
	            <img id="idRepoReservas" width="3%;" style="cursor:pointer;" src="../../../public/images/icn_excel.png" title="Exportar">
	            <br>
           </form> 
        </div>
          
          <!-- Dialog Multas-->
          <div id="dialogMultas" title="Gestionar Multa">
          	<table>
          		<tr>
          			<td>
          				Valor sugerido:  &nbsp;  $
          			</td>
          			<td>
          				<input type="text" id="tbxValorSugerido" name="tbxValorSugerido" disabled="true" />
          			</td>
          		</tr>
          		
          		<tr>
          			<td>
          				Valor cancelado: $
          			</td>
          			<td>
          				<input type="text" id="tbxValorCancelado" name="tbxValorCancelado" />
          			</td>
          		</tr>
          		
          		<tr>
          			<td>
          				Nota:
          			</td>
          			<td>
          				<input type="text" id="tbxNota" name="tbxNota" class="textoMayusculas" />
          			</td>
          		</tr>
          		
          	</table>			
          </div>
          <!-- Fin dialog agregarAutor-->

          <br />
          <div id="msgValidacion"></div>
          
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