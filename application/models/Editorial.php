<?php

/**
 * Clase que maneja la informacion y estructura de Editoriales
 * @autor Pablo Manquillo
 * paarma80@gmail.com
 */
 
 class Editorial {
 	
	private $idEditorial;
    private $descripcion;
	
	
	public function __construct(){
			
		$this->idEditorial = 0;
        $this->descripcion = "";
	}
	
	public function getIdEditorial(){
		return $this->idEditorial;	
	}
	
	public function setIdEditorial($idEditorial){
		$this->idEditorial = $idEditorial;
	}

	public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
	
 }
 
 ?>
