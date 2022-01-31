<?php

    include_once '../model/paciente_model.php';
    $data = json_decode(file_get_contents("php://input"),true);

    $tis = $data['tis'];

    $response = array();

    $paciente = new paciente_model();
    $paciente -> setTis($tis);
    $paci = $paciente -> findPacienteByTis();
    $response['paciente'] = $paci;
    $response['error'] = "no error";

    echo json_encode($response);
    unset($response);

?>