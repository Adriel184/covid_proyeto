<?php
include_once '../model/centro_model.php';

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$nombre = $data['nombre'];
$provincia = $data['provincia'];
$poblacion = $data['poblacion'];
$direccion = $data['direccion'];
$cp = $data['cp'];
$hora_apertura = $data['hora_apertura'];
$hora_cierre = $data['hora_cierre'];
$lunes = $data['lunes'];
$martes = $data['martes'];
$miercoles = $data['miercoles'];
$jueves = $data['jueves'];
$viernes = $data['viernes'];
$sabado = $data['sabado'];
$domingo = $data['domingo'];

$response = array();

$centro = new centro_model();
$centro -> setId($id);
$centro -> setNombre($nombre);
$centro -> setProvincia($provincia);
$centro -> setPoblacion($poblacion);
$centro -> setDireccion($direccion);
$centro -> setCp($cp);
$centro -> setHora_apertura($hora_apertura);
$centro -> setHora_cierre($hora_cierre); 
$centro -> setLunes($lunes);
$centro -> setMartes($martes);
$centro -> setMiercoles($miercoles);
$centro -> setJueves($jueves);
$centro -> setViernes($viernes);
$centro -> setSabado($sabado);
$centro -> setDomingo($domingo);

if($centro->updateCentro() == 1){
    $response['error'] = "Centro modificado";
}
else{
    $response['error'] = "error";
}

echo json_encode($response);

unset($response);
?>