<?php

// Se crea el objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Se asignan las propiedades del libro excel. (Datos que se visualizan al dar  “Clic derecho > Propiedades > Detalles”)
$objPHPExcel->getProperties()->setCreator("BibliotecaFUP") // Nombre del autor
    ->setLastModifiedBy("BibliotecaFUP") //Ultimo usuario que lo modificó
    ->setTitle("Reporte Excel BibliotecaFUP") // Titulo
    ->setSubject("Reporte Excel BibliotecaFUP") //Asunto
    ->setDescription("Reporte de libros") //Descripción
    ->setKeywords("reporte libros FUP") //Etiquetas
    ->setCategory("Reporte excel"); //Categorias
    
    
$tituloReporte = "FUNDACION UNIVERSITARIA DE POPAYAN";
$subtituloReporte = "Reporte: Listado de libros";
$titulosColumnas = array('TITULO', 'VALOR', 'ADQUISICION', 'ISBN', 'RADICADO', 'FECHA INGRESO',
	'COD. TOPOGRAFICO', 'SERIE', 'SEDE', 'EDITORIAL', 'AREA', 'AÑO', 'TEMAS',
	'PAGINAS', 'CIUDAD', 'ACTIVO');

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
	->setCellValue('H4',  $titulosColumnas[7])
	->setCellValue('I4',  $titulosColumnas[8])
	->setCellValue('J4',  $titulosColumnas[9])
	->setCellValue('K4',  $titulosColumnas[10])
	->setCellValue('L4',  $titulosColumnas[11])
	->setCellValue('M4',  $titulosColumnas[12])
	->setCellValue('N4',  $titulosColumnas[13])
	->setCellValue('O4',  $titulosColumnas[14])
	->setCellValue('P4',  $titulosColumnas[15]);
	

//Se agregan los datos de los libros
 
 $i = 5; //Numero de fila donde se va a comenzar a escribir los datos
 
  $iterator = new ArrayIterator($listaLibros);
  if($iterator->count()>0){
     while($iterator->valid()){
     	
	   $fechaIngreso = "";
	   if($iterator->current()->getFechaIngreso() != null){
			$fechaIngreso = $iterator->current()->getFechaIngreso();
	   }
	   
	   $sede = "";
	   if($iterator->current()->getSede() != null){
			$sede = $iterator->current()->getSede()->getDescripcion();
	   }
	   
	   $editorial = "";
	   if($iterator->current()->getEditorial() != null){
			$editorial = $iterator->current()->getEditorial()->getDescripcion();
	   }
	   
	   $area = "";
	   if($iterator->current()->getArea() != null){
			$area = $iterator->current()->getArea()->getDescripcion();
	   }
	   
	   $ciudad = "";
	   if($iterator->current()->getCiudad() != null){
			$ciudad = $iterator->current()->getCiudad()->getNombre();
	   }
		 
		 
		$objPHPExcel->setActiveSheetIndex(0)
         ->setCellValue('A'.$i, $iterator->current()->getTitulo())
		 ->setCellValue('B'.$i, $iterator->current()->getValor())
		 ->setCellValue('C'.$i, $iterator->current()->getAdquisicion())
		 ->setCellValue('D'.$i, $iterator->current()->getIsbn())
		 ->setCellValue('E'.$i, $iterator->current()->getRadicado())
		 ->setCellValue('F'.$i, $fechaIngreso)
		 ->setCellValue('G'.$i, $iterator->current()->getCodigoTopografico())
		 ->setCellValue('H'.$i, $iterator->current()->getSerie())
		 ->setCellValue('I'.$i, $sede)
		 ->setCellValue('J'.$i, $editorial)
		 ->setCellValue('K'.$i, $area)
		 ->setCellValue('L'.$i, $iterator->current()->getAnio())
		 ->setCellValue('M'.$i, $iterator->current()->getTemas())
		 ->setCellValue('N'.$i, $iterator->current()->getPaginas())
		 ->setCellValue('O'.$i, $ciudad)
		 ->setCellValue('P'.$i, $iterator->current()->getDisponibilidad());
     
     	$i++;
        $iterator->next();
     }
  }
  
//Formato para las celdas (Estilos)
include_once(BASEPATH . 'library/stylleCellExcel.php');

//Se aplican los formatos
$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A4:P4')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A5:P".($i-1));

//Se fija el ancho de las columnas
for($i = 'A'; $i <= 'P'; $i++){
    //$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setWidth(18);
}


// Se asigna el nombre a la hoja
$objPHPExcel->getActiveSheet()->setTitle('Libros');
 
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