<?php
class vacuna {
    protected $id;
    protected $marca;
    
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getMarca() {
        return $this->marca;
    }
    public function setMarca($marca) {
        $this->marca = $marca;
        return $this;
    }
}
?>