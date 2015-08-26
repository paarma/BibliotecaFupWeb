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
      <article class="breadcrumbs"><a href="../../inicio.php">Inicio</a> <div class="breadcrumb_divider"></div> <a class="current">Buscar Solicitud</a></article>
    </div>
  </section><!-- end of secondary bar -->
  
<?php include_once BASEPATH.'application/menuAdmin.php'; ?>
  
  <script type="text/javascript" src="<?php echo BASEURL;?>application/solicitud/views/js/solicitud.js"></script>
    
  <section id="main" class="column">
    
    <article class="module width_full">
      <header><h3>Informaci&oacute;n de B&uacute;squeda</h3></header>
        <div class="module_content">
          
          <form id="formSearchSolicitud" method="post" action="../views/listaSolicitudes.php">
            
            <div align="center">
            
            <br>
			<h3>DATOS DEL LIBRO</h3>
			<hr />
            <table width="70%" border="0">
            	
              <tr>
                <td style="width: 20%;">
                  T&iacute;tulo:
                </td>
                <td style="width: 30%;">
                  <input type="text" id="tbxTitulo" name="tbxTitulo" class="textoMayusculas" />
                </td>
                
                <td style="width: 10%;">
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
                <td colspan="3">
                  <input type="text" id="tbxCodTopografico" name="tbxCodTopografico" class="textoMayusculas" />
                </td>
              </tr>
            </table>
            
            <br>
			<h3>DATOS USUARIO</h3>
			<hr />
            <table width="70%" border="0">
            	
              <tr>
                <td style="width: 20%;">
                  C&oacute;digo:
                </td>
                <td style="width: 30%;">
                  <input type="text" id="tbxCodUsuario" name="tbxCodUsuario" class="textoMayusculas" />
                </td>
                
                <td style="width: 10%;">
                  Cedula:
                </td>
                <td>
                  <input type="text" id="tbxCedula" name="tbxCedula" class="textoMayusculas" />
                </td>
              </tr>       
            </table>
            
            <br>
			<h3>DATOS RESERVA</h3>
			<hr />
            <table width="70%" border="0">
            	
              <tr>
                <td style="width: 20%;">
                  Fecha Solcitud:
                </td>
                <td style="width: 30%;">
                  <input type="text" id="tbxFechaSolicitud" name="tbxFechaSolicitud" />
                </td>
                
                <td style="width: 20%;">
                  Estado Solicitud:
                </td>
                <td>
                  <select id="cbxEstadoSolicitud" name="cbxEstadoSolicitud">
                  	<option value="">Seleccione...</option>
                  	<option value="EN PROCESO">EN PROCESO</option>
                  	<option value="PRESTADO">PRESTADO</option>
                  	<option value="FINALIZADO">FINALIZADO</option>
                  	<option value="CANCELADO">CANCELADO</option>
                  	<option value="EN MORA">EN MORA</option>
                  </select>
                </td>
              </tr>       
            </table>
            
            </div>
            
            <br />
            <input type="button" id="btnBuscarSolicitud" name="btnBuscarSolicitud" value="Buscar" />
          </form>
          
          <br />
          
        </div>
    </article><!-- end of styles article -->
    <div class="spacer"></div>
  </section>

<?php include_once '../../layouts/footer.php';?>