<?php
if($_SERVER['SERVER_NAME'] == "bat.zerbitzaria.net") {
    include_once("connect_data_serv.php");
}
else {
    include_once("connect_data.php");
}

include_once ("cita.php");

class cita_model extends cita {
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

    public function getCita() {
        $this->OpenConnect();

        $sql = "CALL spCita('$this->id');";
        $result = $this->link->query($sql);
        $cita = null;       
        
        if($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $cita = new cita_model();
            $cita->setId($row['id']);
            $cita->setFecha($row['fecha']);
            $cita->setDosis($row['dosis']);
            $cita->setTis($row['tis']);
            $cita->setId_centro($row['id_centro']);
        }

        mysqli_free_result($result);
        $this->CloseConnect();

        return $cita;
    }

    public function getCitas() {
        $this->OpenConnect();
        $sql = "SELECT * FROM citas;";
        $result = $this->link->query($sql);
        
        $citas = array();
        
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $cita = new cita_model();
            $cita->setId($row['id']);
            $cita->setFecha($row['fecha']);
            $cita->setDosis($row['dosis']);
            $cita->setTis($row['tis']);
            $cita->setId_centro($row['id_centro']);

            array_push($citas, get_object_vars($cita));
        }

        mysqli_free_result($result);
        $this->CloseConnect();
        return $citas;
    }

    public function getCitasByTis() {
        $this->OpenConnect();

        $tis = $this->getTis();

        $sql = "SELECT * FROM cita WHERE tis = $tis;";
        $result = $this->link->query($sql);
        
        $citas = array();
        
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $cita = new cita_model();
            $cita->setId($row['id']);
            $cita->setFecha($row['fecha']);
            $cita->setDosis($row['dosis']);

            $cita->setTis($row['tis']);
            $cita->setId_centro($row['id_centro']);
            $cita->setDosis($row['dosis']);

            array_push($citas, get_object_vars($cita));
        }

        mysqli_free_result($result);
        $this->CloseConnect();
        return $citas;
    }

    public function getCitasByCentro() {
        $this->OpenConnect();

        $id_centro = $this->id_centro;
        $sql = "SELECT * FROM citas WHERE id_centro = '$id_centro';";
        $result = $this->link->query($sql);
        
        $citas = array();
        
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $cita = new cita_model();
            $cita->id=$row['id'];
            $cita->fecha=$row['fecha'];
            $cita->dosis=$row['dosis'];
            $cita->tis=$row['tis'];
            $cita->id_centro=$row['id_centro'];

            array_push($citas, $cita);
        }

        mysqli_free_result($result);
        $this->CloseConnect();
        return $citas;
    }

    public function addCita() {
        $this->OpenConnect();

        $fecha = $this->getFecha();
        $dosis = $this->getDosis();
        $tis = $this->getTis();
        $id_centro = $this->getId_centro();

        $sql = "INSERT INTO cita (fecha, dosis, tis, id_centro) VALUES ('$fecha', '$dosis', '$tis', '$id_centro')";

        $result = $this->link->query($sql);

        $this->CloseConnect();
        return $result;
    }

    public function deleteCita() {
        $this->OpenConnect();

        $id = $this->id;

        $sql = "DELETE FROM cita WHERE id = $id;";

        $result = $this->link->query($sql);

        $this->CloseConnect();
        return $result;
    }

    public function ObjVars() {
        return get_object_vars($this);
    }
}
?>