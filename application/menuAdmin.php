  <aside id="sidebar" class="column">
    <form class="quick_search">
      
    </form>
    <hr/>
    <h3>Libros</h3>
    <ul class="toggle">
      <li class="icn_new_article"><a id="menuCrearLibroAdmin" href='<?php echo BASEURL.'application/libro/views/crearLibro.php'; ?>'>Crear Libro</a></li>
      <li class="icn_categories"><a id="menuLibrosAdmin" href='<?php echo BASEURL.'application/libro/views/listaLibrosAdmin.php'; ?>'>Listado Libros</a></li>
      <li class="icn_search"><a id="menuBuscarLibroAdmin" href='<?php echo BASEURL.'application/libro/views/buscarLibroAdmin.php'; ?>'>Buscar</a></li>

    <hr/>
    </ul>
    

    <h3>Usuarios</h3>
    <ul id="manuUsuariosAdmin" class="toggle">
      <li class="icn_add_user"><a href='<?php echo BASEURL.'application/usuario/views/crearUsuario.php'; ?>'>Agregar Usuario</a></li>
      <li class="icn_categories"><a href='<?php echo BASEURL.'application/usuario/views/listaUsuarios.php'; ?>'>Listado Usuarios</a></li>
      <li class="icn_search"><a id="menuBuscarLibroAdmin" href='<?php echo BASEURL.'application/libro/views/buscarLibroAdmin.php'; ?>'>Buscar</a></li>
    <hr/>
    </ul>
    

    <h3>Grupos Investigaci&oacute;n</h3>
    <ul class="toggle">
      <li class="icn_view_users"><a href='<?php echo BASEURL.'application/general/views/agregarGrupoInvestigacion.php'; ?>'>Agregar Grupo Investigaci&oacute;n</a></li>
      <li class="icn_folder"><a href='<?php echo BASEURL.'application/general/views/listarGruposInvestigacion.php'; ?>'>Ver Grupos Investigaci&oacute;n</a></li>
    <hr/>
    </ul>
    
    <h3>Reportes</h3>
    <ul class="toggle">
      <li class="icn_settings"><a href='<?php echo BASEURL.'application/reportes/views/docentesActivos.php'; ?>'>Docentes</a></li>
      <li class="icn_settings"><a href='<?php echo BASEURL.'application/reportes/views/docentesPorPrograma.php'; ?>'>Docentes por Programa</a></li>
      <li class="icn_folder"><a href='<?php echo BASEURL.'application/reportes/views/gruposInvestigacion.php'; ?>'>Grupos Investigaci&oacute;n</a></li>
      <li class="icn_folder"><a href='<?php echo BASEURL.'application/reportes/views/infoPorDocente.php'; ?>'>Informaci&oacute;n por Docente</a></li>
      <li class="icn_categories"><a href='<?php echo BASEURL.'application/reportes/views/generales.php'; ?>'>Generales</a></li>
    <hr/>
    </ul>
    
    <li class="icn_jump_back"><a href='<?php echo BASEURL.'application/general/controllers/CerrarSesion.php'; ?>'>Salir</a></li>
  
    
    <footer>
      <hr />
      <p><strong>Copyright &copy; 2015 Website</strong></p>
      <p>Todos los derechos reservados. paarma80@gmail.com</a></p>
    </footer>
  </aside><!-- end of sidebar -->