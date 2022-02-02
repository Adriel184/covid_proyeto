<?php
if ($_SERVER['SERVER_NAME'] == "bat.zerbitzaria.net") {
    include_once("connect_data_serv.php");
}
else {
    include_once("connect_data.php");
}

include_once("centro.php");

class centro_model extends centro {
    private $link;

    public function OpenConnect() {
        $konDat = new connect_data();

        try {
            $this->link = new mysqli($konDat->host, $konDat->userbbdd, $konDat->passbbdd, $konDat->ddbbname);
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }

        $this->link->set_charset("utf8");
    }                   
          
    public function CloseConnect() {
        mysqli_close($this->link);
    }
    
    public function getCentroById() {
        $this->OpenConnect();

        $id = $this->getId();

        $sql = "SELECT * FROM centro_vacunacion WHERE id = $id;";
        $result = $this->link->query($sql);

        $centro = null;
        
        if($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $centro = new centro_model();
            $centro->setId($row['id']);
            $centro->setNombre($row['nombre']);
            $centro->setPoblacion($row['poblacion']);
            $centro->setCp($row['cp']);
            $centro->setProvincia($row['provincia']);
            $centro->setDireccion($row['direccion']);

            $centro->setLunes($row['lunes']);
            $centro->setMartes($row['martes']);
            $centro->setMiercoles($row['miercoles']);
            $centro->setJueves($row['jueves']);
            $centro->setViernes($row['viernes']);
            $centro->setSabado($row['sabado']);
            $centro->setDomingo($row['domingo']);

            $centro->setHora_apertura($row['hora_apertura']);
            $centro->setHora_cierre($row['hora_cierre']);
        }

        mysqli_free_result($result);
        $this->CloseConnect();
        return get_object_vars($centro);
    }

    public function getCentros() {
        $this->OpenConnect();

        $sql = "SELECT * FROM centro_vacunacion;";
        $result = $this->link->query($sql);

        $centros = array();
        
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $centro = new centro_model();
            $centro->setId($row['id']);
            $centro->setNombre($row['nombre']);
            $centro->setPoblacion($row['poblacion']);
            $centro->setCp($row['cp']);
            $centro->setProvincia($row['provincia']);
            $centro->setDireccion($row['direccion']);

            $centro->setLunes($row['lunes']);
            $centro->setMartes($row['martes']);
            $centro->setMiercoles($row['miercoles']);
            $centro->setJueves($row['jueves']);
            $centro->setViernes($row['viernes']);
            $centro->setSabado($row['sabado']);
            $centro->setDomingo($row['domingo']);

            $centro->setHora_apertura($row['hora_apertura']);
            $centro->setHora_cierre($row['hora_cierre']);

            array_push($centros, get_object_vars($centro));
        }

        mysqli_free_result($result);
        $this->CloseConnect();
        return $centros;
    }

    public function insertCentro() {
        $this->OpenConnect();

        $nombre = $this->getNombre();
        $provincia = $this->getProvincia();
        $poblacion = $this->getPoblacion();
        $direccion = $this->getDireccion();
        $cp = $this->getCp();
        $hora_apertura = $this->getHora_apertura();
        $hora_cierre = $this->getHora_cierre();
        $lunes = $this->getLunes();
        $martes = $this->getMartes();
        $miercoles = $this->getMiercoles();
        $jueves = $this->getJueves();
        $viernes = $this->getViernes();
        $sabado = $this->getSabado();
        $domingo = $this->getDomingo();

        $sql = "INSERT INTO centro_vacunacion (nombre, poblacion, cp, provincia, direccion, hora_apertura, hora_cierre, lunes, martes, miercoles, jueves, viernes, sabado, domingo) VALUES ('$nombre', '$poblacion', $cp, '$provincia', '$direccion', '$hora_apertura:00', '$hora_cierre:00', $lunes, $martes, $miercoles, $jueves, $viernes, $sabado, $domingo);";
        
        $result = $this->link->query($sql);
        $this->CloseConnect();

        return $result;
    }

    public function updateCentro() {
        $this -> OpenConnect();

        $id = $this->getId();
        $nombre = $this->getNombre();
        $provincia = $this->getProvincia();
        $poblacion = $this->getPoblacion();
        $direccion = $this->getDireccion();
        $cp = $this->getCp();
        $hora_apertura = $this->getHora_apertura();
        $hora_cierre = $this->getHora_cierre();
        $lunes = $this->getLunes();
        $martes = $this->getMartes();
        $miercoles = $this->getMiercoles();
        $jueves = $this->getJueves();
        $viernes = $this->getViernes();
        $sabado = $this->getSabado();
        $domingo = $this->getDomingo();

        $sql = "UPDATE centro_vacunacion SET nombre = '$nombre', poblacion = '$poblacion', cp = '$cp', provincia = '$provincia', direccion = '$direccion', hora_apertura = '$hora_apertura:00', hora_cierre = '$hora_apertura:00', lunes = '$lunes', martes = '$martes', miercoles = '$miercoles', jueves = '$jueves', viernes = '$viernes', sabado = '$sabado', domingo = '$domingo' WHERE id = $id;";

        $result = $this->link->query($sql);
        $this-> CloseConnect();

        return $result;
    }

    public function ObjVars() {
        return get_object_vars($this);
    }
}
?>