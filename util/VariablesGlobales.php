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
 * Arreglo contenedor del listado de libros;
 */
$_SESSION['arrayListadoLibros'] = null;

/**
 * Variable que contiene un libro seleccionado por el admin.
 */
$_SESSION['libroSeleccionadoAdmin'] = null;
 
 ?>
