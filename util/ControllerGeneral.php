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
			
			//Metodo anterior para el listado de libros
			//$response = $client->call('listadoLibros',$param);
			
			//Metodo actual para el listado de libros (con los datos de objetos relacionales)
			$response = $client->call('listadoLibrosNew',$param);
		
		 $listaLibros = array();
		 //$listaLibros = new ArrayObject();
		 		
		 if(count($response) > 0 ){
		 	foreach($response as $item){
		 		//echo $item['TITULO'];
		 		
		 		//Metodo anterior para el seteo de datos relacionales
		 		//$libro = obtenerLibroSoap($item);
		 		
		 		//Metodo actual para el seteo de datos relacionales
		 		$libro = obtenerLibroSoapNew($item);
		 		
				//$listaLibros->append($libro); //para el caso de ArrayObject
				$listaLibros[] = $libro;
		 	}
		 }

		 //$_SESSION['libroBuscar'] = new Libro();
		 
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
			
			$_SESSION['usuarioSeleccionadoAdmin'] = null;
			$_SESSION['usuarioBuscar'] = new Usuario();
			
			$_SESSION['autorSeleccionadoAdmin'] = null;
			$_SESSION['autorBuscar'] = new Autor();
			
			$_SESSION['editorialSeleccionadaAdmin'] = null;
			$_SESSION['editorialBuscar'] = new Editorial();
			
			$_SESSION['solicitudBuscar'] = new Solicitud();
				$_SESSION['solicitudBuscar']->setUsuario(new Usuario());
				$_SESSION['solicitudBuscar']->setLibro(new Libro());
				
			//Si el usuario logueado tiene rol "Usuario"
			if(isset($_SESSION['usuarioLogueado']) && 
				$_SESSION['usuarioLogueado']->getRol() == "USUARIO"){
				$_SESSION['solicitudBuscar']->getUsuario()->setIdUsuario(
					$_SESSION['usuarioLogueado']->getIdUsuario());
			}	
			
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
			
			//Para el caso de "Mis Libros"
					//Si el usuario logueado tiene rol "Usuario"
					if(isset($_SESSION['usuarioLogueado']) && 
						$_SESSION['usuarioLogueado']->getRol() == "USUARIO"){
							
						$_SESSION['solicitudBuscar']->setLibro($libro);		
						$_SESSION['solicitudBuscar']->getUsuario()->setIdUsuario(
							$_SESSION['usuarioLogueado']->getIdUsuario());
					}
			
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
	
			 //$_SESSION['usuarioBuscar'] = new Usuario();
			 
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
		
		case 'buscarUsuario':
			
			$usuario = new Usuario();
			
			if(trim($_POST['cedula']) != ""){
				$usuario->setCedula(trim($_POST['cedula']));
			}
			
			if(trim($_POST['primerNombre']) != ""){
				$usuario->setPrimerNombre(trim($_POST['primerNombre']));
			}
						
			if(trim($_POST['segundoNombre']) != ""){
				$usuario->setSegundoNombre(trim($_POST['segundoNombre']));
			}
									
			if(trim($_POST['primerApellido']) != ""){
				$usuario->setPrimerApellido(trim($_POST['primerApellido']));
			}
			
			if($_POST['segundoApellido'] != ""){
				$usuario->setSegundoApellido($_POST['segundoApellido']);
			}
									
			if(trim($_POST['codigo']) != ""){
				$usuario->setCodigo($_POST['codigo']);
			}
			
			if(trim($_POST['rol']) != ""){
				$usuario->setRol($_POST['rol']);
			}
			
			$_SESSION['usuarioBuscar'] = $usuario;
			
			echo true;
		break;
		
		case 'listadoAutores':
			
			$param = array('primerNombre' => $_SESSION['autorBuscar']->getPrimerNombre(),
			'segundoNombre' => $_SESSION['autorBuscar']->getSegundoNombre(),
			'primerApellido' => $_SESSION['autorBuscar']->getPrimerApellido(),
			'segundoApellido' => $_SESSION['autorBuscar']->getSegundoApellido(),
			'tipo' => $_SESSION['autorBuscar']->getTipoAutor());
			
			$response = $client->call('listadoAutores',$param);
		
			 $listaAutores = array();
			 		
			 if(count($response) > 0 ){
			 	foreach($response as $item){
			 		$autor = new Autor();
					
					$autor->setIdAutor($item['ID_AUTOR']);
					
					if($item['PRIMER_NOMBRE'] != null){
						$autor->setPrimerNombre($item['PRIMER_NOMBRE']);
					}
					
					if($item['SEGUNDO_NOMBRE'] != null){
						$autor->setSegundoNombre($item['SEGUNDO_NOMBRE']);
					}
										
					if($item['PRIMER_APELLIDO'] != null){
						$autor->setPrimerApellido($item['PRIMER_APELLIDO']);
					}
															
					if($item['SEGUNDO_APELLIDO'] != null){
						$autor->setSegundoApellido($item['SEGUNDO_APELLIDO']);
					}
																				
					if($item['TIPO_AUTOR'] != null){
						$autor->setTipoAutor($item['TIPO_AUTOR']);
					}

					$listaAutores[] = $autor;
			 	}
			 }
	
			 $_SESSION['autorBuscar'] = new Autor();
			 
			 echo json_encode($listaAutores);
		break;
		
		case 'capurarAutorSeleccionado':
			
			$idAutor = $_POST['idAutor'];
			$autor = buscarAutorPorId($idAutor);
			$_SESSION['autorSeleccionadoAdmin'] = $autor;
			
			echo true;		
		break;
		
		case 'listadoEditorial':
			
			$param = array('descripcion' => $_SESSION['editorialBuscar']->getDescripcion());
			$response = $client->call('listadoEditoriales',$param);
		
			 $listaEditoriales = array();
			 		
			 if(count($response) > 0 ){
			 	foreach($response as $item){
			 		
					$editorial = new Editorial();
					
					$editorial->setIdEditorial($item["ID_EDITORIAL"]);
					$editorial->setDescripcion($item["DESCRIPCION"]);

					$listaEditoriales[] = $editorial;
			 	}
			 }
	
			 $_SESSION['editorialBuscar'] = new Editorial();
			 
			 echo json_encode($listaEditoriales);
		break;
		
		case 'listadoSolicitudes':

			//Buscar por editorial
			$idEditorial = "";
			if($_SESSION['solicitudBuscar']->getLibro()->getEditorial() != null){
				$idEditorial = $_SESSION['solicitudBuscar']->getEditorial()->getIdEditorial();
			}
			
			//Buscar por fechaSolicitud
			$fechaSolicitud = "";
			if($_SESSION['solicitudBuscar']->getFechaSolicitud() != null){
				$fechaSolicitud = $_SESSION['solicitudBuscar']->getFechaSolicitud();
			}
			
			$param = array('titulo' => $_SESSION['solicitudBuscar']->getLibro()->getTitulo(), 
			'isbn' => $_SESSION['solicitudBuscar']->getLibro()->getIsbn(),
			'codTopografico' => $_SESSION['solicitudBuscar']->getLibro()->getCodigoTopografico(),
			'temas' => $_SESSION['solicitudBuscar']->getLibro()->getTemas(),
			'editorial' => $idEditorial,
			'idUsuarioReserva' => $_SESSION['solicitudBuscar']->getUsuario()->getIdUsuario(),
			'estadoReserva' => $_SESSION['solicitudBuscar']->getEstado(),
			'codUsuario' => $_SESSION['solicitudBuscar']->getUsuario()->getCodigo(), 
			'cedulaUsuario' => $_SESSION['solicitudBuscar']->getUsuario()->getCedula(), 
			'fechaSolicitud' => $fechaSolicitud, 
			'autor' => $_SESSION['solicitudBuscar']->getLibro()->getIdAutor());
			
			$response = $client->call('listadoReservas',$param);

		 $listaSolicitudes = array();
		 		
		 if(count($response) > 0 ){
		 	foreach($response as $item){

		 		$libroBd = buscarLibroPorId($item['ID_LIBRO_SOL']);
				$usuarioBd = buscarUsuarioPorId($item['ID_USUARIO_SOL']);
				
				$solicitud = new Solicitud();
				$solicitud->setIdSolicitud($item['ID_SOLICITUD']);
				
				$solicitud->setUsuario($usuarioBd);
				$solicitud->setLibro($libroBd);
				$solicitud->setEstado($item['ESTADO_SOL']);
				
				//Fechas
				$solicitud->setFechaSolicitud($item['FECHA_SOLICITUD']);
				$solicitud->setFechaReserva($item['FECHA_RESERVA']);
				$solicitud->setFechaDevolucion($item['FECHA_DEVOLUCION']);
				$solicitud->setFechaEntrega($item['FECHA_ENTREGA']);

				$listaSolicitudes[] = $solicitud;
		 	}
		 }
		 
		 /*$_SESSION['solicitudBuscar'] = new Solicitud();
			$_SESSION['solicitudBuscar']->setUsuario(new Usuario());
			$_SESSION['solicitudBuscar']->setLibro(new Libro()); */
			
			//Si el usuario logueado tiene rol "Usuario"
			if(isset($_SESSION['usuarioLogueado']) && 
				$_SESSION['usuarioLogueado']->getRol() == "USUARIO"){
				$_SESSION['solicitudBuscar']->getUsuario()->setIdUsuario(
					$_SESSION['usuarioLogueado']->getIdUsuario());
			}		

		 echo json_encode($listaSolicitudes);
		 break;
		 
		case 'verDetalleSolicitud':
			
			$idSolicitud = $_POST['idSolicitud'];
			echo json_encode(buscarSolicitudPorId($idSolicitud));
			
		break;
 	}	
	
 }

?>