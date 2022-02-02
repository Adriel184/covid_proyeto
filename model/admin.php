<?php
class admin {
    protected $id;
    protected $usuario;
    protected $nombre;
    protected $apellidos;
    protected $contrasena;
    protected $tipo;
    protected $id_centro;

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getUsuario() {
        return $this->usuario;
    }
    public function setUsuario($usuario) {
        $this->usuario = $usuario;
        return $this;
    }

    public function getNombre() {
        return $this->nombre;
    } 
    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    public function getApellidos() {
        return $this->apellidos;
    }
    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
        return $this;
    }

    public function getContrasena() {
        return $this->contrasena;
    }
    public function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
        return $this;
    }

    public function getTipo() {
        return $this->tipo;
    }
    public function setTipo($tipo) {
        $this->tipo = $tipo;
        return $this;
    }

    public function getId_centro() {
        return $this->id_centro;
    }
    public function setId_centro($id_centro) {
        $this->id_centro = $id_centro;
        return $this;
    }
}
?>