<?php

class cita {
    private $id;
    private $fecha;
    private $dosis;
    private $tis;
    private $id_centro;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of nom_dosis
     */ 
    public function getDosis()
    {
        return $this->dosis;
    }

    /**
     * Set the value of nom_dosis
     *
     * @return  self
     */ 
    public function setDosis($dosis)
    {
        $this->dosis = $dosis;

        return $this;
    }

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
     * Get the value of id_centro
     */ 
    public function getId_centro()
    {
        return $this->id_centro;
    }

    /**
     * Set the value of id_centro
     *
     * @return  self
     */ 
    public function setId_centro($id_centro)
    {
        $this->id_centro = $id_centro;

        return $this;
    }
}