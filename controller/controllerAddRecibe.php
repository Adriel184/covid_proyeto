<?php
include_once '../model/recibe_model.php';

$data = json_decode(file_get_contents("php://input"), true);

$tis = $data['tis'];
$fecha = $data['fecha'];
$dosis = $data['dosis'];
$nDosis = $data['nDosis'];
 
$response = array();

$recibe = new recibe_model();
$recibe -> setTis($tis);
$recibe -> setFecha($fecha);
$recibe -> setId_vacuna($dosis);
$recibe -> setDosis($nDosis);
if ($recibe -> nuevaVacuna()) {
    $response['error'] = 'no error, recibe introducido';
}else{

$response['error'] = 'error, no introducido';
}
echo json_encode($response);

unset($response);
?>