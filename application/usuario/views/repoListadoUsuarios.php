<?php

// Se crea el objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Se asignan las propiedades del libro excel. (Datos que se visualizan al dar  “Clic derecho > Propiedades > Detalles”)
$objPHPExcel->getProperties()->setCreator("BibliotecaFUP") // Nombre del autor
    ->setLastModifiedBy("BibliotecaFUP") //Ultimo usuario que lo modificó
    ->setTitle("Reporte Excel BibliotecaFUP") // Titulo
    ->setSubject("Reporte Excel BibliotecaFUP") //Asunto
    ->setDescription("Reporte de usuarios") //Descripción
    ->setKeywords("reporte usuarios FUP") //Etiquetas
    ->setCategory("Reporte excel"); //Categorias

    
$tituloReporte = "FUNDACION UNIVERSITARIA DE POPAYAN";
$subtituloReporte = "Reporte: Listado de usuarios";
$titulosColumnas = array('No. IDENTIFICACION', 'NOMBRES', 'APELLIDOS', 'TELEFONO', 'DIRECCION',
 	'EMAIL', 'CODIGO', 'ROL');    

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
	

//Se agregan los datos de los usuarios
 
 $i = 5; //Numero de fila donde se va a comenzar a escribir los datos
 
  $iterator = new ArrayIterator($listaUsuarios);
  if($iterator->count()>0){
     while($iterator->valid()){
     	
	   $nombres = $iterator->current()->getPrimerNombre()." ".$iterator->current()->getSegundoNombre();
	   $apellidos = $iterator->current()->getPrimerApellido()." ".$iterator->current()->getSegundoApellido();
		 
		$objPHPExcel->setActiveSheetIndex(0)
         ->setCellValue('A'.$i, $iterator->current()->getCedula())
		 ->setCellValue('B'.$i, $nombres)
		 ->setCellValue('C'.$i, $apellidos)
		 ->setCellValue('D'.$i, $iterator->current()->getTelefono())
		 ->setCellValue('E'.$i, $iterator->current()->getDireccion())
		 ->setCellValue('F'.$i, $iterator->current()->getEmail())
		 ->setCellValue('G'.$i, $iterator->current()->getCodigo())
		 ->setCellValue('H'.$i, $iterator->current()->getRol());
     
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

//Se fija el ancho de las columnas
for($i = 'A'; $i <= 'P'; $i++){
    //$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setWidth(20);
}

//Se aumenta el ancho a las columnas B,C (nombres, apellidos)
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(35);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(35);


// Se asigna el nombre a la hoja
$objPHPExcel->getActiveSheet()->setTitle('Usuarios');

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