<?php

    $data=json_decode(file_get_contents("php://input"),true);
    session_start();
    
    $response=$_SESSION['view']="paciente";

    echo json_encode($response);
    
    unset($response);
        
