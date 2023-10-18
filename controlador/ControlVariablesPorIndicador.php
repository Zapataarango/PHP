<?php
class ControlVariablesPorIndicador {
    private $objVariablesPorIndicador;

    public function __construct($objVariablesPorIndicador) {
        $this->objVariablesPorIndicador = $objVariablesPorIndicador;
    }

    public function guardar() {
        $id = $this->objVariablesPorIndicador->getId();
        $fkidvariable = $this->objVariablesPorIndicador->getFkIdVariable();
        $fkindicador = $this->objVariablesPorIndicador->getFkIndicador();
        $dato = $this->objVariablesPorIndicador->getDato();
        $fkemailusuario = $this->objVariablesPorIndicador->getFkEmailUsuario();
        $fechadato = $this->objVariablesPorIndicador->getFechaDato();

        $comandoSql = "INSERT INTO variablesporindicador(id, fkidvariable, fkindicador, dato, fkemailusuario, fechadato) VALUES ('$id', '$fkidvariable', '$fkindicador', '$dato', '$fkemailusuario', '$fechadato')";

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
                $objVariablesPorIndicador->setFkIndicador($row['fkidindicador']);
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
