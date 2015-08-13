<?php

/**
 * Clase que maneja la informacion y estructura de Autor
 * @autor Pablo Manquillo
 * paarma80@gmail.com
 */
 
 class Autor implements JsonSerializable {
 	
	private $idAutor;
    private $primerNombre;
	private $segundoNombre;
	private $primerApellido;
	private $segundoApellido;
	private $tipoAutor;
	
	
	public function __construct(){
			
		$this->idAutor = 0;
        $this->primerNombre = "";
		$this->segundoNombre = "";
		$this->primerApellido = "";
		$this->segundoApellido = "";
		$this->tipoAutor = "";
	}
	
	// function called when encoded with json_encode
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
	
	
    //Getters ans setters
	public function getIdAutor(){
		return $this->idAutor;	
	}
	
	public function setIdAutor($idAutor){
		$this->idAutor = $idAutor;
	}

	public function getPrimerNombre() {
        return $this->primerNombre;
    }

    public function setPrimerNombre($primerNombre) {
        $this->primerNombre = $primerNombre;
    }
	
	public function getSegundoNombre() {
        return $this->segundoNombre;
    }

    public function setSegundoNombre($segundoNombre) {
        $this->segundoNombre = $segundoNombre;
    }
	
	public function getPrimerApellido() {
        return $this->primerApellido;
    }

    public function setPrimerApellido($primerApellido) {
        $this->primerApellido = $primerApellido;
    }
	
	public function getSegundoApellido() {
        return $this->segundoApellido;
    }

    public function setSegundoApellido($segundoApellido) {
        $this->segundoApellido = $segundoApellido;
    }
	
	public function getTipoAutor() {
        return $this->tipoAutor;
    }

    public function setTipoAutor($tipoAutor) {
        $this->tipoAutor = $tipoAutor;
    }
	
 }
 
 ?>
