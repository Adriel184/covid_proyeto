<?php

    include_once '../model/paciente_model.php';
    include_once '../model/admin_model.php';
    $data=json_decode(file_get_contents("php://input"),true);
    session_start();

    $accion=$data['accion'];

    if ($accion=="paciente") {
    
        $response=array();
    
        $tis=$data['tis'];
        $fecha_nac=$data['fecha_nac'];
        $apellido=$data['apellido'];
    
        $paciente=new paciente_model();
        $paciente->setTis($tis);
        $paciente->setFecha_nac($fecha_nac);
        $paciente->setApellido($apellido);
    
        $response= $paciente->logPaciente();
    
        if ($response['logged']) {
            $_SESSION['view']=$accion;
            $_SESSION['tis']=$paciente->getTis();
        }

        echo json_encode($response);
        
        unset($response);
        
    }elseif ($accion=="admin") {
        
    }
