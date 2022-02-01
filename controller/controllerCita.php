<?php 
include_once '../model/cita_model.php';

$data = json_decode(file_get_contents("php://input"), true);
session_start();//

$response = array();

$cita = new cita_model();
$cita->setTis($data["tis"]);
$cita->setDosis($data["dosis"]);
$cita->setFecha($data["fechaYhora"]);
$cita->setId_centro($data["idCentro"]);

$response["added"] = $cita->addCita();

echo json_encode($response);

unset($response);
?>