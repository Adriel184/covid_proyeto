<?php
    include_once '../model/recibe_model.php';
    $data = json_decode(file_get_contents("php://input"), true);

    $tis = $data['tis'];

    $response = array();

    $pedir = new recibe_model();
    $pedir -> setTis($tis);
    $paciente = $pedir -> historialPaciente();
    $response['historial'] = $paciente;
    $response['error'] =  "no error";

    echo json_encode($response);
    unset($response);

?>