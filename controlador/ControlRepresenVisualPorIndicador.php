<?php
class ControlRepresenVisualPorIndicador {
    var $objRepresenVisualIndicador;

    function __construct($objRepresenVisualIndicador) {
        $this->objRepresenVisualIndicador = $objRepresenVisualIndicador;
    }

    function guardar() {
        $fkidindicador = $this->objRepresenVisualIndicador->getFkIdIndicador();
        $fkidrepresenvisual = $this->objRepresenVisualIndicador->getFkIdRepresenVisual();
        $comandoSql = "INSERT INTO represenvisualporindicador(fkidindicador, fkidrepresenvisual) VALUES ('$fkidindicador', '$fkidrepresenvisual')";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }


    function borrar() {
        $fkidindicador = $this->objRepresenVisualIndicador->getFkIdIndicador();
        $comandoSql = "DELETE FROM represenvisualporindicador WHERE fkidindicador = '$fkidindicador'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function listar() {
        $comandoSql = "SELECT * FROM represenvisualporindicador";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if (mysqli_num_rows($recordSet) > 0) {
            $arregloRepresenVisualIndicador = array();
            $i = 0;
            while ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
                $objRepresenVisualIndicador = new RepresenVisualPorIndicador("", "");
                $objRepresenVisualIndicador->setFkIdIndicador($row['fkidindicador']);
                $objRepresenVisualIndicador->setFkIdRepresenVisual($row['fkidrepresenvisual']);
                $arregloRepresenVisualIndicador[$i] = $objRepresenVisualIndicador;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloRepresenVisualIndicador;
    }

    function listarNombres() {
        $comandoSql = "SELECT indicador.nombre AS nombre_indicador, represenvisual.nombre AS nombre_represenvisual
        FROM represenvisualporindicador
        JOIN indicador ON represenvisualporindicador.fkidindicador = indicador.id
        JOIN represenvisual ON represenvisualporindicador.fkidrepresenvisual = represenvisual.id;";
        
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        
        $arregloRepresenVisualIndicadorNombres = array();
    
        while ($row = mysqli_fetch_assoc($recordSet)) {
            $arregloRepresenVisualIndicadorNombres[] = $row;
        }
        
        $objControlConexion->cerrarBd();
        return $arregloRepresenVisualIndicadorNombres;
    }
}
?>
