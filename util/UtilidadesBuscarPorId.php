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

    /*if($libroSoap["FECHA_INGRESO"] != null) {
        try{
            Date fechaIngreso;
            fechaIngreso = Utilidades->formatoFechaYYYYMMDD->parse($libroSoap["FECHA_INGRESO"]);
            $lib->setFechaIngreso(fechaIngreso);
        }catch (Exception e){
            Log->e("Generales","XXX Error seteando fechaIngresoLibro: "+e->getMessage());
        }
    }*/

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
        //$lib->setArea(buscarAreaPorId($libroSoap["ID_AREA"]));
    }

    //Sede
    if($libroSoap["ID_SEDE"] != null) {
        //$lib->setSede(buscarSedePorId($libroSoap["ID_SEDE"]));
    }

    //Ciudad
    if($libroSoap["ID_CIUDAD"] != null) {
        //$lib->setCiudad(buscarCiudadPorId($libroSoap["ID_CIUDAD"]));
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

?>