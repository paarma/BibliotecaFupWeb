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
		
		case 'buscarSolicitud':
			
		$libro = new Libro();
		$usuario = new Usuario();
		$solicitud = new Solicitud();
		
		//Libro
		if(trim($_POST['titulo']) != ""){
			$libro->setTitulo(trim($_POST['titulo']));
		}
		
		if(trim($_POST['isbn']) != ""){
			$libro->setIsbn(trim($_POST['isbn']));
		}
				
		if(trim($_POST['codTopografico']) != ""){
			$libro->setCodigoTopografico(trim($_POST['codTopografico']));
		}
		
		//Usuario
		if(trim($_POST['codUsuario']) != ""){
			$usuario->setCodigo(trim($_POST['codUsuario']));
		}
		
		if(trim($_POST['cedula']) != ""){
			$usuario->setCedula(trim($_POST['cedula']));
		}
		
		//Solicitud
		if(trim($_POST['fechaSolicitud']) != ""){
			$solicitud->setFechaSolicitud(trim($_POST['fechaSolicitud']));
		}

		if(trim($_POST['estadoSolicitud']) != ""){
			$solicitud->setEstado(trim($_POST['estadoSolicitud']));
		}	
			
		$solicitud->setUsuario($usuario);
		$solicitud->setLibro($libro);
		
		$_SESSION['solicitudBuscar'] = $solicitud;
		echo true;
			
		break;
				
	}
 }


  //Reservando libro
 if (isset($_POST['accionFormReservar']) && $_POST['accionFormReservar'] == 'reservar') {
 	
	 $fechaActual = date("Y-m-d"); //Fecha solicitud
	 $fechaReserva = $_POST['tbxFechaReserva'];
	 $idUsuario = $_SESSION['usuarioLogueado']->getIdUsuario();
	 $idLibro = $_POST['idLibro'];
	 $estado = "EN PROCESO";
	 
	 //Se agregan dos dias a la fecha de reserva
	 $fechaDevolucion = new DateTime($fechaReserva);
	 $fechaDevolucion->add(new DateInterval('P2D'));
	 
	 $fechaDevolucion = $fechaDevolucion->format('Y-m-d');;
	 
	 $param = array('fechaSolicitud' => $fechaActual,
	 'fechaReserva' => $fechaReserva,
	 'fechaDevolucion' => $fechaDevolucion,
	 'idUsuario' => $idUsuario,
	 'idLibro' => $idLibro,
	 'estado' => $estado);

	$response = (int) $client->call('reservar',$param);
	
	if($response == 0){
       //Error almacenando en la BD
       header('location:' . BASEURL . 'application/libro/views/reservar.php?m=2');
    }else{
       header('location:' . BASEURL . 'application/libro/views/reservar.php?m=3');
    } 
	
 }
 
 
 //Reporte listadoReservas
if(isset($_POST['accionFormReporte']) && $_POST['accionFormReporte'] == 'reporteListadoReservas'){
					
	$nombreReporte = "reservasFUP";

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
	
	//Antiguo metodo llamado reservas
	//$response = $client->call('listadoReservas',$param);
	
	//Metodo actual para el llamado a reservas (con datos de objetos relacionales)
	$response = $client->call('listadoReservasNew',$param);

	 $listaSolicitudes = array();
	 		
	 if(count($response) > 0 ){
	 	foreach($response as $item){
	
			//Antiguos metodos seteando datos a la reserva
	 		//$libroBd = buscarLibroPorId($item['ID_LIBRO_SOL']);
			//$usuarioBd = buscarUsuarioPorId($item['ID_USUARIO_SOL']);
			
			//Metodos actuales seteo datos a la reserva
			$libroBd = obtenerLibroSoapNew($item);
			$usuarioBd = obtenerUsuarioSoap($item);
			
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
	
	require_once BASEPATH . 'library/export_excel.php';
	require_once BASEPATH . 'library/PHPExcel/PHPExcel.php';
	include_once(BASEPATH . 'application/solicitud/views/repoListadoSolicitudes.php');
	
}
 
 ?>
