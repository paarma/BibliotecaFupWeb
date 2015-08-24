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
    
    <h3>Solicitudes</h3>
    <ul id="menuSolicitudes" class="toggle">
      <li class="icn_categories"><a href='<?php echo BASEURL.'application/solicitud/views/listaSolicitudes.php'; ?>'>Listado Solicitudes</a></li>
      <li class="icn_search"><a id="menuBuscarLibroAdmin" href='<?php echo BASEURL.'application/solicitud/views/buscarSolicitudAdmin.php'; ?>'>Buscar</a></li>
    <hr/>
    </ul>
    

    <h3>Usuarios</h3>
    <ul id="menuUsuariosAdmin" class="toggle">
      <li class="icn_add_user"><a href='<?php echo BASEURL.'application/usuario/views/crearUsuario.php'; ?>'>Crear Usuario</a></li>
      <li class="icn_categories"><a href='<?php echo BASEURL.'application/usuario/views/listaUsuarios.php'; ?>'>Listado Usuarios</a></li>
      <li class="icn_search"><a href='<?php echo BASEURL.'application/usuario/views/buscarUsuarioAdmin.php'; ?>'>Buscar</a></li>
    <hr/>
    </ul>
    

    <h3>Autores</h3>
    <ul id="menuAutores" class="toggle">
      <li class="icn_add_user"><a href='<?php echo BASEURL.'application/autor/views/crearAutor.php'; ?>'>Crear Autor</a></li>
      <li class="icn_categories"><a href='<?php echo BASEURL.'application/autor/views/listaAutores.php'; ?>'>Listado Autores</a></li>
      <li class="icn_search"><a href='<?php echo BASEURL.'application/autor/views/buscarAutorAdmin.php'; ?>'>Buscar</a></li>
    <hr/>
    </ul>
    
    <h3>Editoriales</h3>
    <ul id="menuEditoriales" class="toggle">
      <li class="icn_new_article"><a href='<?php echo BASEURL.'application/editorial/views/crearEditorial.php'; ?>'>Crear Editorial</a></li>
      <li class="icn_categories"><a href='<?php echo BASEURL.'application/editorial/views/listaEditoriales.php'; ?>'>Listado Editoriales</a></li>
    <hr/>
    </ul>
    
    <li class="icn_jump_back"><a href='<?php echo BASEURL.'application/general/controllers/CerrarSesion.php'; ?>'>Salir</a></li>
  
    
    <footer>
      <hr />
      <p><strong>Copyright &copy; 2015 Website</strong></p>
      <p>Todos los derechos reservados. paarma80@gmail.com</a></p>
    </footer>
  </aside><!-- end of sidebar -->