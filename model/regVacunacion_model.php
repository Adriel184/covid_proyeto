<?php

include_once ("regVacunacion.php");
include_once ("vacuna_model.php");
include_once ("centro_model.php");
include_once ("paciente_model.php");
include_once ("connect_model.php");

class regVacunacion_model extends regVacunacion{

    private $link;
    private $vacunas;
    private $centro;
    private $paciente;

    public function OpenConnect() {
        $konDat=new connect_data();
        try{
            $this->link=new mysqli($konDat->id,$konDat->dosis,$konDat->fecha,$konDat->id_vacuna,$konDat->this);

        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
        $this->link->set_charset("utf8");
    }

    public function CloseConnect() {
        mysqli_close ($this->link);
    }


    public function getRegVacunacionByTis() {

        $this->OpenConnect();

        $vacunas=$this->getVacunas();
        $centros=$this->getCentros();
        
        $sql="SELECT * FROM paciente WHERE tis=$tis";
        $result=$this->link_>query($sql);

        $response=array();

        while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $registro=new regVacunacion_model();
            $registro->id=$row['id'];
            $registro->dosis=$row['dosis'];
            $registro->marca=$row['marca'];
            $registro->fecha=$row['fecha'];
            $registro->id_vacuna=$row['id_vacuna'];
            $response["registro"]=get_object_vars($registro);
            $response["status"]="200";

            $vacuna=new vacuna_model();
            $vacuna->setMarca($row['marca']);
            $vacuna->setId($row['id_vacuna']);
            $registro->vacunas=$vacuna->getVacunas();

            $objCentro=new centro_model();
            $objCentro->setProvincia($row['provincia']);
            $objCentro->setNombre($row['centro']);
            $registro->centro=$objCentro->getCentroById();

            $objPaciente=new paciente_model();
            $objPaciente->setTis($row['tis']);
            $registro->paciente=$objPaciente->getPacientes();


            $response["registro"]=get_object_vars($registro);
            $response["status"]="200";
        }else {
            $response["status"]="500";
        }
        mysqli_free_result($result);
        $this->CloseConnect();

        return $response;
    }



}