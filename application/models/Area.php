<?php

/**
 * Clase que maneja la informacion y estructura de Area
 * @autor Pablo Manquillo
 * paarma80@gmail.com
 */
 
 class Area implements JsonSerializable {
 	
	private $idArea;
    private $descripcion;
	
	
	public function __construct(){
			
		$this->idArea = 0;
        $this->descripcion = "";
	}
	
	// function called when encoded with json_encode
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
	
	
    //Getters ans setters
	public function getIdArea(){
		return $this->idArea;	
	}
	
	public function setIdArea($idArea){
		$this->idArea = $idArea;
	}

	public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
	
 }
 
 ?>
