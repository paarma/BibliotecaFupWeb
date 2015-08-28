<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>

<h3>FUNDACION UNIVERSITARIA DE POPAYAN</h3>
<h3>Reporte: Listado de usuarios</h3>

  <table border="1" bordercolor="#000000">
  <!-- bgcolor="#ECF6FC" -->
      <th bgcolor="#0E0EC0" aling="center">No. IDENTIFICACION</th>
      <th bgcolor="#0E0EC0" aling="center">NOMBRES</th>
      <th bgcolor="#0E0EC0" aling="center">APELLIDOS</th>
      <th bgcolor="#0E0EC0" aling="center">TELEFONO</th>
      <th bgcolor="#0E0EC0" aling="center">DIRECCION</th>
      <th bgcolor="#0E0EC0" aling="center">EMAIL</th>
      <th bgcolor="#0E0EC0" aling="center">CODIGO</th>
      <th bgcolor="#0E0EC0" aling="center">ROL</th>
      
  <?php
  $iterator = new ArrayIterator($listaUsuarios);
  if($iterator->count()>0){
     while($iterator->valid()){
       echo '<tr>';
       echo '<td>'.$iterator->current()->getCedula().'</td>';
	   
	   $nombres = $iterator->current()->getPrimerNombre()." ".$iterator->current()->getSegundoNombre();
	   echo '<td>'.$nombres.'</td>';
	   
	   $apellidos = $iterator->current()->getPrimerApellido()." ".$iterator->current()->getSegundoApellido();
	   echo '<td>'.$apellidos.'</td>';
	   
	   echo '<td>'.$iterator->current()->getTelefono().'</td>';
	   echo '<td>'.$iterator->current()->getDireccion().'</td>';
	   echo '<td>'.$iterator->current()->getEmail().'</td>';
	   echo '<td>'.$iterator->current()->getCodigo().'</td>';
	   echo '<td>'.$iterator->current()->getRol().'</td>';   
       echo '</tr>';
       $iterator->next();
     }
  }

  ?> 
      
  </table>

</body>
</html>