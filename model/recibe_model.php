<?php
if ($_SERVER['SERVER_NAME']== "bat.zerbitzaria.net") {
    include_once ("connect_data_serv.php");
}
else {
    include_once ("connect_data.php");
}
include_once ("recibe.php");
include_once ("vacuna_model.php");

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

    public function nuevaVacuna(){
        $this -> OpenConnect();

        $tis = $this -> getTis();
        $fecha = $this -> getFecha();
        $dosis = $this -> getId_vacuna();
        $nDosis = $this -> getDosis();

        $sql = "INSERT INTO `recibe` (`tis`, `id_vacuna`, `fecha`, `dosis`) VALUES ('$tis', '$dosis', '$fecha', '$nDosis');";

        $result = $this -> link -> query($sql);

        mysqli_free_result($result);

        $this -> CloseConnect();
        return $result;
    }

    public function ObjVars(){
        return get_object_vars($this);
    }

}