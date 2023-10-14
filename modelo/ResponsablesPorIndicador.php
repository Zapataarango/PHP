<?php
class ResponsablesPorIndicador {
    private $idResponsable;
    private $idIndicador;
    private $fechaAsignacion;

    public function __construct($idResponsable, $idIndicador, $fechaAsignacion) {
        $this->idResponsable = $idResponsable;
        $this->idIndicador = $idIndicador;
        $this->fechaAsignacion = $fechaAsignacion;
    }

    // Aquí puedes agregar getters y setters para las propiedades si es necesario.
    
    public function getIdResponsable() {
        return $this->idResponsable;
    }

    public function setIdResponsable($idResponsable) {
        $this->idResponsable = $idResponsable;
    }

    public function getIdIndicador() {
        return $this->idIndicador;
    }

    public function setIdIndicador($idIndicador) {
        $this->idIndicador = $idIndicador;
    }

    public function getFechaAsignacion() {
        return $this->fechaAsignacion;
    }

    public function setFechaAsignacion($fechaAsignacion) {
        $this->fechaAsignacion = $fechaAsignacion;
    }
}
?>
