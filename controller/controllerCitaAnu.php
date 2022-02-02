<?php
include_once '../model/cita_model.php';

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['idCita'];

$response = array();

$cita = new cita_model();
$cita->setId($id);

if($cita-> deleteCita() == 1) {
    $response['error'] = "Cita anulada con exito";
}
else {
    $response['error'] = "La cita no ha sido anulada";
}

echo json_encode($response);

unset($response);
?>