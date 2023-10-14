<?php
class ControlFuentesPorIndicador {
    private $objFuentesPorIndicador;

    public function __construct($objFuentesPorIndicador) {
        $this->objFuentesPorIndicador = $objFuentesPorIndicador;
    }

    public function guardar() {
        $fkidfuente = $this->objFuentesPorIndicador->getFkIdFuente();
        $fkidindicador = $this->objFuentesPorIndicador->getFkIdIndicador();

        $comandoSql = "INSERT INTO fuentesporindicador(fkidfuente, fkidindicador) VALUES ('$fkidfuente', '$fkidindicador')";

        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    public function consultar() {
        $fkidfuente = $this->objFuentesPorIndicador->getFkIdFuente();
        $fkidindicador = $this->objFuentesPorIndicador->getFkIdIndicador();

        $comandoSql = "SELECT * FROM fuentesporindicador WHERE fkidfuente = '$fkidfuente' AND fkidindicador = '$fkidindicador'";

        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);

        if ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
            $this->objFuentesPorIndicador->setFkIdFuente($row['fkidfuente']);
            $this->objFuentesPorIndicador->setFkIdIndicador($row['fkidindicador']);
        }

        $objControlConexion->cerrarBd();
        return $this->objFuentesPorIndicador;
    }

    public function modificar() {
        $fkidfuente = $this->objFuentesPorIndicador->getFkIdFuente();
        $fkidindicador = $this->objFuentesPorIndicador->getFkIdIndicador();

        $comandoSql = "UPDATE fuentesporindicador SET fkidfuente = '$fkidfuente' WHERE fkidindicador = '$fkidindicador'";

        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    public function borrar() {
        $fkidfuente = $this->objFuentesPorIndicador->getFkIdFuente();

        $comandoSql = "DELETE FROM fuentesporindicador WHERE fkidfuente = '$fkidfuente'";

        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    public function listar() {
        $comandoSql = "SELECT * FROM fuentesporindicador";

        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);

        $arregloFuentesPorIndicador = array();
        $i = 0;

        while ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
            $objFuentesPorIndicador = new FuentesPorIndicador("", "");
            $objFuentesPorIndicador->setFkIdFuente($row['fkidfuente']);
            $objFuentesPorIndicador->setFkIdIndicador($row['fkidindicador']);
            $arregloFuentesPorIndicador[$i] = $objFuentesPorIndicador;
            $i++;
        }

        $objControlConexion->cerrarBd();
        return $arregloFuentesPorIndicador;
    }
}
?>
