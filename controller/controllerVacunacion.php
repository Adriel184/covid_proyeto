<?php
include_once '../model/cita_model.php';
include_once '../model/recibe_model.php';

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];

$response = array();

$cita = new cita_model();
$cita->setId($id);

if($cita->deleteCita() == 1) {
    $response['error'] = "Primera funcion se ha hecho.";
}
else {
    $response['error'] = "No se ha podido hacer la primera llamada.";
}
?>