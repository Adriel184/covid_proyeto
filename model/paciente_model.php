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

    public function login() {

        $this->OpenConnect();

        $sql = "CALL spLoginPaciente('$this->tis', '$this->fech_nac')";
        $result = $this->link->query($sql);
        $loged = false;          
        
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        
        
            $this->tis=$row['tis'];
            $this->nombre=$row['nombre'];
            $this->apellidos=$row['apellidos'];
            $this->fecha_nac=$row['fecha_nac'];
            $this->fecha_pcr_pstv=$row['fecha_pcr_pstv'];

            $loged = true;

        }

        mysqli_free_result($result);
        $this->CloseConnect();
        return $loged;
    }

    public function getPaciente(){

        $this->OpenConnect();

        $sql = "CALL spPaciente('$this->tis')";
        $result = $this->link->query($sql);
        $loged = false;          
        
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        
        
            $this->tis=$row['tis'];
            $this->nombre=$row['nombre'];
            $this->apellidos=$row['apellidos'];
            $this->fecha_nac=$row['fecha_nac'];
            $this->fecha_pcr_pstv=$row['fecha_pcr_pstv'];

            $loged = true;

        }

        mysqli_free_result($result);
        $this->CloseConnect();
        return $loged;

    }

    public function findUser(){
        $this->OpenConnect();
        $username = $this->username;

        $sql = "SELECT * FROM usuarios WHERE username='$username'";
        $result = $this->link->query($sql);

        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            return $row["Exists"] = true;
        }else{
            return $row["Exists"] = false;
        }
        
        $this->CloseConnect();

    }

    public function register(){

        $this->OpenConnect();
        $usuario = $this -> username;
        $password = $this -> password;

        $sql = "INSERT INTO `usuarios`(`username`, `password`) VALUES ('$usuario','$password')";

        $result = $this->link->query($sql);

        $this->CloseConnect();
        return $result;

    }

}