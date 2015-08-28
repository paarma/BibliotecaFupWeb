<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>

<h3>FUNDACION UNIVERSITARIA DE POPAYAN</h3>
<h3>Reporte: Listado de reservas</h3>

  <table border="1" bordercolor="#000000">
  <!-- bgcolor="#ECF6FC" -->
      <th bgcolor="#0E0EC0" aling="center">LIBRO</th>
      <th bgcolor="#0E0EC0" aling="center">NOMBRES USUARIO</th>
      <th bgcolor="#0E0EC0" aling="center">APELLIDOS USUARIO</th>
      <th bgcolor="#0E0EC0" aling="center">COD. USUARI</th>
      <th bgcolor="#0E0EC0" aling="center">FECHA SOLICITUD</th>
      <th bgcolor="#0E0EC0" aling="center">FECHA RESERVA</th>
      <th bgcolor="#0E0EC0" aling="center">FECHA ENTREGA</th>
      <th bgcolor="#0E0EC0" aling="center">ESTADO</th>
      
  <?php
  $iterator = new ArrayIterator($listaSolicitudes);
  if($iterator->count()>0){
     while($iterator->valid()){
       echo '<tr>';
	   
	   if($iterator->current()->getLibro() != null){
	   		echo '<td>'.$iterator->current()->getLibro()->getTitulo().'</td>';
	   }else{
	   		echo '<td></td>';
	   }
	   
	   if($iterator->current()->getUsuario() != null){
	   		
		   $nombre = $iterator->current()->getUsuario()->getPrimerNombre()." ";
		   $nombre .= $iterator->current()->getUsuario()->getSegundoNombre();
		
	   		echo '<td>'.$nombre.'</td>';
	   }else{
	   		echo '<td></td>';
	   }
	   
	   if($iterator->current()->getUsuario() != null){
	   		
		   $apellido = $iterator->current()->getUsuario()->getPrimerApellido()." ";
		   $apellido .= $iterator->current()->getUsuario()->getSegundoApellido();
		
	   		echo '<td>'.$apellido.'</td>';
	   }else{
	   		echo '<td></td>';
	   }
	   
	   if($iterator->current()->getUsuario() != null){
	   		echo '<td>'.$iterator->current()->getUsuario()->getCodigo().'</td>';
	   }else{
	   		echo '<td></td>';
	   }
	   
	   if($iterator->current()->getFechaSolicitud() != null){
	   		echo '<td>'.$iterator->current()->getFechaSolicitud().'</td>';
	   }else{
	   		echo '<td></td>';
	   }
	   
	   if($iterator->current()->getFechaReserva() != null){
	   		echo '<td>'.$iterator->current()->getFechaReserva().'</td>';
	   }else{
	   		echo '<td></td>';
	   }

	   if($iterator->current()->getFechaEntrega() != null){
	   		echo '<td>'.$iterator->current()->getFechaEntrega().'</td>';
	   }else{
	   		echo '<td></td>';
	   }
	   
	   echo '<td>'.$iterator->current()->getEstado().'</td>';
	   
       echo '</tr>';
       $iterator->next();
     }
  }

  ?> 
      
  </table>

</body>
</html>