<?php

/**
 * Clase que maneja la informacion y estructura de Pais
 * @autor Pablo Manquillo
 * paarma80@gmail.com
 */
 
 class Pais implements JsonSerializable {
 	
	private $idPais;
    private $nombre;
	
	
	public function __construct(){
			
		$this->idPais = 0;
        $this->nombre = "";
	}
	
	// function called when encoded with json_encode
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
	
	
    //Getters ans setters
	public function getIdPais(){
		return $this->idPais;	
	}
	
	public function setIdPais($idPais){
		$this->idPais = $idPais;
	}

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
	
 }
 
 ?>
