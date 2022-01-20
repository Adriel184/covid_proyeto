<?php
include_once '../model/admin_model.php';

$data = json_decode(file_get_contents("php://input"), true);

$user = $data['user'];
$password = $data['password'];

$response = array();

if(($user != null) && ($password != null)) {

    $admin = new admin_model();
    $admin -> setUsuario($user);
    $admin -> setContrasena($password);

    if ($admin->adminExist()) {
        session_start();

        $admin->getAdmin();
        $response['user']=$admin->ObjVars();
        $response['error']="no error";

        $_SESSION['usuario'] = $user;
        $_SESSION['tipo'] = $admin->getTipo();

    }else{
        $response['error'] = "incorrect user/password";
    }

}else{
    $response['error'] = "Username or password not filled";
}

echo json_encode($response);

unset($response);

?>