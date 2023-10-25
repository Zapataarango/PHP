<?php
class Actor {
    private $id;
    private $nombre;
    private $fkidtipoactor; // Esta propiedad almacenará un objeto de la clase TipoActor

    public function __construct($id, $nombre, $fkidtipoactor) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->fkidtipoactor = $fkidtipoactor;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setTipoActor($fkidtipoactor) {
        $this->fkidtipoactor = $fkidtipoactor;
    }

    public function getTipoActor() {
        return $this->fkidtipoactor;
    }
}
?>



