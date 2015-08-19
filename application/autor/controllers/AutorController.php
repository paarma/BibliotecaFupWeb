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
 		
	 	case 'cargarDatosAutorSeleccionado':
			echo json_encode($_SESSION['autorSeleccionadoAdmin']);
		break;		
	}
 }	
   
   
 //Guardando autor
 if (isset($_POST['accionFormAutor']) && $_POST['accionFormAutor'] == 'guardar') {
	
	//En caso de existir idAutor, se edita, de lo contrario almacena.
	if(isset($_SESSION['autorSeleccionadoAdmin']) && $_SESSION['autorSeleccionadoAdmin'] != null){
		$idAutor = $_SESSION['autorSeleccionadoAdmin']->getIdAutor();
	}else{
		$idAutor = 0;
	}
	
	$param = array('idAutor' => (int) $idAutor, 
	'primerNombre' => strtoupper(trim($_POST['tbxPrimerNombre'])), 
	'segundoNombre' => strtoupper(trim($_POST['tbxSegundoNombre'])), 
	'primerApellido' => strtoupper(trim($_POST['tbxPrimerApellido'])), 
	'segundoApellido' => strtoupper(trim($_POST['tbxSegundoApellido'])), 
	'tipo' => $_POST['cbxTipoAutor']);
	
	$response = (int) $client->call('guardarAutor',$param);
	
	//Se inicializa la variable autorSeleccionadoAdmin
	$_SESSION['autorSeleccionadoAdmin'] = null;
	
	if($response == 0){
       //Error almacenando en la BD
       header('location:' . BASEURL . 'application/autor/views/crearAutor.php?m=2');
    }else{
       header('location:' . BASEURL . 'application/autor/views/crearAutor.php?m=3');
    }
	
 }
 
 ?>
