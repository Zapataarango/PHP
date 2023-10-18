<?php
class Actor {
    private $id;
    private $nombre;
    private $fkIdTipoActor; // Esta propiedad almacenará un objeto de la clase TipoActor

    public function __construct($id, $nombre, $fkIdTipoActor) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->fkIdTipoActor = $fkIdTipoActor;
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

    public function setTipoActor($fkIdTipoActor) {
        $this->fkIdTipoActor = $fkIdTipoActor;
    }

    public function getTipoActor() {
        return $this->fkIdTipoActor;
    }
}
?>



