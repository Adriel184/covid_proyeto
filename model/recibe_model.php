<?php

include_once ("recibe.php");
include_once ("vacuna_model.php");
include_once ("connect_data.php");

class recibe_model extends recibe{
    private $link;  // datu basera lotura - enlace a la bbdd
    private $objVacuna;

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

    public function historialPaciente(){
        $this-> OpenConnect();

        $tis = $this -> getTis();

        $sql = "SELECT recibe.*, vacuna.marca from recibe, vacuna WHERE tis=$tis GROUP BY dosis;";

        $result = $this -> link -> query($sql);

        $list = array();

        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

            $histo = new recibe_model();
            $histo -> setTis($row['tis']);
            $histo -> setId_vacuna($row['id_vacuna']);
            $histo -> setFecha($row['fecha']);
            $histo -> setDosis($row['dosis']);

            $vacuna = new vacuna_model();
            $vacuna -> setMarca($row['marca']);

            $histo -> objVacuna = $vacuna-> ObjVars();

            array_push($list, get_object_vars($histo));
        }
        mysqli_free_result($result);
        $this-> CloseConnect();
        return $list;
    }

    public function ObjVars(){
        return get_object_vars($this);
    }

}