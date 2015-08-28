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
 		
	 	case 'cargarDatosUsuarioSeleccionado':
			echo json_encode($_SESSION['usuarioSeleccionadoAdmin']);
		break;		
	}
 }	
 
 
  //Ingreso al sistema
   if (isset($_POST['btnAcceder']) && $_POST['btnAcceder'] == 'Acceder') {
		
	 $usuario = null;	
		
     $login = trim($_POST['tbxLogin']);
     $password = trim($_POST['tbxPassword']);
	 
	 //se cargan los parametros y posterior llamado al WS login.
	 $paramLogin = array('codigo' => $login, 'clave' => $password);
	 $response = $client->call('login',$paramLogin);
	 
	 if(count($response) > 0 ){
	 	foreach($response as $item){
	 		//echo $item['PRIMER_NOMBRE'];
	 		$usuario = obtenerUsuarioSoap($item);
			
			//Se almacena el usuario logueado en variable de session
			//$_SESSION['usuarioLogueado'] = serialize($usuario);
			$_SESSION['usuarioLogueado'] = $usuario;
			break;
	 	}
		
		header('location:' . BASEURL . 'application/inicio.php');
	 }else{
	   //Error consultando el usuario
       header('location:' . BASEURL . 'index.php?m=1');
	 }
	 
   }
   
   
 //Guardando usuario
 if (isset($_POST['accionFormUsuario']) && $_POST['accionFormUsuario'] == 'guardar') {
	
	//En caso de existir idUsuario, se edita, de lo contrario almacena.
	if(isset($_SESSION['usuarioSeleccionadoAdmin']) && $_SESSION['usuarioSeleccionadoAdmin'] != null){
		$idUsuario = $_SESSION['usuarioSeleccionadoAdmin']->getIdUsuario();
	}else{
		$idUsuario = 0;
	}
	
	$param = array('idUsuario' => (int) $idUsuario, 'cedula' => trim($_POST['tbxCedula']), 
	'primerNombre' => strtoupper(trim($_POST['tbxPrimerNombre'])), 
	'segundoNombre' => strtoupper(trim($_POST['tbxSegundoNombre'])), 
	'primerApellido' => strtoupper(trim($_POST['tbxPrimerApellido'])), 
	'segundoApellido' => strtoupper(trim($_POST['tbxSegundoApellido'])), 
	'telefono' => trim($_POST['tbxTelefono']), 
	'direccion' => strtoupper(trim($_POST['tbxDireccion'])), 
	'email' => trim($_POST['tbxEmail']), 
	'codigo' => trim($_POST['tbxCodigo']), 
	'clave' => trim($_POST['tbxClave']), 
	'rol' => $_POST['cbxRol']);
	
	$response = (int) $client->call('guardarUsuario',$param);
	
	//Se inicializa la variable libroSeleccionado
	$_SESSION['usuarioSeleccionadoAdmin'] = null;
	
	if($response == 0){
       //Error almacenando en la BD
       header('location:' . BASEURL . 'application/usuario/views/crearUsuario.php?m=2');
    }else{
       header('location:' . BASEURL . 'application/usuario/views/crearUsuario.php?m=3');
    }
	
 }


//Reporte listadoUsuarios
if(isset($_POST['accionFormReporte']) && $_POST['accionFormReporte'] == 'reporteListadoUsuarios'){
					
	$nombreReporte = "UsuariosFUP";

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
	
	require_once BASEPATH . 'library/export_excel.php';
	include_once(BASEPATH . 'application/usuario/views/repoListadoUsuarios.php');
	
}
 
 ?>
