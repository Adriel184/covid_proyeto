<?php
include_once '../model/paciente_model.php';

$data=json_decode(file_get_contents("php://input"), true);

$base64 = $data["savedFileBase64"];
$tis = $data["tis"];

$response = array();

$paciente = new paciente_model();
$paciente->setTis($tis);
$paciente->setImg($base64);

if($paciente->updateFile() == 1) {
    $response['error'] = "Imagen añadida";
}
else {
    $response['error'] = "error";
}

echo json_encode($response);

unset($response);
?>