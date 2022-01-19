<?php

    include_once '../model/paciente_model.php';
    $data=json_decode(file_get_contents("php://input"),true);
    session_start();

    $accion=$data['accion'];

    if ($accion=="login") {
    
        $response=array();
    
        $tis=$data['tis'];
        $fecha_nac=$data['fecha_nac'];
        $apellido=$data['apellido'];
    
        $paciente=new paciente_model();
        $paciente->setTis($tis);
        $paciente->setFecha_nac($fecha_nac);
        $paciente->setApellido($apellido);
    
        $response= $paciente->loginPaciente();
    
        if ($response['logged']) {
            $_SESSION['tis']=$paciente->getTis();
        }
    
        echo json_encode($response);
        
        unset($response);
        
    }elseif ($accion=="load") {
        
        $response=array();
    
        $tis= $_SESSION['tis'];
    
        $paciente=new paciente_model();
        $paciente->setTis($tis);
    
        $response= $paciente->getPaciente();
    
        echo json_encode($response);
        
        unset($response);

<<<<<<< HEAD
=======
    if ($response['logged']) {
        session_start();
        $_SESSION['tis']=$paciente->getTis();
>>>>>>> main
    }

