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
 		
	 	case 'cargarDatosLibroSeleccionado':
			echo json_encode($_SESSION['libroSeleccionadoAdmin']);
		break;
		
		case 'cargarAutoresAsociados':
			
			$idLibro = $_POST['idLibro'];
			
			$param = array('idLibro' => $idLibro);
			$response = $client->call('listadoLibroAutor',$param);
			
			echo json_encode($response);
		break;		
	}
 }			
 
  //Guardando libro
 if (isset($_POST['accionFormLibro']) && $_POST['accionFormLibro'] == 'guardar') {
 	
	$fechaActual = date("Y-m-d"); 
	
	//En caso de existir idLibro, se edita, de lo contrario almacena.
	if(isset($_SESSION['libroSeleccionadoAdmin']) && $_SESSION['libroSeleccionadoAdmin'] != null){
		$idLibro = $_SESSION['libroSeleccionadoAdmin']->getIdLibro();
	}else{
		$idLibro = 0;
	}
	
	
	$param = array('idLibro' => (int) $idLibro, 'titulo' => strtoupper(trim($_POST['tbxTitulo'])), 
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
	
	//Se inicializa la variable libroSeleccionado
	$_SESSION['libroSeleccionadoAdmin'] = null;
	
	if($response == 0){
       //Error almacenando en la BD
       header('location:' . BASEURL . 'application/libro/views/crearLibro.php?m=2');
    }else{
       header('location:' . BASEURL . 'application/libro/views/crearLibro.php?m=3');
    }
	
 }

//Reporte listadoLibros
if(isset($_POST['accionFormReporte']) && $_POST['accionFormReporte'] == 'reporteListadoLibros'){
					
	$nombreReporte = "LibrosFUP";

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
		
		$response = $client->call('listadoLibros',$param);
	
	 $listaLibros = array();
	 //$listaLibros = new ArrayObject();
	 		
	 if(count($response) > 0 ){
	 	foreach($response as $item){
	 		//echo $item['TITULO'];
	 		$libro = obtenerLibroSoap($item);
			//$listaLibros->append($libro); //para el caso de ArrayObject
			$listaLibros[] = $libro;
	 	}
	 }
	
	require_once BASEPATH . 'library/export_excel.php';
	include_once(BASEPATH . 'application/libro/views/repoListadoLibros.php');
	
}
 
 
 ?>
