<?php

class paciente {
    private $tis;
    private $nombre;
    private $apellido;
    private $fecha_nac;
    private $fecha_pcr_pstv;

    /**
     * Get the value of tis
     */
    public function getTis()
    {
        return $this->tis;
    }

    /**
     * Set the value of tis
     *
     * @return  self
     */ 
    public function setTis($tis)
    {
        $this->tis = $tis;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of apellido
     */ 
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set the value of apellido
     *
     * @return  self
     */ 
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get the value of fecha_nac
     */ 
    public function getFecha_nac()
    {
        return $this->fecha_nac;
    }

    /**
     * Set the value of fecha_nac
     *
     * @return  self
     */ 
    public function setFecha_nac($fecha_nac)
    {
        $this->fecha_nac = $fecha_nac;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of fecha_pcr_pstv
     */ 
    public function getFecha_pcr_pstv()
    {
        return $this->fecha_pcr_pstv;
    }

    /**
     * Set the value of fecha_pcr_pstv
     *
     * @return  self
     */ 
    public function setFecha_pcr_pstv($fecha_pcr_pstv)
    {
        $this->fecha_pcr_pstv = $fecha_pcr_pstv;

        return $this;
    }
}