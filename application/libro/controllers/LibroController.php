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
 
 
  //Guardando libro
 if (isset($_POST['accionFormLibro']) && $_POST['accionFormLibro'] == 'guardar') {
 	
	$fechaActual = date("Y-m-d"); 
	
	//echo "validar idLibro = 0 guarda de lo contratio edita";
	$param = array('idLibro' => (int) 0, 'titulo' => strtoupper(trim($_POST['tbxTitulo'])), 
	'valor' => trim($_POST['tbxValor']), 'adquisicion' => $_POST['cbxAdquisicion'], 
	'estado' => $_POST['cbxEstado'], 'isbn' => strtoupper(trim($_POST['tbxIsbn'])), 
	'radicado' => trim($_POST['tbxRadicado']), 'fechaIngreso' => $fechaActual, 
	'codTopografico' => strtoupper(trim($_POST['tbxCodTopografico'])), 'serie' => trim($_POST['tbxSerie']), 
	'idSede' => $_POST['cbxSede'], 'idEditorial' => $_POST['cbxEditorial'], 
	'idArea' => $_POST['cbxArea'], 'anio' => trim($_POST['tbxAnio']), 
	'temas' => strtoupper(trim($_POST['tbxTemas'])), 'paginas' => trim($_POST['tbxPaginas']), 
	'disponibilidad' => "", 'idUsuario' => (int) $_SESSION['usuarioLogueado']->getIdUsuario(), 
	'idCiudad' => $_POST['cbxCiudad'], 'cantidad' => trim($_POST['tbxCantidad']),
	'idAutoresConcatenados' => $_POST['arrayAutores']);
	
	$response = (int) $client->call('guardarLibro',$param);
	
	if($response == 0){
       //Error almacenando en la BD
       header('location:' . BASEURL . 'application/libro/views/crearLibro.php?m=2');
    }else{
       header('location:' . BASEURL . 'application/libro/views/crearLibro.php?m=3');
    }
	
 }
 
 
 ?>
