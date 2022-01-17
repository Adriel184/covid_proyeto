<?php

include_once ("paciente.php");
include_once ("connect_data.php");

class paciente_model extends paciente {

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

    public function loginPaciente() {

        $this->OpenConnect();

        $response=array();

        $sql = "SELECT * FROM paciente WHERE tis=$this->tis AND fecha_nac='$this->fecha_nac' AND apellido='$this->apellido'";
        $result = $this->link->query($sql);
        $response["logged"] = false;
        
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $response["logged"] = true;
        }

        mysqli_free_result($result);
        $this->CloseConnect();
        if ($response["logged"]) {
            $response["paciente"] = $this->getPaciente();
        }
        return $response;
    }


    public function getPaciente(){

        $this->OpenConnect();

        $sql = "SELECT * FROM paciente WHERE tis=$this->tis";
        $result = $this->link->query($sql);        
        
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $paciente = new paciente_model();
            $paciente->tis=$row['tis'];
            $paciente->nombre=$row['nombre'];
            $paciente->apellido=$row['apellido'];
            $paciente->fecha_nac=$row['fecha_nac'];
            $paciente->fecha_pcr_pstv=$row['fecha_pcr'];
        }

        mysqli_free_result($result);
        $this->CloseConnect();

        return $paciente;

    }


    public function getPacientes(){

        $this->OpenConnect();
        $sql = "SELECT * FROM pacientes";
        $result = $this->link->query($sql);
        
        $pacientes=array();
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {         
            //FILL LIST with all families
            $paciente=new paciente_model();
            $paciente->tis=$row['tis'];
            $paciente->nombre=$row['nombre'];
            $paciente->apellidos=$row['apellidos'];
            $paciente->fecha_nac=$row['fecha_nac'];
            $paciente->fecha_pcr_pstv=$row['fecha_pcr_pstv'];

            //$arrmov = (array) $movimiento;
            
            array_push($pacientes, $paciente);   
        }
        mysqli_free_result($result);
        $this->CloseConnect();
        return $pacientes;

    }

}