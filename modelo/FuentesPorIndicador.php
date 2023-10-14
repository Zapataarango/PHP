<?php
class FuentesPorIndicador {
    private $fkidfuente;
    private $fkidindicador;

    public function __construct($fkidfuente, $fkidindicador) {
        $this->fkidfuente = $fkidfuente;
        $this->fkidindicador = $fkidindicador;
    }

    public function getFkIdFuente() {
        return $this->fkidfuente;
    }

    public function setFkIdFuente($fkidfuente) {
        $this->fkidfuente = $fkidfuente;
    }

    public function getFkIdIndicador() {
        return $this->fkidindicador;
    }

    public function setFkIdIndicador($fkidindicador) {
        $this->fkidindicador = $fkidindicador;
    }
}
?>
