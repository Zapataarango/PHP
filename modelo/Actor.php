<?php
class Actor {
    private $id;
    private $nombre;
    private $idTipoActor; // Esta propiedad almacenará un objeto de la clase TipoActor

    public function __construct($id, $nombre, $idTipoActor) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->idTipoActor = $idTipoActor;
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

    public function setTipoActor($idTipoActor) {
        $this->idTipoActor = $idTipoActor;
    }

    public function getTipoActor() {
        return $this->idTipoActor;
    }
}
?>



