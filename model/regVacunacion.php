<?php

class regVacunacion {
    private $id;
    private $dosis;
    private $fecha;
    private $id_vacuna;
    private $tis;

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
     * Get the value of dosis
     */ 
    public function getDosis()
    {
        return $this->dosis;
    }

    /**
     * Set the value of dosis
     *
     * @return  self
     */ 
    public function setDosis($dosis)
    {
        $this->dosis = $dosis;

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
     * Get the value of id_vacuna
     */ 
    public function getId_vacuna()
    {
        return $this->id_vacuna;
    }

    /**
     * Set the value of id_vacuna
     *
     * @return  self
     */ 
    public function setId_vacuna($id_vacuna)
    {
        $this->id_vacuna = $id_vacuna;

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
}