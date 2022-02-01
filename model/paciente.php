<?php
class paciente {
    protected $tis;
    protected $nombre;
    protected $apellido;
    protected $fecha_nac;
    protected $fecha_pcr_pstv;
    protected $id_centro;
    
    public function getTis() {
        return $this->tis;
    }
    public function setTis($tis) {
        $this->tis = $tis;
        return $this;
    }

    public function getNombre() {
        return $this->nombre;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    public function getApellido() {
        return $this->apellido;
    }
    public function setApellido($apellido) {
        $this->apellido = $apellido;
        return $this;
    }

    public function getFecha_nac() {
        return $this->fecha_nac;
    }
    public function setFecha_nac($fecha_nac) {
        $this->fecha_nac = $fecha_nac;
        return $this;
    }

    public function getRole() {
        return $this->role;
    }
    public function setRole($role) {
        $this->role = $role;
        return $this;
    }

    public function getFecha_pcr_pstv() {
        return $this->fecha_pcr_pstv;
    }
    public function setFecha_pcr_pstv($fecha_pcr_pstv) {
        $this->fecha_pcr_pstv = $fecha_pcr_pstv;
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