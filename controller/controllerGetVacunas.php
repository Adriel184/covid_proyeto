<?php
include_once '../model/vacuna_model.php';

$response = array();

$vacuna = new vacuna_model();

$response['vacunas'] = $vacuna -> getVacunas();
$response['error'] = 'no error';

echo json_encode($response);
unset($response);

?>