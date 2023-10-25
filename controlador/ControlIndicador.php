<?php
class ControlIndicador {
    var $objIndicador;

    function __construct($objIndicador) {
        $this->objIndicador = $objIndicador;
    }

    function guardar() {
        $codigo = $this->objIndicador->getCodigo();
        $nombre = $this->objIndicador->getNombre();
        $objetivo = $this->objIndicador->getObjetivo();
        $alcance = $this->objIndicador->getAlcance();
        $formula = $this->objIndicador->getFormula();
        $fkidtipoindicador = $this->objIndicador->getFkidtipoindicador();
        $fkidunidadmedicion = $this->objIndicador->getFkidunidadmedicion();
        $meta = $this->objIndicador->getMeta();
        $fkidsentido = $this->objIndicador->getFkidsentido();
        $fkidfrecuencia = $this->objIndicador->getFkidfrecuencia();
        $fkidarticulo = $this->objIndicador->getFkidarticulo();
        $fkidliteral = $this->objIndicador->getFkidliteral();
        $fkidnumeral = $this->objIndicador->getFkidnumeral();
        $fkidparagrafo = $this->objIndicador->getFkidparagrafo();

        $comandoSql = "INSERT INTO indicador (codigo, nombre, objetivo, alcance, formula, fkidtipoindicador, fkidunidadmedicion, meta, fkidsentido, fkidfrecuencia, fkidarticulo, fkidliteral, fkidnumeral, fkidparagrafo)
            VALUES ('$codigo', '$nombre', '$objetivo', '$alcance', '$formula', '$fkidtipoindicador', '$fkidunidadmedicion', '$meta', '$fkidsentido', '$fkidfrecuencia', '$fkidarticulo', '$fkidliteral', '$fkidnumeral', '$fkidparagrafo')";

        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $insertId = $objControlConexion->obtenerUltimoIdInsertado();
        $objControlConexion->cerrarBd();
        return $insertId;
    }

    function consultar() {
        $id = $this->objIndicador->getId();

        $comandoSql = "SELECT * FROM indicador WHERE id = '$id'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
            // Aquí debes asignar los valores a las propiedades del objeto Indicador
            $this->objIndicador->setId($row['id']);
            $this->objIndicador->setCodigo($row['codigo']);
            $this->objIndicador->setNombre($row['nombre']);
            $this->objIndicador->setObjetivo($row['objetivo']);
            $this->objIndicador->setAlcance($row['alcance']);
            $this->objIndicador->setFormula($row['formula']);
            $this->objIndicador->setFkidtipoindicador($row['fkidtipoindicador']);
            $this->objIndicador->setFkidunidadmedicion($row['fkidunidadmedicion']);
            $this->objIndicador->setMeta($row['meta']);
            $this->objIndicador->setFkidsentido($row['fkidsentido']);
            $this->objIndicador->setFkidfrecuencia($row['fkidfrecuencia']);
            $this->objIndicador->setFkidarticulo($row['fkidarticulo']);
            $this->objIndicador->setFkidnumeral($row['fkidnumeral']);
            $this->objIndicador->setFkidliteral($row['fkidliteral']);
            $this->objIndicador->setFkidparagrafo($row['fkidparagrafo']);
        }
        $objControlConexion->cerrarBd();
        return $this->objIndicador;
    }

    function modificar() {
        $id = $this->objIndicador->getId();
        $codigo = $this->objIndicador->getCodigo();
        $nombre = $this->objIndicador->getNombre();
        // Asignar los demás atributos

        $comandoSql = "UPDATE indicador SET codigo = '$codigo', nombre = '$nombre' WHERE id = '$id'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function borrar() {
        $nom = $this->objIndicador->getNombre();
        $comandoSql = "DELETE FROM indicador WHERE nombre = '$nom'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function listar() {
        $comandoSql = "SELECT * FROM indicador";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if (mysqli_num_rows($recordSet) > 0) {
            $arregloIndicador = array();
            $i = 0;
            while ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
                $objIndicador = new Indicador("", "", "", "", "", "", "", "", "", "", "", "", "", "", "");
                $objIndicador->setId($row['id']);
                $objIndicador->setCodigo($row['codigo']);
                $objIndicador->setNombre($row['nombre']);
                $objIndicador->setObjetivo($row['objetivo']);
                $objIndicador->setAlcance($row['alcance']);
                $objIndicador->setFormula($row['formula']);
                $objIndicador->setFkidtipoindicador($row['fkidtipoindicador']);
                $objIndicador->setFkidunidadmedicion($row['fkidunidadmedicion']);
                $objIndicador->setMeta($row['meta']);
                $objIndicador->setFkidsentido($row['fkidsentido']);
                $objIndicador->setFkidfrecuencia($row['fkidfrecuencia']);
                $objIndicador->setFkidarticulo($row['fkidarticulo']);
                $objIndicador->setFkidnumeral($row['fkidnumeral']);
                $objIndicador->setFkidliteral($row['fkidliteral']);
                $objIndicador->setFkidparagrafo($row['fkidparagrafo']);
                $arregloIndicador[$i] = $objIndicador;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloIndicador;
    }
}
?>
