<?php
class Variable {
    private $id;
    private $nombre;
    private $fechacreacion;
    private $fkemailusuario;

    public function __construct($id, $nombre, $fechacreacion, $fkemailusuario) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->fechacreacion = $fechacreacion;
        $this->fkemailusuario = $fkemailusuario;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getFechaCreacion() {
        return $this->fechacreacion;
    }

    public function getFkEmailUsuario() {
        return $this->fkemailusuario;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setFechaCreacion($fechacreacion) {
        $this->fechacreacion = $fechacreacion;
    }

    public function setFkEmailUsuario($fkemailusuario) {
        $this->fkemailusuario = $fkemailusuario;
    }
}
?>
