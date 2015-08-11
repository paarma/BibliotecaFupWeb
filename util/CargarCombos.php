<?php

/**
 * Controlador especifico para cargar diversos comboBox. 
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
 		
	 	case 'cargarCombo':
			
			$response = null;
			$tabla = $_POST['tabla'];
			
			if($tabla == "EDITORIAL"){
				$editorialBuscar = new Editorial(); //Editorial por defecto (Listará todas las editoriales)
				$param = array('descripcion' => $editorialBuscar->getDescripcion());			
				$response = $client->call('listadoEditoriales',$param);	
			}
			
			if($tabla == "AREA"){			
				$response = $client->call('listadoAreas');
			}
			
			if($tabla == "SEDE"){			
				$response = $client->call('listadoSedes');
			}
			
			if($tabla == "PAIS"){			
				$response = $client->call('listadoPaises');
			}
			
			if($tabla == "CIUDAD"){
				$idPais = $_POST['idPais']; //En caso de 0 o vacio, listara todas las ciudades
				$param = array('idPais' => $idPais);			
				$response = $client->call('listadoCiudades',$param);
			}
			
			echo json_encode($response);
			
	    break;
 	}	
	
 }
 
 ?>