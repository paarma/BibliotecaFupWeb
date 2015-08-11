<?php

/**
 * Archivo el cual contiene funcionalidades generales correspondiente a consultas de BD.
 * @autor Pablo Manquillo
 * paarma80@gmail.com
 */
 
 require_once $_SERVER["DOCUMENT_ROOT"] . '/BibliotecaFupWeb/config.ini.php';
 require_once BASEPATH . 'library/Inputfilter.php';
 require_once BASEPATH . 'library/Helpers.php';
 require_once BASEPATH . 'library/cliente.php';
 require_once BASEPATH . 'util/Autoload.php';
 require_once BASEPATH . 'util/UtilidadesBuscarPorId.php';
 session_start();
 
  //Funcionalidades ajax
 if(isset($_POST['llamadoAjax']) && $_POST['llamadoAjax'] == "true")
 {
 	switch($_POST['opcion']){
 		
	 	case 'verficarDatoEnBd':
			
			 //se cargan los parametros y posterior llamado al WS verficarDatoEnBd.
	 		$param = array('tabla' => $_POST['tabla'], 'campo' => $_POST['campo'], 'valor' => $_POST['valor']);
	 		$response = (int) $client->call('verficarDatoEnBd',$param);
			echo $response;
			
	    break;
 	}	
	
 }

?>