<?php

/**
 * Utilidad especifica para generar objetos con sus respectivos valores
 * @autor Pablo Manquillo
 * paarma80@gmail.com
 */

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


/**
 * Metodo encardado de setear los valores desde la BD (Soap) a un Libro.
 * @param libroSoap Objeto Soap que contiene los datos de libro para ser setados.
 * @return
 */
 function obtenerLibroSoap($libroSoap){

    $lib = new Libro();
    $lib->setIdLibro($libroSoap["ID_LIBRO"]);

    if($libroSoap["TITULO"] != null){
        $lib->setTitulo($libroSoap["TITULO"]);
    }

    if($libroSoap["ISBN"] != null){
        $lib->setIsbn($libroSoap["ISBN"]);
    }

    if($libroSoap["COD_TOPOGRAFICO"] != null){
        $lib->setCodigoTopografico($libroSoap["COD_TOPOGRAFICO"]);
    }

    if($libroSoap["TEMAS"] != null){
        $lib->setTemas($libroSoap["TEMAS"]);
    }

    if($libroSoap["PAGINAS"] != null) {
        $lib->setPaginas($libroSoap["PAGINAS"]);
    }

    if($libroSoap["VALOR"] != null) {
        $lib->setValor($libroSoap["VALOR"]);
    }

    if($libroSoap["RADICADO"] != null) {
        $lib->setRadicado($libroSoap["RADICADO"]);
    }

    if($libroSoap["FECHA_INGRESO"] != null) {
        $lib->setFechaIngreso($libroSoap["FECHA_INGRESO"]);
    }

    if($libroSoap["SERIE"] != null) {
        $lib->setSerie($libroSoap["SERIE"]);
    }

    if($libroSoap["ANIO"] != null) {
        $lib->setAnio($libroSoap["ANIO"]);
    }

    //Editorial
    if($libroSoap["ID_EDITORIAL"] != null) {
        $lib->setEditorial(buscarEditorialPorId($libroSoap["ID_EDITORIAL"]));
    }

    //Area
    if($libroSoap["ID_AREA"] != null) {
        $lib->setArea(buscarAreaPorId($libroSoap["ID_AREA"]));
    }

    //Sede
    if($libroSoap["ID_SEDE"] != null) {
        $lib->setSede(buscarSedePorId($libroSoap["ID_SEDE"]));
    }

    //Ciudad
    if($libroSoap["ID_CIUDAD"] != null) {
        $lib->setCiudad(buscarCiudadPorId($libroSoap["ID_CIUDAD"]));
    }

    if($libroSoap["ADQUISICION"] != null) {
        $lib->setAdquisicion($libroSoap["ADQUISICION"]);
    }

    if($libroSoap["ESTADO"] != null) {
        $lib->setEstado($libroSoap["ESTADO"]);
    }

    if($libroSoap["CANTIDAD"] != null) {
        $lib->setCantidad($libroSoap["CANTIDAD"]);
    }

    return $lib;
}


/**
 * Metodo encardado de setear los valores desde la BD (Soap) a un Libro.
 * @param libroSoap Objeto Soap que contiene los datos de libro para ser setados.
 * @return
 */
 function obtenerLibroSoapNew($libroSoap){

    $lib = new Libro();
    $lib->setIdLibro($libroSoap["ID_LIBRO"]);

    if($libroSoap["TITULO"] != null){
        $lib->setTitulo($libroSoap["TITULO"]);
    }

    if($libroSoap["ISBN"] != null){
        $lib->setIsbn($libroSoap["ISBN"]);
    }

    if($libroSoap["COD_TOPOGRAFICO"] != null){
        $lib->setCodigoTopografico($libroSoap["COD_TOPOGRAFICO"]);
    }

    if($libroSoap["TEMAS"] != null){
        $lib->setTemas($libroSoap["TEMAS"]);
    }

    if($libroSoap["PAGINAS"] != null) {
        $lib->setPaginas($libroSoap["PAGINAS"]);
    }

    if($libroSoap["VALOR"] != null) {
        $lib->setValor($libroSoap["VALOR"]);
    }

    if($libroSoap["RADICADO"] != null) {
        $lib->setRadicado($libroSoap["RADICADO"]);
    }

    if($libroSoap["FECHA_INGRESO"] != null) {
        $lib->setFechaIngreso($libroSoap["FECHA_INGRESO"]);
    }

    if($libroSoap["SERIE"] != null) {
        $lib->setSerie($libroSoap["SERIE"]);
    }

    if($libroSoap["ANIO"] != null) {
        $lib->setAnio($libroSoap["ANIO"]);
    }

    //Editorial
    if($libroSoap["ID_EDITORIAL"] != null) {
    	
		$editorial = new Editorial();
		
		$editorial->setIdEditorial($libroSoap["ID_EDITORIAL"]);
		$editorial->setDescripcion($libroSoap["DES_EDITORIAL"]);
		
        $lib->setEditorial($editorial);
    }

    //Area
    if($libroSoap["ID_AREA"] != null) {
    	
		$area = new Area();
		
		$area->setIdArea($libroSoap["ID_AREA"]);
		$area->setDescripcion($libroSoap["DES_AREA"]);
		
        $lib->setArea($area);
    }

    //Sede
    if($libroSoap["ID_SEDE"] != null) {
    	
		$sede = new Sede();
		
		$sede->setIdSede($libroSoap["ID_SEDE"]);
		$sede->setDescripcion($libroSoap["DES_SEDE"]);
		
        $lib->setSede($sede);
    }

    //Ciudad
    if($libroSoap["ID_CIUDAD"] != null) {
    	
		$ciudad = new Ciudad();
		
		$ciudad->setIdCiudad($libroSoap["ID_CIUDAD"]);
		$ciudad->setNombre($libroSoap["NOM_CIUDAD"]);
		
		$pais = new Pais();
		
		$pais->setIdPais($libroSoap["ID_PAIS"]);
        $pais->setNombre($libroSoap["NOM_PAIS"]);
		
		$ciudad->setPais($pais);
		
        $lib->setCiudad($ciudad);
    }

    if($libroSoap["ADQUISICION"] != null) {
        $lib->setAdquisicion($libroSoap["ADQUISICION"]);
    }

    if($libroSoap["EST_LIBRO"] != null) {
        $lib->setEstado($libroSoap["EST_LIBRO"]);
    }

    if($libroSoap["CANTIDAD"] != null) {
        $lib->setCantidad($libroSoap["CANTIDAD"]);
    }

    return $lib;
}


/**
 * Funcion encargada de obtener una Editorial segun si ID
 */
  function buscarEditorialPorId($idEditorial){
	
	global $client; //referencia global a la variable client (la cual accede al WS)
	
	$editorial = null;
		
 	$param = array('idEditorial' =>$idEditorial);
	$response = $client->call('buscarEditorialPorId',$param);
	
	if($response != null){
		
		$editorial = new Editorial();
		
		$editorial->setIdEditorial($response[0]["ID_EDITORIAL"]);
		$editorial->setDescripcion($response[0]["DESCRIPCION"]);
	}

	return $editorial;
  }
  
  
 /**
 * Funcion encargada de obtener un Area segun si ID
 */
  function buscarAreaPorId($idArea){
  	
	global $client; //referencia global a la variable client (la cual accede al WS)
	
	$area = null;
		
 	$param = array('idArea' =>$idArea);
	$response = $client->call('buscarAreaPorId',$param);
	
	if($response != null){
		
		$area = new Area();
		
		$area->setIdArea($response[0]["ID_AREA"]);
		$area->setDescripcion($response[0]["DESCRIPCION"]);
	}

	return $area;
  }
 
  
 /**
 * Funcion encargada de obtener una Sede segun si ID
 */
  function buscarSedePorId($idSede){
  	
	global $client; //referencia global a la variable client (la cual accede al WS)
	
	$sede = null;
		
 	$param = array('idSede' =>$idSede);
	$response = $client->call('buscarSedePorId',$param);
	
	if($response != null){
		
		$sede = new Sede();
		
		$sede->setIdSede($response[0]["ID_SEDE"]);
		$sede->setDescripcion($response[0]["DESCRIPCION"]);
	}

	return $sede;
  }
  
  
 /**
 * Funcion encargada de obtener una Ciudad segun si ID
 */
  function buscarCiudadPorId($idCiudad){
  	
	global $client; //referencia global a la variable client (la cual accede al WS)
	
	$ciudad = null;
		
 	$param = array('idCiudad' =>$idCiudad);
	$response = $client->call('buscarCiudadPorId',$param);
	
	if($response != null){
		
		$ciudad = new Ciudad();
		
		$ciudad->setIdCiudad($response[0]["ID_CIUDAD"]);
		$ciudad->setNombre($response[0]["NOM_CIUDAD"]);
		
		$pais = new Pais();
		
		$pais->setIdPais($response[0]["ID_PAIS"]);
        $pais->setNombre($response[0]["NOM_PAIS"]);
		
		$ciudad->setPais($pais);
	}

	return $ciudad;
  }
  
  
 /**
 * Funcion encargada de obtener un Autor segun si ID
 */
  function buscarAutorPorId($idAutor){
  	
	global $client; //referencia global a la variable client (la cual accede al WS)
	
	$autor = null;
		
 	$param = array('idAutor' =>$idAutor);
	$response = $client->call('buscarAutorPorId',$param);
	
	if($response != null){
		
		$autor = new Autor();
		
		$autor->setIdAutor($response[0]['ID_AUTOR']);
		
		if($response[0]['PRIMER_NOMBRE'] != null){
			$autor->setPrimerNombre($response[0]['PRIMER_NOMBRE']);
		}
		
		if($response[0]['SEGUNDO_NOMBRE'] != null){
			$autor->setSegundoNombre($response[0]['SEGUNDO_NOMBRE']);
		}
							
		if($response[0]['PRIMER_APELLIDO'] != null){
			$autor->setPrimerApellido($response[0]['PRIMER_APELLIDO']);
		}
												
		if($response[0]['SEGUNDO_APELLIDO'] != null){
			$autor->setSegundoApellido($response[0]['SEGUNDO_APELLIDO']);
		}
																	
		if($response[0]['TIPO_AUTOR'] != null){
			$autor->setTipoAutor($response[0]['TIPO_AUTOR']);
		}
					
	}

	return $autor;
  }
  
 /**
 * Metodo encargado de retornar un libro segun su ID
 * @param idLibro
 * @return Libro
 */
  function buscarLibroPorId($idLibro){
	
	global $client; //referencia global a la variable client (la cual accede al WS)
	
	$libro = null;
		
 	$param = array('idLibro' =>$idLibro);
	$response = $client->call('buscarLibroPorId',$param);
	
	if(count($response) > 0 ){
	 	foreach($response as $item){
	 		$libro = obtenerLibroSoap($item);
			break;
	 	}
	 }
	
	return $libro;
  }
  
 /**
 * Metodo encargado de retornar un usuario segun su ID
 * @param idUsuario
 * @return Usuario
 */
  function buscarUsuarioPorId($idUsuario){
	
	global $client; //referencia global a la variable client (la cual accede al WS)
	
	$usuario = null;
		
 	$param = array('idUsuario' =>$idUsuario);
	$response = $client->call('buscarUsuarioPorId',$param);
	
	if(count($response) > 0 ){
	 	foreach($response as $item){
	 		$usuario = obtenerUsuarioSoap($item);
			break;
	 	}
	 }
	
	return $usuario;
  }
 
  
 /**
 * Metodo encargado de retornar una solicitud segun su ID
 * @param idSolicitud
 * @return Solicitud
 */
  function buscarSolicitudPorId($idSolicitud){
	
	global $client; //referencia global a la variable client (la cual accede al WS)
	
	$solicitud = null;
		
 	$param = array('idSolicitud' =>$idSolicitud);
	$response = $client->call('buscarSolicitudPorId',$param);
	
	if(count($response) > 0 ){
	 	foreach($response as $item){
	 		
	 		$libroBd = buscarLibroPorId($item['ID_LIBRO']);
			$usuarioBd = buscarUsuarioPorId($item['ID_USUARIO']);
			
			$solicitud = new Solicitud();
			$solicitud->setIdSolicitud($item['ID_SOLICITUD']);
			
			$solicitud->setUsuario($usuarioBd);
			$solicitud->setLibro($libroBd);
			$solicitud->setEstado($item['ESTADO']);
			
			//Fechas
			$solicitud->setFechaSolicitud($item['FECHA_SOLICITUD']);
			$solicitud->setFechaReserva($item['FECHA_RESERVA']);
			$solicitud->setFechaDevolucion($item['FECHA_DEVOLUCION']);
			$solicitud->setFechaEntrega($item['FECHA_ENTREGA']);
			break;
	 	}
	 }

	return $solicitud;
  }
  
  
   /**
 * Metodo encargado de retornar una solicitud segun su ID
 * @param idSolicitud
 * @return Solicitud
 */
  function buscarSolicitudPorIdNew($idSolicitud){
	
	global $client; //referencia global a la variable client (la cual accede al WS)
	
	$solicitud = null;
		
 	$param = array('idSolicitud' =>$idSolicitud);
	$response = $client->call('buscarSolicitudPorIdNew',$param);
	
	if(count($response) > 0 ){
	 	foreach($response as $item){
	 		
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
			break;
	 	}
	 }

	return $solicitud;
  }
  

?>