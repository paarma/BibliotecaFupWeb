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
			
			$idEditorial = "";
			if($_SESSION['libroBuscar']->getEditorial() != null){
				$idEditorial = $_SESSION['libroBuscar']->getEditorial()->getIdEditorial();
			}
			
			$param = array('titulo' => $_SESSION['libroBuscar']->getTitulo(), 
			'isbn' => $_SESSION['libroBuscar']->getIsbn(),
			'codTopografico' => $_SESSION['libroBuscar']->getCodigoTopografico(),
			'temas' => $_SESSION['libroBuscar']->getTemas(),
			'editorial' => $idEditorial,
			'autor' => $_SESSION['libroBuscar']->getIdAutor());
			
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

		 $_SESSION['libroBuscar'] = new Libro();
		 
		 echo json_encode($listaLibros);
				
	    break;
		
		case 'verDetalleLibroAdmin':
			
			$idLibro = $_POST['idLibro'];
			$libro = null;
			
			/*$arrayLibros = $_SESSION['arrayListadoLibros'];
			foreach ($arrayLibros as $key => $libroObject) {
					
				if($idLibro == $libroObject->getIdLibro()){
						$_SESSION['libroSeleccionadoAdmin'] = $libroObject;
					break;
				}
			}
			
			//Se cargan los datos en la UI. interfaz de usuario
			if($_SESSION['libroSeleccionadoAdmin'] != null){
				echo "mostrar datos";
			}*/
			
			$param = array('idLibro' => $idLibro);
			$response = $client->call('buscarLibroPorId',$param);
			
			if(count($response) > 0 ){
			 	foreach($response as $item){
			 		$libro = obtenerLibroSoap($item);
					$_SESSION['libroSeleccionadoAdmin'] = $libro;
					break;
			 	}
			 }
			
			echo json_encode($libro);
				
		break;
		
		case 'inicializarVariablesSession':
			
			$_SESSION['libroSeleccionadoAdmin'] = null;
			$_SESSION['libroBuscar'] = new Libro();
			
			echo true;
		break;
		
		case 'buscarLibro':
			
			$libro = new Libro();
			
			if(trim($_POST['titulo']) != ""){
				$libro->setTitulo(trim($_POST['titulo']));
			}
			
			if(trim($_POST['isbn']) != ""){
				$libro->setIsbn(trim($_POST['isbn']));
			}
						
			if(trim($_POST['codTopografico']) != ""){
				$libro->setCodigoTopografico(trim($_POST['codTopografico']));
			}
									
			if(trim($_POST['temas']) != ""){
				$libro->setTemas(trim($_POST['temas']));
			}
			
			if($_POST['idEditorial'] != ""){
				$libro->setEditorial(buscarEditorialPorId($_POST['idEditorial']));
			}
									
			if(trim($_POST['idAutor']) != ""){
				$libro->setIdAutor($_POST['idAutor']);
			}
			
			$_SESSION['libroBuscar'] = $libro;
			
			echo true;
		break;
		
		case 'listadoUsuarios':
			
			$param = array('cedula' => $_SESSION['usuarioBuscar']->getCedula(), 
			'primerNombre' => $_SESSION['usuarioBuscar']->getPrimerNombre(),
			'segundoNombre' => $_SESSION['usuarioBuscar']->getSegundoNombre(),
			'primerApellido' => $_SESSION['usuarioBuscar']->getPrimerApellido(),
			'segundoApellido' => $_SESSION['usuarioBuscar']->getSegundoApellido(),
			'codigo' => $_SESSION['usuarioBuscar']->getCodigo(),
			'rol' => $_SESSION['usuarioBuscar']->getRol());
			
			$response = $client->call('listadoUsuarios',$param);
		
			 $listaUsuarios = array();
			 		
			 if(count($response) > 0 ){
			 	foreach($response as $item){
			 		$usuario = obtenerUsuarioSoap($item);
					$listaUsuarios[] = $usuario;
			 	}
			 }
	
			 $_SESSION['usuarioBuscar'] = new Usuario();
			 
			 echo json_encode($listaUsuarios);
		break;
		
		case 'verDetalleUsuario':
			
			$idUsuario = $_POST['idUsuario'];
			$usuario = null;
			
			$param = array('idUsuario' => $idUsuario);
			$response = $client->call('buscarUsuarioPorId',$param);
			
			if(count($response) > 0 ){
			 	foreach($response as $item){
			 		$usuario = obtenerUsuarioSoap($item);
					$_SESSION['usuarioSeleccionadoAdmin'] = $usuario;
					break;
			 	}
			 }
			
			echo json_encode($usuario);
				
		break;		
		
 	}	
	
 }

?>