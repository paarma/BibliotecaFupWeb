<?php

/**
 * Clase que maneja la informacion y estructura de Sede
 * @autor Pablo Manquillo
 * paarma80@gmail.com
 */
 
 class Sede implements JsonSerializable {
 	
	private $idSede;
    private $descripcion;
	
	
	public function __construct(){
			
		$this->idSede = 0;
        $this->descripcion = "";
	}
	
	// function called when encoded with json_encode
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
	
	
    //Getters ans setters
	public function getIdSede(){
		return $this->idSede;	
	}
	
	public function setIdSede($idSede){
		$this->idSede = $idSede;
	}

	public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
	
 }
 
 ?>
