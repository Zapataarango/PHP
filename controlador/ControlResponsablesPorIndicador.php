<?php
class ControlResponsablesPorIndicador{
    var $objResponsableIndicador;

    function __construct($objResponsableIndicador){
        $this->objResponsableIndicador = $objResponsableIndicador;
    }
    function guardar(){
        $fkidresponsable = $this->objResponsableIndicador->getIdResponsable(); 
        $fkidindicador = $this->objResponsableIndicador->getIdIndicador();
        $fechaasignacion = $this->objResponsableIndicador->getFechaAsignacion();
        $comandoSql = "INSERT INTO responsablesporindicador(fkidresponsable,fkidindicador,fechaasignacion) VALUES ('$fkidresponsable', '$fkidindicador', '$fechaasignacion')";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }
    


    function borrar(){
        $fkidresponsable = $this->objResponsableIndicador->getIdResponsable(); 
        $comandoSql = "DELETE FROM responsablesporindicador WHERE fkidresponsable = '$fkidresponsable'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat'],$GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function listar(){
        $comandoSql = "SELECT * FROM responsablesporindicador";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if (mysqli_num_rows($recordSet) > 0) {
            $arregloResponsableIndicador = array();
            $i = 0;
            while($row = $recordSet->fetch_array(MYSQLI_BOTH)){
                $objResponsableIndicador = new ResponsablesPorIndicador("","","");
                $objResponsableIndicador->setIdResponsable($row['fkidresponsable']);
                $objResponsableIndicador->setIdIndicador($row['fkidindicador']);
                $objResponsableIndicador->setFechaAsignacion($row['fechaasignacion']);
                $arregloResponsableIndicador[$i] = $objResponsableIndicador;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloResponsableIndicador;
    }
}
?>