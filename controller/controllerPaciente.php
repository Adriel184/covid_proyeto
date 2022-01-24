<?php 

    include_once '../model/paciente_model.php';
    $data=json_decode(file_get_contents("php://input"),true);
    session_start();

    $accion=$data["accion"];

    if ($accion=="getData") {
    
        $response=array();
        
<<<<<<< HEAD
        $view=$_SESSION['view'];
        $tis= $_SESSION['tis'];
=======
        $view=$_SESSION["view"];
        $tis= $_SESSION["tis"];
>>>>>>> main
    
        $paciente=new paciente_model();
        $paciente->setTis($tis);
        
        $respGetPaciente=array();

        $respGetPaciente=$paciente->getPacienteByTis();
        if ($respGetPaciente["status"]=="200") {
            $response["paciente"]= $respGetPaciente["paciente"];
        }else{
            $response["paciente"]=null;
        }

        $response["view"]=$view;
    
        echo json_encode($response);
        
        unset($response);
        
    }elseif ($accion=="hjjgjh") {
    
    }

