<?php

session_start();
session_destroy();

$response=array();
$response['error']="no error";  

echo json_encode($response);
