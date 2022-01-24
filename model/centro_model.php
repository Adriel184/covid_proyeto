<?php

include_once ("centro.php");
include_once ("connect_data.php");

class centro_model extends centro {

    private $link;  // datu basera lotura - enlace a la bbdd

    public function OpenConnect() {
        $konDat=new connect_data();
        try
        {
            $this->link=new mysqli($konDat->host,$konDat->userbbdd,$konDat->passbbdd,$konDat->ddbbname);
            // mysqli klaseko link objetua sortzen da dagokion konexio datuekin
            // se crea un nuevo objeto llamado link de la clase mysqli con los datos de conexión. 
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
        $this->link->set_charset("utf8"); // honek behartu egiten du aplikazio eta 
                        //databasearen artean UTF -8 erabiltzera datuak trukatzeko
    }                   
          
    public function CloseConnect() {
        mysqli_close ($this->link);
    }  

    /********* FUNCIONES **********/

    public function getCentroById(){

        $this->OpenConnect();

        $id=$this->getId();

        $sql = "SELECT * FROM centro_vacunacion WHERE id=$id";
        $result = $this->link->query($sql);

        $centro=null;
        
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {         

            $centro=new centro_model();
            $centro->setId($row['id']);
            $centro->setNombre($row['nombre']);
            $centro->setPoblacion($row['poblacion']);
            $centro->setCp($row['cp']);
            $centro->setProvincia($row['provincia']);
            $centro->setDireccion($row['direccion']);

            $centro->setLunes($row['lunes']);
            $centro->setMartes($row['martes']);
            $centro->setMiercoles($row['miercoles']);
            $centro->setJueves($row['jueves']);
            $centro->setViernes($row['viernes']);
            $centro->setSabado($row['sabado']);
            $centro->setDomingo($row['domingo']);

            $centro->setHora_apertura($row['hora_apertura']);
            $centro->setHora_cierre($row['hora_cierre']);

        }

        mysqli_free_result($result);
        $this->CloseConnect();
        return get_object_vars($centro);
        
    }

}