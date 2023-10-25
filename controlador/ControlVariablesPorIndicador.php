<?php
class ControlVariablesPorIndicador {
    private $objVariablesPorIndicador;

    public function __construct($objVariablesPorIndicador) {
        $this->objVariablesPorIndicador = $objVariablesPorIndicador;
    }

    public function guardar() {
        $id = $this->objVariablesPorIndicador->getId();
        $fkidvariable = $this->objVariablesPorIndicador->getFkIdVariable();
        $fkidindicador = $this->objVariablesPorIndicador->getFkIdIndicador();
        $dato = $this->objVariablesPorIndicador->getDato();
        $fkemailusuario = $this->objVariablesPorIndicador->getFkEmailUsuario();
        $fechadato = $this->objVariablesPorIndicador->getFechaDato();

        $comandoSql = "INSERT INTO variablesporindicador(fkidvariable, fkidindicador, dato, fkemailusuario, fechadato) VALUES ('$fkidvariable', '$fkidindicador', '$dato', '$fkemailusuario', '$fechadato')";

        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }


    public function borrar() {
        $id = $this->objVariablesPorIndicador->getId();

        $comandoSql = "DELETE FROM variablesporindicador WHERE id = '$id'";

        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    public function listar() {
        $comandoSql = "SELECT * FROM variablesporindicador";

        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);

        if (mysqli_num_rows($recordSet) > 0) {
            $arregloVariablesPorIndicador = array();
            $i = 0;
            while ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
                $objVariablesPorIndicador = new VariablesPorIndicador("", "", "", "", "", "");
                $objVariablesPorIndicador->setId($row['id']);
                $objVariablesPorIndicador->setFkIdVariable($row['fkidvariable']);
                $objVariablesPorIndicador->setFkIdIndicador($row['fkidindicador']);
                $objVariablesPorIndicador->setDato($row['dato']);
                $objVariablesPorIndicador->setFkEmailUsuario($row['fkemailusuario']);
                $objVariablesPorIndicador->setFechaDato($row['fechadato']);
                $arregloVariablesPorIndicador[$i] = $objVariablesPorIndicador;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();

        return $arregloVariablesPorIndicador;
    }
}
?>
