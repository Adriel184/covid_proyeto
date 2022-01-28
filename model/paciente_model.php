<?php
if ($_SERVER['SERVER_NAME']== "bat.zerbitzaria.net") {
    include_once ("connect_data_serv.php");
}
else {
    include_once ("connect_data.php");
}
include_once ("paciente.php");
include_once ("cita_model.php");
include_once ("centro_model.php");

class paciente_model extends paciente {

    private $link;  // datu basera lotura - enlace a la bbdd
    private $citas;
    private $centro;

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

    public function logPaciente() {

        $this->OpenConnect();

        $response=array();

        $tis=$this->getTis();
        $fecha_nac=$this->getFecha_nac();
        $apellido=$this->getApellido();


        $sql = "SELECT * FROM paciente WHERE tis=$tis AND fecha_nac='$fecha_nac' AND apellido='$apellido'";
        $result = $this->link->query($sql);
        $response["logged"] = false;
        
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $response["logged"] = true;
        }

        mysqli_free_result($result);
        $this->CloseConnect();
        if ($response["logged"]) {
            $response["paciente"] = $this->getPacienteByTis();
        }
        return $response;
    }

    public function getPacienteByTis(){

        $this->OpenConnect();

        $tis=$this->getTis();

        $sql = "SELECT * FROM paciente WHERE tis=$tis";
        $result = $this->link->query($sql);
        
        $response=array();
        
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $paciente = new paciente_model();
            $paciente->tis=$row['tis'];
            $paciente->nombre=$row['nombre'];
            $paciente->apellido=$row['apellido'];
            $paciente->fecha_nac=$row['fecha_nac'];
            $paciente->fecha_pcr_pstv=$row['fecha_pcr'];
            $response["paciente"]=get_object_vars($paciente);
            $response["status"]="200";

            $cita = new cita_model();
            $cita->setTis($row['tis']); 
            $paciente->citas=$cita->getCitasByTis();

            $OBJcentro = new centro_model();
            $OBJcentro->setId($row['id_centro']); 
            $paciente->centro=$OBJcentro->getCentroById();


            $response["paciente"]=get_object_vars($paciente);
            $response["status"]="200";
        }else {
            $response["status"]="500";
        }

        mysqli_free_result($result);
        $this->CloseConnect();

        return $response;

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

    public function getLastDosis(){
        $this->OpenConnect();

        $tis=$this->getTis();
        $numDosis=0;

        $sql = "SELECT MAX(recibe.dosis) AS dosis FROM recibe INNER JOIN paciente ON paciente.tis = recibe.tis WHERE paciente.tis=$tis;";
        $result = $this->link->query($sql);
        
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $numDosis=$row['dosis'];
        }

        mysqli_free_result($result);
        $this->CloseConnect();
        return $numDosis;
    }

    public function findPacienteByTis(){
        $this->OpenConnect();

        $tis = $this -> getTis();

        $sql = "SELECT paciente.tis, paciente.nombre, paciente.apellido, paciente.fecha_nac, paciente.fecha_pcr, cita.id AS idCita, cita.fecha AS fechaCita, cita.dosis, centro_vacunacion.nombre AS nombreCentro, centro_vacunacion.poblacion, centro_vacunacion.provincia FROM paciente INNER JOIN centro_vacunacion ON centro_vacunacion.id = paciente.id_centro INNER JOIN cita ON paciente.tis = cita.tis WHERE paciente.tis=$tis";

        $result = $this->link->query($sql);

        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

            $this -> setTis($row['tis']);
            $this -> setNombre($row['nombre']);
            $this -> setApellido($row['apellido']);
            $this -> setFecha_nac($row['fecha_nac']);
            $this -> setFecha_pcr_pstv($row['fecha_pcr']);

            $cita = new cita_model();
            $cita -> setId($row['idCita']);
            $cita -> setFecha($row['fechaCita']);
            $cita -> setDosis($row['dosis']);

            $this -> citas = $cita -> ObjVars();

            $centro = new centro_model();
            $centro -> setNombre($row['nombreCentro']);
            $centro -> setPoblacion($row['poblacion']);
            $centro -> setProvincia($row['provincia']);

            $this -> centro = $centro -> ObjVars();
        }
        mysqli_free_result($result);
        $this -> CloseConnect();
        return get_object_vars($this);
    }

    public function ObjVars(){
        return get_object_vars($this);
    }

}