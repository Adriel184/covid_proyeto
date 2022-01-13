<?php

include_once ("cita.php");
include_once ("connect_data.php");

class cita_model extends cita {

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

    public function getCita(){

        $this->OpenConnect();

        $sql = "CALL spCita('$this->id')";
        $result = $this->link->query($sql);         
        
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        
            $this->id=$row['id'];
            $this->fecha=$row['fecha'];
            $this->dosis=$row['dosis'];
            $this->tis=$row['tis'];

        }

        mysqli_free_result($result);
        $this->CloseConnect();

    }

    public function getCitas(){

        $this->OpenConnect();
        $sql = "SELECT * FROM citas";
        $result = $this->link->query($sql);
        
        $citas=array();
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {         
            //FILL LIST with all families
            $cita=new cita_model();
            $cita->id=$row['id'];
            $cita->fecha=$row['fecha'];
            $cita->dosis=$row['dosis'];
            $cita->tis=$row['tis'];
            $cita->id_centro=$row['id_centro'];

            //$arrmov = (array) $movimiento;

            array_push($citas, $cita);
        }
        mysqli_free_result($result);
        $this->CloseConnect();
        return $citas;

    }

    public function getCitasByTis(){

        $this->OpenConnect();

        $tis = $this->tis;
        $sql = "SELECT * FROM citas WHERE tis='$tis'";
        $result = $this->link->query($sql);
        
        $citas=array();
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {         
            //FILL LIST with all families
            $cita=new cita_model();
            $cita->id=$row['id'];
            $cita->fecha=$row['fecha'];
            $cita->dosis=$row['dosis'];
            $cita->tis=$row['tis'];
            $cita->id_centro=$row['id_centro'];

            //$arrmov = (array) $movimiento;

            array_push($citas, $cita);
        }
        mysqli_free_result($result);
        $this->CloseConnect();
        return $citas;

    }

    public function getCitasByCentro(){

        $this->OpenConnect();

        $id_centro = $this->id_centro;
        $sql = "SELECT * FROM citas WHERE id_centro='$id_centro'";
        $result = $this->link->query($sql);
        
        $citas=array();
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {         
            //FILL LIST with all families
            $cita=new cita_model();
            $cita->id=$row['id'];
            $cita->fecha=$row['fecha'];
            $cita->dosis=$row['dosis'];
            $cita->tis=$row['tis'];
            $cita->id_centro=$row['id_centro'];

            //$arrmov = (array) $movimiento;

            array_push($citas, $cita);
        }
        mysqli_free_result($result);
        $this->CloseConnect();
        return $citas;

    }


    public function addCita(){

        $this->OpenConnect();
        $fecha = $this -> fecha;
        $dosis = $this -> dosis;
        $tis = $this -> tis;
        $id_centro = $this -> id_centro;

        $sql = "INSERT INTO `citas`(`fecha`, `dosis`, `tis`, `id_centro`) VALUES ('$fecha','$dosis','$tis','$id_centro')";

        $result = $this->link->query($sql);

        $this->CloseConnect();
        return $result;

    }


    public function deleteCita(){

        $this->OpenConnect();
        $id = $this -> id;

        $sql = "DELETE FROM `citas` WHERE `id`=$id";

        $result = $this->link->query($sql);

        $this->CloseConnect();
        return $result;
        
    }

}