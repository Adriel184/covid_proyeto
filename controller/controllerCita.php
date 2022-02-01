<?php 

    include_once '../model/cita_model.php';
    include_once '../model/paciente_model.php';
    $data=json_decode(file_get_contents("php://input"),true);
    session_start();
    
    $response=array();

    $cita=new cita_model();
    $cita->setTis($data["tis"]);
    $cita->setDosis($data["dosis"]);
    $cita->setFecha($data["fechaYhora"]);
    $cita->setId_centro($data["idCentro"]);

    $paciente=new paciente_model();
    $paciente->setTis($data["tis"]);

    $citas=$cita->getCitasByTis();

    /**Codigo para crear el datetime now y compararlo con la fecha de ultima pcr del paciente*/

    if (count($citas)==0) {
        $response["message"]="El paciente no tiene citas pendientes";
        
        if ($paciente->getLastDosis()<3) {
            $response["message"]="El paciente no tiene citas pendientes y ha recibido menos de 3 dosis";
            $response["added"]=$cita->addCita();
        }else {
            $response["message"]="Ha recibido EL MAXIMO de 3 dosis";
            $response["added"]=false;
        }
        
    }else {
        $response["message"]="El paciente tiene otras citas pendientes";
        $response["added"]=false;
    }
    

    echo json_encode($response);
    
    unset($response);
        
