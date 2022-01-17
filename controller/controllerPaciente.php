<?php

    session_start();
    session_unset();
    session_destroy();

    include_once '../model/paciente_model.php';
    $data=json_decode(file_get_contents("php://input"),true);

    $response=array();

    $tis=$data['tis'];
    $fecha_nac=$data['fecha_nac'];
    $apellido=$data['apellido'];

    $paciente=new paciente_model();
    $paciente->tis=$tis;
    $paciente->fecha_nac=$fecha_nac;
    $paciente->apellido=$apellido;

    $response= $paciente->loginPaciente();

    if ($response['logged']) {
        session_start();
        $_SESSION['tis']=$paciente->tis;
    }

    echo json_encode($response);
    
    unset($response);