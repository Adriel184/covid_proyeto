<?php
if ($_SERVER['SERVER_NAME'] == "bat.zerbitzaria.net") {
    include_once("connect_data_serv.php");
}
else {
    include_once("connect_data.php");
}

include_once("vacuna.php");

class vacuna_model extends vacuna {
    private $link;
    private $vacuna;

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

    public function getVacunas() {
        $this->OpenConnect();

        $sql = "SELECT * FROM vacuna;";
        $result = $this->link->query($sql);

        $vacunas = array();

        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $vacuna = new vacuna_model();
            $vacuna->setId($row['id']);
            $vacuna->setMarca($row['marca']);

            array_push($vacunas, get_object_vars($vacuna));
        }

        mysqli_free_result($result);
        $this->CloseConnect();
        return $vacunas;
    }

    public function ObjVars() {
        return get_object_vars($this);
    }
}
?>