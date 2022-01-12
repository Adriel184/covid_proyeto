<?php
class centro {
    private $id;
    private $nombre;
    private $poblacion;
    private $cp;
    private $provincia;
    private $direccion;
    private $lunes;
    private $martes;
    private $miercoles;
    private $jueves;
    private $viernes;
    private $sabado;
    private $domingo;
    private $hora_apertura;
    private $hora_cierre;
    
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
     * Get the value of poblacion
     */ 
    public function getPoblacion()
    {
        return $this->poblacion;
    }

    /**
     * Set the value of poblacion
     *
     * @return  self
     */ 
    public function setPoblacion($poblacion)
    {
        $this->poblacion = $poblacion;

        return $this;
    }

    /**
     * Get the value of cp
     */ 
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set the value of cp
     *
     * @return  self
     */ 
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get the value of provincia
     */ 
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set the value of provincia
     *
     * @return  self
     */ 
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get the value of direccion
     */ 
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */ 
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get the value of lunes
     */ 
    public function getLunes()
    {
        return $this->lunes;
    }

    /**
     * Set the value of lunes
     *
     * @return  self
     */ 
    public function setLunes($lunes)
    {
        $this->lunes = $lunes;

        return $this;
    }

    /**
     * Get the value of martes
     */ 
    public function getMartes()
    {
        return $this->martes;
    }

    /**
     * Set the value of martes
     *
     * @return  self
     */ 
    public function setMartes($martes)
    {
        $this->martes = $martes;

        return $this;
    }

    /**
     * Get the value of miercoles
     */ 
    public function getMiercoles()
    {
        return $this->miercoles;
    }

    /**
     * Set the value of miercoles
     *
     * @return  self
     */ 
    public function setMiercoles($miercoles)
    {
        $this->miercoles = $miercoles;

        return $this;
    }

    /**
     * Get the value of jueves
     */ 
    public function getJueves()
    {
        return $this->jueves;
    }

    /**
     * Set the value of jueves
     *
     * @return  self
     */ 
    public function setJueves($jueves)
    {
        $this->jueves = $jueves;

        return $this;
    }

    /**
     * Get the value of viernes
     */ 
    public function getViernes()
    {
        return $this->viernes;
    }

    /**
     * Set the value of viernes
     *
     * @return  self
     */ 
    public function setViernes($viernes)
    {
        $this->viernes = $viernes;

        return $this;
    }

    /**
     * Get the value of sabado
     */ 
    public function getSabado()
    {
        return $this->sabado;
    }

    /**
     * Set the value of sabado
     *
     * @return  self
     */ 
    public function setSabado($sabado)
    {
        $this->sabado = $sabado;

        return $this;
    }

    /**
     * Get the value of domingo
     */ 
    public function getDomingo()
    {
        return $this->domingo;
    }

    /**
     * Set the value of domingo
     *
     * @return  self
     */ 
    public function setDomingo($domingo)
    {
        $this->domingo = $domingo;

        return $this;
    }

    /**
     * Get the value of hora_apertura
     */ 
    public function getHora_apertura()
    {
        return $this->hora_apertura;
    }

    /**
     * Set the value of hora_apertura
     *
     * @return  self
     */ 
    public function setHora_apertura($hora_apertura)
    {
        $this->hora_apertura = $hora_apertura;

        return $this;
    }

    /**
     * Get the value of hora_cierre
     */ 
    public function getHora_cierre()
    {
        return $this->hora_cierre;
    }

    /**
     * Set the value of hora_cierre
     *
     * @return  self
     */ 
    public function setHora_cierre($hora_cierre)
    {
        $this->hora_cierre = $hora_cierre;

        return $this;
    }
}