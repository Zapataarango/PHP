<?php
class ControlResultadoIndicador {
    private $objResultadoIndicador;

    public function __construct($objResultadoIndicador) {
        $this->objResultadoIndicador = $objResultadoIndicador;
    }

    public function guardar() {
        $id = $this->objResultadoIndicador->getId();
        $resultado = $this->objResultadoIndicador->getResultado();
        $fechaCalculo = $this->objResultadoIndicador->getFechaCalculo();
        $fkIndicador = $this->objResultadoIndicador->getFkIndicador();

        $comandoSql = "INSERT INTO resultadoindicador(id, resultado, fechaCalculo, fkIndicador) VALUES ('$id', '$resultado', '$fechaCalculo', '$fkIndicador')";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    public function consultar() {
        $id = $this->objResultadoIndicador->getId();

        $comandoSql = "SELECT * FROM resultadoindicador WHERE id = '$id'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
            $this->objResultadoIndicador->setResultado($row['resultado']);
            $this->objResultadoIndicador->setFechaCalculo($row['fechaCalculo']);
            $this->objResultadoIndicador->setFkIndicador($row['fkIndicador']);
        }
        $objControlConexion->cerrarBd();
        return $this->objResultadoIndicador;
    }

    public function modificar() {
        $id = $this->objResultadoIndicador->getId();
        $resultado = $this->objResultadoIndicador->getResultado();
        $fechaCalculo = $this->objResultadoIndicador->getFechaCalculo();
        $fkIndicador = $this->objResultadoIndicador->getFkIndicador();

        $comandoSql = "UPDATE resultadoindicador SET resultado='$resultado', fechaCalculo='$fechaCalculo', fkIndicador='$fkIndicador' WHERE id = '$id'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    public function borrar() {
        $id = $this->objResultadoIndicador->getId();
        $comandoSql = "DELETE FROM resultadoindicador WHERE id = '$id'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    public function listar() {
        $comandoSql = "SELECT * FROM resultadoindicador";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        $arregloResultadoIndicador = array();
        $i = 0;
        while ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
            $objResultadoIndicador = new ResultadoIndicador("", "", "", "");
            $objResultadoIndicador->setId($row['id']);
            $objResultadoIndicador->setResultado($row['resultado']);
            $objResultadoIndicador->setFechaCalculo($row['fechaCalculo']);
            $objResultadoIndicador->setFkIndicador($row['fkIndicador']);
            $arregloResultadoIndicador[$i] = $objResultadoIndicador;
            $i++;
        }
        $objControlConexion->cerrarBd();
        return $arregloResultadoIndicador;
    }
}
?>
