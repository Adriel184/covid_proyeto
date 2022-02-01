<?php
class recibe{
    protected $tis;
    protected $id_vacuna;
    protected $fecha;
    protected $dosis;

    public function getTis() {
        return $this->tis;
    }
    public function setTis($tis) {
        $this->tis = $tis;
        return $this;
    }

    public function getId_vacuna() {
        return $this->id_vacuna;
    }
    public function setId_vacuna($id_vacuna) {
        $this->id_vacuna = $id_vacuna;
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
}
?>