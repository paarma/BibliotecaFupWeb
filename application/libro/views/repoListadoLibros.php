<!DOCTYPE html>
<html>

<head>

</head>

<body>

<h3>FUNDACION UNIVERSITARIA DE POPAYAN</h3>
<h3>Reporte: Listado de libros</h3>

  <table border="1" bordercolor="#000000">
  <!-- bgcolor="#ECF6FC" -->
      <th bgcolor="#0E0EC0" aling="center">TITULO</th>
      <th bgcolor="#0E0EC0" aling="center">VALOR</th>
      <th bgcolor="#0E0EC0" aling="center">ADQUISICION</th>
      <th bgcolor="#0E0EC0" aling="center">ISBN</th>
      <th bgcolor="#0E0EC0" aling="center">RADICADO</th>
      <th bgcolor="#0E0EC0" aling="center">FECHA INGRESO</th>
      <th bgcolor="#0E0EC0" aling="center">COD. TOPOGRAFICO</th>
      <th bgcolor="#0E0EC0" aling="center">SERIE</th>
      <th bgcolor="#0E0EC0" aling="center">SEDE</th>
      <th bgcolor="#0E0EC0" aling="center">EDITORIAL</th>
      <th bgcolor="#0E0EC0" aling="center">AREA</th>
      <th bgcolor="#0E0EC0" aling="center">A&Ntilde;O</th>
      <th bgcolor="#0E0EC0" aling="center">TEMAS</th>
      <th bgcolor="#0E0EC0" aling="center">PAGINAS</th>
      <th bgcolor="#0E0EC0" aling="center">CIUDAD</th>
      <th bgcolor="#0E0EC0" aling="center">CANTIDAD</th>
      
  <?php
  $iterator = new ArrayIterator($listaLibros);
  if($iterator->count()>0){
     while($iterator->valid()){
       echo '<tr>';
       echo '<td>'.$iterator->current()->getTitulo().'</td>';
	   echo '<td>'.$iterator->current()->getValor().'</td>';
	   echo '<td>'.$iterator->current()->getAdquisicion().'</td>';
	   echo '<td>'.$iterator->current()->getIsbn().'</td>';
	   echo '<td>'.$iterator->current()->getRadicado().'</td>';
	   
	   if($iterator->current()->getFechaIngreso() != null){
	   		echo '<td>'.$iterator->current()->getFechaIngreso().'</td>';
	   }else{
	   		echo '<td></td>';
	   }
	   
	   echo '<td>'.$iterator->current()->getCodigoTopografico().'</td>';
	   echo '<td>'.$iterator->current()->getSerie().'</td>';
	   
	   if($iterator->current()->getSede() != null){
	   		echo '<td>'.$iterator->current()->getSede()->getDescripcion().'</td>';
	   }else{
	   		echo '<td></td>';
	   }
	   
	   if($iterator->current()->getEditorial() != null){
	   		echo '<td>'.$iterator->current()->getEditorial()->getDescripcion().'</td>';
	   }else{
	   		echo '<td></td>';
	   }
	   
	   if($iterator->current()->getArea() != null){
	   		echo '<td>'.$iterator->current()->getArea()->getDescripcion().'</td>';
	   }else{
	   		echo '<td></td>';
	   }

	   echo '<td>'.$iterator->current()->getAnio().'</td>';
	   echo '<td>'.$iterator->current()->getTemas().'</td>';
	   echo '<td>'.$iterator->current()->getPaginas().'</td>';
	   
	   if($iterator->current()->getCiudad() != null){
	   		echo '<td>'.$iterator->current()->getCiudad()->getNombre().'</td>';
	   }else{
	   		echo '<td></td>';
	   }
	   
	   echo '<td>'.$iterator->current()->getCantidad().'</td>';
	   
       echo '</tr>';
       $iterator->next();
     }
  }

  ?> 
      
  </table>

</body>
</html>