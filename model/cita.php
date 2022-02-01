<?php
class cita {
    protected $id;
    protected $fecha;
    protected $dosis;
    protected $tis;
    protected $id_centro;
    
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getFecha() {
        return $this->fecha;
    }
    public function setFecha($fecha) {
        $this->fecha = $fecha;
        return $this;
    }

    public function getDosis() {
        return $this->dosis;
    }
    public function setDosis($dosis) {
        $this->dosis = $dosis;
        return $this;
    }

    public function getTis() {
        return $this->tis;
    }
    public function setTis($tis) {
        $this->tis = $tis;
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