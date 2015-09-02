<?php
/*
 * @Descripcion: Config.ini.php
 *  Contiene constantes globales que se requieren en la 
 *  mayoría de las operaciones de base de datos o archivo
 */

 	//Variable que indica la direccion IP de los WS
 	define('IP_WS', 'localhost');
	
	//Variable que indica la direccion IP del aplicativo (WEB)
 	define('IP_APP', 'localhost');
 
    //Nombre del aplicativo
    define('NOMBRE_PROYECTO','BibliotecaFupWeb'); 
 
// Definicio de constantes para el manejo de url absolutas
    define('BASEURL','http://'.IP_APP.'/'.NOMBRE_PROYECTO.'/'); 
    define('BASEPATH',dirname(__FILE__).'/');
    
?>
