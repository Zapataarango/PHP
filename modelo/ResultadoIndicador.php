<?php
class ResultadoIndicador {
    private $id;
    private $resultado;
    private $fechaCalculo;
    private $fkIndicador;
   
    public function __construct($id, $resultado, $fechaCalculo, $fkIndicador) {
        $this->id = $id;
        $this->resultado = $resultado;
        $this->fechaCalculo = $fechaCalculo;
        $this->fkIndicador = $fkIndicador;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getResultado() {
        return $this->resultado;
    }

    public function setResultado($resultado) {
        $this->resultado = $resultado;
    }

    public function getFechaCalculo() {
        return $this->fechaCalculo;
    }

    public function setFechaCalculo($fechaCalculo) {
        $this->fechaCalculo = $fechaCalculo;
    }

    public function getFkIndicador() {
        return $this->fkIndicador;
    }

    public function setFkIndicador($fkIndicador) {
        $this->fkIndicador = $fkIndicador;
    }
}

?>