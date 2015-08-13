<?php

/**
 * Clase que maneja la informacion y estructura de Editoriales
 * @autor Pablo Manquillo
 * paarma80@gmail.com
 */
 
 class Editorial implements JsonSerializable {
 	
	private $idEditorial;
    private $descripcion;
	
	
	public function __construct(){
			
		$this->idEditorial = 0;
        $this->descripcion = "";
	}
	
	// function called when encoded with json_encode
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
	
	
    //Getters ans setters
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
