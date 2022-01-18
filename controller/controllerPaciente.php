<?php

    session_start();
    session_unset();
    session_destroy();

    include_once '../model/paciente_model.php';
    $data=json_decode(file_get_contents("php://input"),true);

    $response=array();

    $tis="12345678";
    $fecha_nac="2001-12-10";
    $apellido="crespo";

    $paciente=new paciente_model();
    $paciente->setTis($tis);
    $paciente->setFecha_nac($fecha_nac);
    $paciente->setApellido($apellido);

    $response= $paciente->loginPaciente();

    if ($response['logged']) {
        session_start();
        $_SESSION['tis']=$paciente->getTis();
    }

    echo json_encode($response);
    
    unset($response);