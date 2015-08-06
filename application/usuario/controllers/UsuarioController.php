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
 require_once BASEPATH . 'application/models/Usuario.php';
 require_once BASEPATH . 'util/UtilidadesBuscarPorId.php';
 
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
			break;
	 	}
	 }else{
	   //Error consultando el usuario
       header('location:' . BASEURL . 'index.php?m=1');
	 }
	 
   }
 
 ?>
