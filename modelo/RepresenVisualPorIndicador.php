<?php
class RepresenVisualPorIndicador {
    private $fkidindicador;
    private $fkidrepresenvisual;


    public function __construct($fkidindicador, $fkidrepresenvisual) {
        $this->fkidindicador = $fkidindicador;
        $this->fkidrepresenvisual = $fkidrepresenvisual;
    }
    

    public function getFkIdIndicador() {
        return $this->fkidindicador;
    }

    public function setFkIdIndicador($fkidindicador) {
        $this->fkidindicador = $fkidindicador;
    }

    public function getFkIdRepresenVisual() {
        return $this->fkidrepresenvisual;
    }

    public function setFkIdRepresenVisual($fkidrepresenvisual) {
        $this->fkidrepresenvisual = $fkidrepresenvisual;
    }


}
?>
