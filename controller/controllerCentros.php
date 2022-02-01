<?php
include_once '../model/centro_model.php';

$response = array();

$centro = new centro_model();

$response['centros'] = $centro->getCentros();

echo json_encode($response);

unset($response);
?>