<?php
/*
 * @Descripcion: Config.ini.php
 *  Contiene constantes globales que se requieren en la 
 *  mayoría de las operaciones de base de datos o archivo
 */

    //Nombre del aplicativo
    define('NOMBRE_PROYECTO','BibliotecaFupWeb'); 
 
// Definicio de constantes para el manejo de url absolutas
    define('BASEURL','http://localhost/'.NOMBRE_PROYECTO.'/'); 
    define('BASEPATH',dirname(__FILE__).'/');
	
	//constante para indicar el mes de corte para primer y segundo periodo
	/**
	 * 7 = Julio
	 * Mayor o igual que 1 (1 y <= 7) corresponde a validacion de primer perido
	 * Mayor que 7 (7 y <= 12) corresponde a validacion de segundo periodo 
	 */
	 define('MES_CORTE',7);
    
?>
