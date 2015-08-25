<?php

include_once 'layouts/header.php';

if(!isset($_SESSION['usuarioLogueado']))
{
	header('location:'.BASEURL.'index.php');
	exit();
}

include_once BASEPATH.'util/VariablesGlobales.php';

?>

<section id="secondary_bar">
    <div class="user">
      <?php include_once BASEPATH.'application/tabUsuario.php'; ?>
      <!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
    </div>
    <div class="breadcrumbs_container">
      <article class="breadcrumbs"><a href="#">Inicio</a> <div class="breadcrumb_divider"></div></article>
    </div>
  </section><!-- end of secondary bar -->
  
<?php 

	//Se verifica el rol de usuario para determinar que menu cargar
	if($_SESSION['usuarioLogueado']->getRol() == "ADMINISTRADOR"){
		include_once BASEPATH.'application/menuAdmin.php'; 
	}else{
		include_once BASEPATH.'application/menuUser.php'; 
	}
	
	
?>
    
  <section id="main" class="column">
    
    <article class="module width_full">
      <header><h3>General</h3></header>
        <div class="module_content">
          <h1>Generalidades del sistema</h1>
         <p>
          Sistema encargado de gestionar la información correspondiente al manejo, registro y préstamo <br>
          de libros	específicos de la biblioteca Fundación Universitaria de Popayán,  <br>
          ademas de la generación de reportes y consolidados de las diferentes solicitudes de reserva <br>
          para cada libro.
          </p>
  
         <br />
          <ul>
            <li>Manejo de la información correspondiente a la reserva de libros.</li>
            <li>Gestión de la información correspondiente a usuarios. </li>
            <li>Generacion de Reportes. </li>
          </ul>
        </div>
    </article><!-- end of styles article -->
    <div class="spacer"></div>
  </section>

<?php include_once 'layouts/footer.php';?>


?>