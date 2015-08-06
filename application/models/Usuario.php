<?php

/**
 * Clase que maneja la informacion y estructura de los usuarios del sistema
 * @autor Pablo Manquillo
 * paarma80@gmail.com
 */
 
 class Usuario {
 	
	private $idUsuario;
    private $cedula;
    private $primerNombre;
    private $segundoNombre;
    private $primerApellido;
    private $segundoApellido;
    private $telefono;
    private $direccion;
    private $email;
    private $codigo;
    private $clave;
    private $rol;
	
	
	public function __construct(){
			
		$this->idUsuario = 0;
        $this->cedula = 0;
        $this->primerNombre = "";
        $this->segundoNombre = "";
        $this->primerApellido = "";
        $this->segundoApellido = "";
        $this->telefono = 0;
        $this->direccion = "";
        $this->email = "";
        $this->codigo = "";
        $this->clave = "";
        $this->rol = "";
	}
	
	public function getIdUsuario(){
		return $this->idUsuario;	
	}
	
	public function setIdUsuario($idUsuario){
		$this->idUsuario = $idUsuario;
	}
	
	public function getCedula() {
        return $this->cedula;
    }

    public function setCedula($cedula) {
        $this->cedula = $cedula;
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
	
	public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
	
	public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }
	
	public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
	
	public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }
	
	public function getClave() {
        return $this->clave;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }
	
	public function getRol() {
        return $this->rol;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }
	
 }
 
 ?>
