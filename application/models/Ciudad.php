<?php

/**
 * Clase que maneja la informacion y estructura de Ciudad
 * @autor Pablo Manquillo
 * paarma80@gmail.com
 */
 
 class Ciudad implements JsonSerializable {
 	
	private $idCiudad;
    private $nombre;
	private $pais;
	
	
	public function __construct(){
			
		$this->idCiudad = 0;
        $this->nombre = "";
		$this->pais = null;
	}
	
	// function called when encoded with json_encode
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
	
	
    //Getters ans setters
	public function getIdCiudad(){
		return $this->idCiudad;	
	}
	
	public function setIdCiudad($idCiudad){
		$this->idCiudad = $idCiudad;
	}

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getPais() {
        return $this->pais;
    }

    public function setPais($pais) {
        $this->pais = $pais;
    }
	
 }
 
 ?>
