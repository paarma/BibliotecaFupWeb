<?php include_once 'application/layouts/header.php';?>

<script type="text/javascript" src="<?php echo BASEURL;?>public/js/coin-slider.min.js"></script>
<link rel="stylesheet" href="<?php echo BASEURL;?>public/css/coin-slider-styles.css" type="text/css" />

<script type="text/javascript">
  $(document).ready(function() {
    $('#coin-slider').coinslider({ width: 550,height:230 });
  });
</script>

  <section id="secondary_bar">

  </section><!-- end of secondary bar -->
  
  <aside id="sidebar" class="column">

    <article class="module width_full">
      <header><h3>Ingresar</h3></header>
        <div class="module_content">
        <form id="frmLogin" class="post_message" method="post" action="application/usuario/controllers/UsuarioController.php">
          <table>
          <tr>
            <td>
              Usuario:
            </td>
          </tr>
          
          <tr>
            <td>
              <input type="text" id="tbxLogin" name="tbxLogin" value="Usuario" size="30" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true; ">
            </td>
          </tr>
          
          <tr>
            <td>
             <div style="margin-top: 3px;">
              Contrase&ntilde;a:
             </div> 
            </td>
          </tr>
          
          <tr>
            <td>
              <input type="password" id="tbxPassword" name="tbxPassword" value="Contrase&ntilde;a" size="30" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true; ">
            </td>
          </tr>
          
          <tr align="left">
          <td colspan="2">
            <input type="submit" id="btnAcceder" name="btnAcceder" value="Acceder" style="margin-top: 7px;">
          </td>
          </tr>
          
          </table>
         </form> 
         
         <br />
          <?php if (isset($_GET['m']) && $_GET['m'] == '1'): ?>
                  <div class="bad" >Error! Usuario o Contrase&ntilde;a incorrectos...</div>
         <?php endif; ?> 
        </div>
    </article>
        
    <footer>
      <hr />
      <p><strong>Copyright &copy; 2014 Website</strong></p>
      <p>Todos los derechos reservados. paarma80@gmail.com</p>
    </footer>
  </aside><!-- end of sidebar -->
  
  <section id="main" class="column">
    
    <h4 class="alert_info">Bienvenido al sistema de Gesti&oacute;n de la biblioteca FUP.</h4>
    
    <article class="module width_full">
      <header><h3>General</h3></header>
        <div class="module_content">
          <h1>Generalidades del sistema</h1>
          <p>
          Sistema encargado de gestionar la información correspondiente al manejo, registro y préstamo de libros <br>
          específicos de la biblioteca Fundación Universitaria de Popayán. <br>
          </p>
	
	<br />

<div id="coin-slider">
<a href="#"><img src="<?php echo BASEURL;?>public/images/carrusel/1.jpeg" alt="" /></a> 
<a href="#"><img src="<?php echo BASEURL;?>public/images/carrusel/2.jpeg" alt="" /></a> 
<a href="#"><img src="<?php echo BASEURL;?>public/images/carrusel/3.png" alt="" /></a> 
<a href="#"><img src="<?php echo BASEURL;?>public/images/carrusel/4.png" alt="" /></a> 
<a href="#"><img src="<?php echo BASEURL;?>public/images/carrusel/5.jpg" alt="" /></a>
</div>


        </div>
    </article><!-- end of styles article -->
    <div class="spacer"></div>
  </section>

<?php include_once 'application/layouts/footer.php';?>
