<?php

    include_once 'model/paciente_model.php';
    
    $response=array();

    $tis=$data['tis'];
    $fecha_nac=$data['fecha_nac'];
    $apellido=$data['apellido'];

    $paciente=new paciente_model();
    $paciente->tis=$tis;
    $paciente->fecha_nac=$fecha_nac;
    $paciente->apellido=$apellido;
     
    $response['logged']= $paciente->loginPaciente();
    
    echo json_encode($response);
    
    unset($response);