<?php

/**
 * Clase que maneja la informacion y estructura de Solicitud
 * @autor Pablo Manquillo
 * paarma80@gmail.com
 */
 
 class Solicitud implements JsonSerializable {
 	
    private $idSolicitud;
    private $fechaSolicitud; // Fecha en la  que se realiza la solicitud
    private $fechaReserva; // Fecha para la cual se reserva el libro.

    // Fecha ideal en la cual el usuario deberia regresar el libro.
    // Dos dias mas apartir de la fecha de reserva.
    private $fechaDevolucion;
    private $fechaEntrega; // Fecha  en la cual el usuario entregó el libro.
    private $usuario; // Usuario al cual se le presta el libro.
    private $libro;
    private $estado;
	
	
	public function __construct(){
			
        $this->idSolicitud = 0;
        $this->fechaSolicitud = null;
        $this->fechaReserva = null;
        $this->fechaDevolucion = null;
        $this->fechaEntrega = null;
        $this->usuario = null;
        $this->libro = null;
        $this->estado = "";
	}
	
	
	// function called when encoded with json_encode
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
	
	
    //Getters ans setters
    public function getIdSolicitud() {
        return $this->idSolicitud;
    }

    public function setIdSolicitud($idSolicitud) {
        $this->idSolicitud = $idSolicitud;
    }

    public function getFechaSolicitud() {
        return $this->fechaSolicitud;
    }

    public function setFechaSolicitud($fechaSolicitud) {
        $this->fechaSolicitud = $fechaSolicitud;
    }

    public function getFechaReserva() {
        return $this->fechaReserva;
    }

    public function setFechaReserva($fechaReserva) {
        $this->fechaReserva = $fechaReserva;
    }

    public function getFechaDevolucion() {
        return $this->fechaDevolucion;
    }

    public function setFechaDevolucion($fechaDevolucion) {
        $this->fechaDevolucion = $fechaDevolucion;
    }

    public function getFechaEntrega() {
        return $this->fechaEntrega;
    }

    public function setFechaEntrega($fechaEntrega) {
        $this->fechaEntrega = $fechaEntrega;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getLibro() {
        return $this->libro;
    }

    public function setLibro($libro) {
        $this->libro = $libro;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }
	
 }
 
 ?>
