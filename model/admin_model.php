<?php
if ($_SERVER['SERVER_NAME']== "bat.zerbitzaria.net") {
    include_once ("connect_data_serv.php");
}
else {
    include_once ("connect_data.php");
}
include_once ("admin.php");

class admin_model extends admin {

    private $link;  // datu basera lotura - enlace a la bbdd  

    public function OpenConnect() {
        $konDat=new connect_data();
        try
        {
            $this->link=new mysqli($konDat->host,$konDat->userbbdd,$konDat->passbbdd,$konDat->ddbbname);
            // mysqli klaseko link objetua sortzen da dagokion konexio datuekin
            // se crea un nuevo objeto llamado link de la clase mysqli con los datos de conexión. 
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
        $this->link->set_charset("utf8"); // honek behartu egiten du aplikazio eta 
                        //databasearen artean UTF -8 erabiltzera datuak trukatzeko
    }                   
          
    public function CloseConnect() {
        mysqli_close ($this->link);
    }   

    /********* FUNCIONES **********/

    public function loginAdmin(){
        $this ->OpenConnect();

        $response = array();

        $sql = "SELECT * FROM admin WHERE usuario='$this->user' AND contrasena='$this->contrasenia'";
        $result = $this->link->query($sql);

        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $response['ses'] = true;
        }

        mysqli_free_result($result);
        $this->CloseConnect();
        if ($response["ses"]) {
            $response["admin"] = $this->getAdmin();
        }
        return $response;
    }

    public function getAdmin(){
        $this -> OpenConnect();

        $usuario = $this -> getUsuario();
        $contrasena = $this -> getContrasena();
        
        $sql = "SELECT * FROM admin WHERE admin.usuario='$usuario' AND admin.contrasena='$contrasena'";

        $result = $this->link->query($sql);
        
        
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            
            $this -> setId($row['id']);
            $this -> setUsuario($row['usuario']);
            $this -> setNombre($row['nombre']);
            $this -> setApellidos($row['apellido']);
            $this -> setContrasena($row['contrasena']);
            $this -> setTipo($row['tipo']);
            $this -> setId_centro($row['id_centro']);

        }

        mysqli_free_result($result);
        $this->CloseConnect();

        //return get_object_vars($this);

    }

    public function adminExist(){
        $this-> OpenConnect();

        $usuario = $this -> usuario;
        $contrasena = $this -> contrasena;

        $sql = "SELECT * FROM admin WHERE admin.usuario='$usuario' AND admin.contrasena='$contrasena'";

        $result=$this->link->query($sql);

        $adminExist = false;

        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $adminExist = true;
        }

        mysqli_free_result($result);
        $this->CloseConnect();
		return $adminExist;

    }

    public function ObjVars(){
        return get_object_vars($this);
    }



}

?>