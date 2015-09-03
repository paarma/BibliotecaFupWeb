<?php

/**
 * Function autoload de PHP especifico para la inclusion dinamica de las clases (modelo) utilizadas
 * Esta funcion evita incluir cada clase de manera individial
 * Esta funcion la llama automaticamente PHP al referenciar una clase.
 */
 
 function __autoload($className){
 	//require_once $_SERVER["DOCUMENT_ROOT"]."/BibliotecaFupWeb/application/models/".$className.".php";
 	
 	  if (file_exists($_SERVER["DOCUMENT_ROOT"]."/BibliotecaFupWeb/application/models/".$className.".php")) {
          require_once $_SERVER["DOCUMENT_ROOT"]."/BibliotecaFupWeb/application/models/".$className.".php";
          return true;
      }
      return false;
 }

?>