<?php

    include_once '../model/paciente_model.php';
    
    $response=array();

    $tis="12345678";
    $fecha_nac="2001-12-10";
    $apellido="Crespo";

    $paciente=new paciente_model();
    $paciente->tis=$tis;
    $paciente->fecha_nac=$fecha_nac;
    $paciente->apellido=$apellido;

    $response['logged']= $paciente->loginPaciente();

    if ($response['logged']) {
        session_start();
        $_SESSION['tis']=$paciente->tis;
        $_SESSION['apellido']=$paciente->apellido;
        echo $_SESSION['tis'];
    }


    
    echo json_encode($response);
    
    unset($response);