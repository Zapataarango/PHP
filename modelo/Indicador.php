<?php
class Indicador {
    private $id;
    private $codigo;
    private $nombre;
    private $objetivo;
    private $alcance;
    private $formula;
    private $fkidtipoindicador;
    private $fkidunidadmedicion;
    private $meta;
    private $fkidsentido;
    private $fkidfrecuencia;
    private $fkidarticulo;
    private $fkidliteral;
    private $fkidnumeral;
    private $fkidparagrafo;

    public function __construct(
        $id,
        $codigo,
        $nombre,
        $objetivo,
        $alcance,
        $formula,
        $fkidtipoindicador,
        $fkidunidadmedicion,
        $meta,
        $fkidsentido,
        $fkidfrecuencia,
        $fkidarticulo,
        $fkidliteral,
        $fkidnumeral,
        $fkidparagrafo
    ) {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->objetivo = $objetivo;
        $this->alcance = $alcance;
        $this->formula = $formula;
        $this->fkidtipoindicador = $fkidtipoindicador;
        $this->fkidunidadmedicion = $fkidunidadmedicion;
        $this->meta = $meta;
        $this->fkidsentido = $fkidsentido;
        $this->fkidfrecuencia = $fkidfrecuencia;
        $this->fkidarticulo = $fkidarticulo;
        $this->fkidliteral = $fkidliteral;
        $this->fkidnumeral = $fkidnumeral;
        $this->fkidparagrafo = $fkidparagrafo;
    }

    // Métodos getters y setters

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getObjetivo() {
        return $this->objetivo;
    }

    public function setObjetivo($objetivo) {
        $this->objetivo = $objetivo;
    }

    public function getAlcance() {
        return $this->alcance;
    }

    public function setAlcance($alcance) {
        $this->alcance = $alcance;
    }

    public function getFormula() {
        return $this->formula;
    }

    public function setFormula($formula) {
        $this->formula = $formula;
    }

    public function getFkidtipoindicador() {
        return $this->fkidtipoindicador;
    }

    public function setFkidtipoindicador($fkidtipoindicador) {
        $this->fkidtipoindicador = $fkidtipoindicador;
    }

    public function getFkidunidadmedicion() {
        return $this->fkidunidadmedicion;
    }

    public function setFkidunidadmedicion($fkidunidadmedicion) {
        $this->fkidunidadmedicion = $fkidunidadmedicion;
    }

    public function getMeta() {
        return $this->meta;
    }

    public function setMeta($meta) {
        $this->meta = $meta;
    }

    public function getFkidsentido() {
        return $this->fkidsentido;
    }

    public function setFkidsentido($fkidsentido) {
        $this->fkidsentido = $fkidsentido;
    }

    public function getFkidfrecuencia() {
        return $this->fkidfrecuencia;
    }

    public function setFkidfrecuencia($fkidfrecuencia) {
        $this->fkidfrecuencia = $fkidfrecuencia;
    }

    public function getFkidarticulo() {
        return $this->fkidarticulo;
    }

    public function setFkidarticulo($fkidarticulo) {
        $this->fkidarticulo = $fkidarticulo;
    }

    public function getFkidliteral() {
        return $this->fkidliteral;
    }

    public function setFkidliteral($fkidliteral) {
        $this->fkidliteral = $fkidliteral;
    }

    public function getFkidnumeral() {
        return $this->fkidnumeral;
    }

    public function setFkidnumeral($fkidnumeral) {
        $this->fkidnumeral = $fkidnumeral;
    }

    public function getFkidparagrafo() {
        return $this->fkidparagrafo;
    }

    public function setFkidparagrafo($fkidparagrafo) {
        $this->fkidparagrafo = $fkidparagrafo;
    }
}
?>
