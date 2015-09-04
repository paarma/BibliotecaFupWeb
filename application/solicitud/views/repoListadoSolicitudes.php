<?php

// Se crea el objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Se asignan las propiedades del libro excel. (Datos que se visualizan al dar  “Clic derecho > Propiedades > Detalles”)
$objPHPExcel->getProperties()->setCreator("BibliotecaFUP") // Nombre del autor
    ->setLastModifiedBy("BibliotecaFUP") //Ultimo usuario que lo modificó
    ->setTitle("Reporte Excel BibliotecaFUP") // Titulo
    ->setSubject("Reporte Excel BibliotecaFUP") //Asunto
    ->setDescription("Reporte de Reservas") //Descripción
    ->setKeywords("reporte reserva libros FUP") //Etiquetas
    ->setCategory("Reporte excel"); //Categorias
    
    
$tituloReporte = "FUNDACION UNIVERSITARIA DE POPAYAN";
$subtituloReporte = "Reporte: Listado de reservas";
$titulosColumnas = array('LIBRO', 'NOMBRES USUARIO', 'APELLIDOS USUARIO', 'COD. USUARIO',
 	'FECHA SOLICITUD', 'FECHA RESERVA',	'FECHA ENTREGA', 'ESTADO');    

// Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:D1');

// Se agregan los titulos del reporte
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1',$tituloReporte) // Titulo del reporte
    ->setCellValue('A2',$subtituloReporte) // Titulo del reporte
    ->setCellValue('A4',  $titulosColumnas[0])  //Titulo de las columnas
    ->setCellValue('B4',  $titulosColumnas[1])
    ->setCellValue('C4',  $titulosColumnas[2])
    ->setCellValue('D4',  $titulosColumnas[3])
    ->setCellValue('E4',  $titulosColumnas[4])
    ->setCellValue('F4',  $titulosColumnas[5])
    ->setCellValue('G4',  $titulosColumnas[6])
	->setCellValue('H4',  $titulosColumnas[7]);
	

//Se agregan los datos de las solicitudes
 
 $i = 5; //Numero de fila donde se va a comenzar a escribir los datos
 
  $iterator = new ArrayIterator($listaSolicitudes);
  if($iterator->count()>0){
     while($iterator->valid()){
     	
	   $libro = "";
	   if($iterator->current()->getLibro() != null){
			$libro = $iterator->current()->getLibro()->getTitulo();
	   }
	   
	   $nombreUser = "";
	   $apellidoUser = "";
	   $codigoUser = "";
	   if($iterator->current()->getUsuario() != null){
			$nombreUser = $iterator->current()->getUsuario()->getPrimerNombre();
		    $nombreUser .= $iterator->current()->getUsuario()->getSegundoNombre();
			
			$apellidoUser = $iterator->current()->getUsuario()->getPrimerApellido();
		    $apellidoUser .= $iterator->current()->getUsuario()->getSegundoApellido();
			
			$codigoUser = $iterator->current()->getUsuario()->getCodigo();
	   }
	   
	   $fechaSolicitud = "";
	   if($iterator->current()->getFechaSolicitud() != null){
			$fechaSolicitud = $iterator->current()->getFechaSolicitud();
	   }
	   	   
	   $fechaReserva = "";
	   if($iterator->current()->getFechaReserva() != null){
			$fechaReserva = $iterator->current()->getFechaReserva();
	   }
	   
	   $fechaEntrega = "";
	   if($iterator->current()->getFechaEntrega() != null){
			$fechaEntrega = $iterator->current()->getFechaEntrega();
	   }	 
		 
		$objPHPExcel->setActiveSheetIndex(0)
         ->setCellValue('A'.$i, $libro)
		 ->setCellValue('B'.$i, $nombreUser)
		 ->setCellValue('C'.$i, $apellidoUser)
		 ->setCellValue('D'.$i, $codigoUser)
		 ->setCellValue('E'.$i, $fechaSolicitud)
		 ->setCellValue('F'.$i, $fechaReserva)
		 ->setCellValue('G'.$i, $fechaEntrega)
		 ->setCellValue('H'.$i, $iterator->current()->getEstado());
     
     	$i++;
        $iterator->next();
     }
  }


//Formato para las celdas (Estilos)
include_once(BASEPATH . 'library/stylleCellExcel.php');

//Se aplican los formatos
$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A4:H4')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A5:H".($i-1));


//Se fija el ancho de las columnas A-C
for($i = 'A'; $i <= 'C'; $i++){
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setWidth(32);
}

//Se fija el ancho de las columnas D-H
for($i = 'D'; $i <= 'H'; $i++){
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setWidth(18);
}


// Se asigna el nombre a la hoja
$objPHPExcel->getActiveSheet()->setTitle('Reservas');
 
// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
$objPHPExcel->setActiveSheetIndex(0);
 
// Inmovilizar paneles
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

// Se manda el archivo en formato 2007
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
	    
?>    