<?php
class VariablesPorIndicador {
    private $id;
    private $fkidvariable;
    private $fkidindicador;
    private $dato;
    private $fkemailusuario;
    private $fechadato;

    public function __construct($id, $fkidvariable, $fkidindicador, $dato, $fkemailusuario, $fechadato) {
        $this->id = $id;
        $this->fkidvariable = $fkidvariable;
        $this->fkidindicador = $fkidindicador;
        $this->dato = $dato;
        $this->fkemailusuario = $fkemailusuario;
        $this->fechadato = $fechadato;
    }

    public function getId() {
        return $this->id;
    }

    public function getFkIdVariable() {
        return $this->fkidvariable;
    }

    public function getFkIdIndicador() {
        return $this->fkidindicador;
    }

    public function getDato() {
        return $this->dato;
    }

    public function getFkEmailUsuario() {
        return $this->fkemailusuario;
    }

    public function getFechaDato() {
        return $this->fechadato;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setFkIdVariable($fkidvariable) {
        $this->fkidvariable = $fkidvariable;
    }

    public function setFkIdIndicador($fkidindicador) {
        $this->fkidindicador = $fkidindicador;
    }

    public function setDato($dato) {
        $this->dato = $dato;
    }

    public function setFkEmailUsuario($fkemailusuario) {
        $this->fkemailusuario = $fkemailusuario;
    }

    public function setFechaDato($fechadato) {
        $this->fechadato = $fechadato;
    }
}
?>
