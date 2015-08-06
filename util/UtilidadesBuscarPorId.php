<?php

 function obtenerUsuarioSoap($user){
	$usuario = new Usuario();
	$usuario->setIdUsuario($user['ID_USUARIO']);
	
    if($user["CEDULA"] != null){
        $usuario->setCedula($user["CEDULA"]);
    }
	
	if($user["PRIMER_NOMBRE"] != null){
        $usuario->setPrimerNombre($user["PRIMER_NOMBRE"]);
    }

	if($user["SEGUNDO_NOMBRE"] != null){
       $usuario->setSegundoNombre($user["SEGUNDO_NOMBRE"]);
    }

    if($user["PRIMER_APELLIDO"] != null){
        $usuario->setPrimerApellido($user["PRIMER_APELLIDO"]);
    }
	
	if($user["SEGUNDO_APELLIDO"] != null){
        $usuario->setSegundoApellido($user["SEGUNDO_APELLIDO"]);
    }

    if($user["TELEFONO"] != null){
        $usuario->setTelefono($user["TELEFONO"]);
    }
	
	if($user["DIRECCION"] != null){
        $usuario->setDireccion($user["DIRECCION"]);
    }

    if($user["EMAIL"] != null) {
        $usuario->setEmail($user["EMAIL"]);
    }
	
	if($user["CODIGO"] != null){
        $usuario->setCodigo($user["CODIGO"]);
    }

    if($user["CLAVE"] != null){
        $usuario->setClave($user["CLAVE"]);
    }
	
	if($user["ROL"] != null){
        $usuario->setRol($user["ROL"]);
    }
	
	return $usuario;

 }

?>