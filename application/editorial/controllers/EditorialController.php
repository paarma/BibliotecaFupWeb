<?php

/**
 * Maneja los datos que llegan de los formularios (tambien instancia los objetos)
 * y los envia al modelo para ser procesados (para la clase Usuario)
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
 		
	 	case 'cargarDatosEditorialSeleccionada':
			echo json_encode($_SESSION['editorialSeleccionadaAdmin']);
		break;
		
		case 'capurarEditorialSeleccionada':
			
			$idEditorial = $_POST['idEditorial'];
			$editorial = buscarEditorialPorId($idEditorial);
			$_SESSION['editorialSeleccionadaAdmin'] = $editorial;
			
			echo true;		
		break;	
	}
 }	
   
   
 //Guardando editorial
 if (isset($_POST['accionFormEditorial']) && $_POST['accionFormEditorial'] == 'guardar') {

	//En caso de existir idEditorial, se edita, de lo contrario almacena.
	if(isset($_SESSION['editorialSeleccionadaAdmin']) && $_SESSION['editorialSeleccionadaAdmin'] != null){
		$idEditorial = $_SESSION['editorialSeleccionadaAdmin']->getIdEditorial();
	}else{
		$idEditorial = 0;
	}
	
	$param = array('idEditorial' => (int) $idEditorial, 
	'descripcion' => strtoupper(trim($_POST['tbxEditorial'])));
	
	$response = (int) $client->call('guardarEditorial',$param);
	
	//Se inicializa la variable autorSeleccionadoAdmin
	$_SESSION['editorialSeleccionadaAdmin'] = null;
	
	if($response == 0){
       //Error almacenando en la BD
       header('location:' . BASEURL . 'application/editorial/views/crearEditorial.php?m=2');
    }else{
       header('location:' . BASEURL . 'application/editorial/views/crearEditorial.php?m=3');
    }
	
 }
 
 ?>
