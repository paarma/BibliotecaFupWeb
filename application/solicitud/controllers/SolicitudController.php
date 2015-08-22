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
		
		case 'obtenerDatosMulta':
			
			$fechaActual = new DateTime();
			$fechaReserva = new DateTime($_POST['fechaReserva']);
			
			$diasDiferencia = 0;
			$valorMultaBase = 0;
			
			$diferencia = $fechaReserva->diff($fechaActual);
			
			//echo $diasDiferencia->format('%R%a días');
			$diasDiferencia = $diferencia->format('%a');
			
			$response = $client->call('buscarValorMulta');
			if($response != null){
				$valorMultaBase = $response[0]['VALOR'];
			}
			
			//Retorna los dias de mora concatenado con el valor base de la multa

			echo $diasDiferencia.'_'.$valorMultaBase; die();
						
		break;
		
		case 'guardarMulta':
			
			$param = array('idSolicitud' => $_POST['idSolicitud'],
			'valorSugerido' => $_POST['valorSugerido'],
			'valorCancelado' => $_POST['valorCancelado'],
			'diasMora' => $_POST['diasMora'],
			'nota' => $_POST['nota']);
			
			$response = $client->call('guardarMulta',$param);
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
