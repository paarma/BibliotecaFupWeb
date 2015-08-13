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
		
		case 'listadoLibros':
			
			$param = array('titulo' => $_SESSION['libroBuscar']->getTitulo(), 
			'isbn' => $_SESSION['libroBuscar']->getIsbn(),
			'codTopografico' => $_SESSION['libroBuscar']->getCodigoTopografico(),
			'temas' => $_SESSION['libroBuscar']->getTemas(),
			'editorial' => "",
			'autor' => 0);
			
			$response = $client->call('listadoLibros',$param);
		
		 $listaLibros = array();
		 //$listaLibros = new ArrayObject();
		 		
		 if(count($response) > 0 ){
		 	foreach($response as $item){
		 		//echo $item['TITULO'];
		 		$libro = obtenerLibroSoap($item);
				//$listaLibros->append($libro); //para el caso de ArrayObject
				$listaLibros[] = $libro;
		 	}
		 }

		//Se almacena el listado de objetos en session, de esta manera se tienen todos
		//los objetos disponibles.
		$_SESSION['arrayListadoLibros'] = $listaLibros;
		 
		 echo json_encode($listaLibros);
				
	    break;
		
		case 'verDetalleLibroAdmin':
			
			$idLibro = $_POST['idLibro'];
			$arrayLibros = $_SESSION['arrayListadoLibros'];
			
			foreach ($arrayLibros as $key => $libroObject) {
					
				if($idLibro == $libroObject->getIdLibro()){
						$_SESSION['libroSeleccionadoAdmin'] = $libroObject;
					break;
				}
			}
			
			//Se cargan los datos en la UI. interfaz de usuario
			if($_SESSION['libroSeleccionadoAdmin'] != null){
				echo "mostrar datos";
			}
				
		break;
		
 	}	
	
 }

?>