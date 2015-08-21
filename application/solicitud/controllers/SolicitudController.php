<?php

/**
 * Controlador especifico para el manejo correspondiente a Libros. 
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
		
		case 'actualizarSolicitudes':
			
			$fechaActual = date("Y-m-d");
			
			$idSolicitud = $_POST['idSolicitud'];
			$estado = $_POST['estado'];
			
			$param = array('idSolicitud' => $idSolicitud,
			'estado' => $estado,
			'fechaEntrega' => $fechaActual,
			'updateAll' => "false");
			
			$response = $client->call('actualizarSolicitud',$param);
			
			if($response == 0){
		       //Error almacenando en la BD
		       echo false;
		    }else{
		       echo true;
		    }
			
		break;		
	}
 }
 
 
 ?>
