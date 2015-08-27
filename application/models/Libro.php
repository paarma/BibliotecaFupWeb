<?php

/**
 * Clase que maneja la informacion y estructura de Libro
 * @autor Pablo Manquillo
 * paarma80@gmail.com
 */
 
 class Libro implements JsonSerializable {
 	
    private $idLibro;
    private $titulo;
    private $valor;
    private $adquisicion;
    private $estado;
    private $isbn;
    private $radicado;
    private $fechaIngreso; //Date
    private $codigoTopografico;
    private $serie;
    private $sede; //Object
    private $editorial; //Object
    private $area; //Object
    private $anio;
    private $temas;
    private $paginas;
    private $disponibilidad;
    private $idUsuario; //Usuario que registra el libro en la biblioteca
    private $ciudad; //Object
    private $cantidad;
	
	//Transient
    // Utilizado para la busqueda de libros por Autor (LIBRO_AUTOR)
    private $idAutor;
	
	
	public function __construct(){
			
        $this->idLibro = 0;
        $this->titulo = "";
        $this->valor = 0;
        $this->adquisicion = "";
        $this->estado = "";
        $this->isbn = "";
        $this->radicado = "";
        $this->fechaIngreso = null;
        $this->codigoTopografico = "";
        $this->serie = "";
        $this->sede = null;
        $this->editorial = null;
        $this->area = null;
        $this->anio = 0;
        $this->temas = "";
        $this->paginas = 0;
        $this->disponibilidad = "";
        $this->idUsuario = 0;
        $this->ciudad = null;
        $this->cantidad = 0;
		
		 //Transient
        $this->idAutor = 0;
	}
	
	
	// function called when encoded with json_encode
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
	
	
    //Getters ans setters		
	public function getIdLibro() {
        return $this->idLibro;
    }

    public function setIdLibro($idLibro) {
        $this->idLibro = $idLibro;
    }
	
	public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function getAdquisicion() {
        return $this->adquisicion;
    }

    public function setAdquisicion($adquisicion) {
        $this->adquisicion = $adquisicion;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    public function getRadicado() {
        return $this->radicado;
    }

    public function setRadicado($radicado) {
        $this->radicado = $radicado;
    }

    public function getFechaIngreso() {
        return $this->fechaIngreso;
    }

    public function setFechaIngreso($fechaIngreso) {
        $this->fechaIngreso = $fechaIngreso;
    }

    public function getCodigoTopografico() {
        return $this->codigoTopografico;
    }

    public function setCodigoTopografico($codigoTopografico) {
        $this->codigoTopografico = $codigoTopografico;
    }

    public function getSerie() {
        return $this->serie;
    }

    public function setSerie($serie) {
        $this->serie = $serie;
    }

    public function getSede() {
        return $this->sede;
    }

    public function setSede($sede) {
        $this->sede = $sede;
    }

    public function getEditorial() {
        return $this->editorial;
    }

    public function setEditorial($editorial) {
        $this->editorial = $editorial;
    }

    public function getArea() {
        return $this->area;
    }

    public function setArea($area) {
        $this->area = $area;
    }

    public function getAnio() {
        return $this->anio;
    }

    public function setAnio($anio) {
        $this->anio = $anio;
    }

    public function getTemas() {
        return $this->temas;
    }

    public function setTemas($temas) {
        $this->temas = $temas;
    }

    public function getPaginas() {
        return $this->paginas;
    }

    public function setPaginas($paginas) {
        $this->paginas = $paginas;
    }

    public function getDisponibilidad() {
        return $this->disponibilidad;
    }

    public function setDisponibilidad($disponibilidad) {
        $this->disponibilidad = $disponibilidad;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function getCiudad() {
        return $this->ciudad;
    }

    public function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function getIdAutor() {
        return $this->idAutor;
    }

    public function setIdAutor($idAutor) {
        $this->idAutor = $idAutor;
    }
	
 }
 
 ?>
