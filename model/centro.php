<?php
class centro {
    protected $id;
    protected $nombre;
    protected $poblacion;
    protected $cp;
    protected $provincia;
    protected $direccion;
    protected $lunes;
    protected $martes;
    protected $miercoles;
    protected $jueves;
    protected $viernes;
    protected $sabado;
    protected $domingo;
    protected $hora_apertura;
    protected $hora_cierre;

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getNombre() {
        return $this->nombre;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    public function getPoblacion() {
        return $this->poblacion;
    }
    public function setPoblacion($poblacion) {
        $this->poblacion = $poblacion;
        return $this;
    }

    public function getCp() {
        return $this->cp;
    }
    public function setCp($cp) {
        $this->cp = $cp;
        return $this;
    }

    public function getProvincia() {
        return $this->provincia;
    }
    public function setProvincia($provincia) {
        $this->provincia = $provincia;
        return $this;
    }

    public function getDireccion() {
        return $this->direccion;
    }
    public function setDireccion($direccion) {
        $this->direccion = $direccion;
        return $this;
    }

    public function getLunes() {
        return $this->lunes;
    }
    public function setLunes($lunes) {
        $this->lunes = $lunes;
        return $this;
    }

    public function getMartes() {
        return $this->martes;
    }
    public function setMartes($martes) {
        $this->martes = $martes;
        return $this;
    }

    public function getMiercoles() {
        return $this->miercoles;
    }
    public function setMiercoles($miercoles) {
        $this->miercoles = $miercoles;
        return $this;
    }

    public function getJueves() {
        return $this->jueves;
    }
    public function setJueves($jueves) {
        $this->jueves = $jueves;
        return $this;
    }

    public function getViernes() {
        return $this->viernes;
    }
    public function setViernes($viernes) {
        $this->viernes = $viernes;
        return $this;
    }

    public function getSabado() {
        return $this->sabado;
    }
    public function setSabado($sabado) {
        $this->sabado = $sabado;
        return $this;
    }

    public function getDomingo() {
        return $this->domingo;
    }
    public function setDomingo($domingo) {
        $this->domingo = $domingo;
        return $this;
    }

    public function getHora_apertura() {
        return $this->hora_apertura;
    }
    public function setHora_apertura($hora_apertura) {
        $this->hora_apertura = $hora_apertura;
        return $this;
    }

    public function getHora_cierre() {
        return $this->hora_cierre;
    }
    public function setHora_cierre($hora_cierre) {
        $this->hora_cierre = $hora_cierre;
        return $this;
    }
}
?>