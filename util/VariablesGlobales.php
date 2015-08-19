<?php

/**
 * Archivo el cual contiene variables globales disponibles en toda la app.
 * @autor Pablo Manquillo
 * paarma80@gmail.com
 */
 
 //Inicializacion de objetos generales

/**
 * Variable que contiene un libro con sus parametros para busqueda
 */
$_SESSION['libroBuscar'] = new Libro();

/**
 * Variable que contiene un libro seleccionado por el admin.
 */
$_SESSION['libroSeleccionadoAdmin'] = null;

/**
 * Variable que contiene un usuario con los parametros cargados para busqueda
 */
$_SESSION['usuarioBuscar'] = new Usuario();

/**
 * Variable que contiene un usuario seleccionado por el admin.
 */
$_SESSION['usuarioSeleccionadoAdmin'] = null;

/**
 * Variable que contiene un autor con los parametros cargados para busqueda
 */
$_SESSION['autorBuscar'] = new Autor();

/**
 * Variable que contiene un autor seleccionado por el admin.
 */
$_SESSION['autorSeleccionadoAdmin'] = null;

/**
 * Variable que contiene una Editorial con los parametros cargados para busqueda
 */
$_SESSION['editorialBuscar'] = new Editorial();

/**
 * Variable qeu contiene una editorial seleccionada por el admin.
 */
$_SESSION['editorialSeleccionadaAdmin'] = null;
 
 ?>
