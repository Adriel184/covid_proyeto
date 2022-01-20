<?php

    include_once '../model/paciente_model.php';
    $data=json_decode(file_get_contents("php://input"),true);
    session_start();

    $accion="getData";

    if ($accion=="getData") {
    
        $response=array();
    
        $tis="12345678";
        $fecha_nac="10-12-2001";
        $apellido="crespo";
    
        $paciente=new paciente_model();
        $paciente->setTis($tis);
        $paciente->setFecha_nac($fecha_nac);
        $paciente->setApellido($apellido);
    
        $response= $paciente->logPaciente();
    
        if ($response['logged']) {
            $_SESSION['view']="paciente";
            $_SESSION['tis']=$paciente->getTis();
        }
    
        echo json_encode($response);
        
        unset($response);
        
    }elseif ($accion=="load") {
        
        $response=array();
        
        $view=$_SESSION['view'];
        $tis= $_SESSION['tis'];
    
        $paciente=new paciente_model();
        $paciente->setTis($tis);
    
        $response["paciente"]= $paciente->getPacienteByTis();
        $response["view"]=$view; 
    
        echo json_encode($response);
        
        unset($response);
    }

