<?php

// esto le indica al navegador que muestre el diálogo de descarga aún sin haber descargado todo el contenido

if(!isset($nombreReporte)){
  $nombreReporte = "DocentesFUP";
}
 
header("Content-type: application/octet-stream");
//indicamos al navegador que se está devolviendo un archivo
header("Content-Disposition: attachment; filename=".$nombreReporte.".xls");
//con esto evitamos que el navegador lo grabe en su caché
header("Pragma: no-cache");
header("Expires: 0");

?>