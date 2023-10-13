<?php
class ControlTipoIndicador{
    var $objTipoIndicador;

    function __construct($objTipoIndicador){
        $this->objTipoIndicador = $objTipoIndicador;
    }
    function guardar(){
        $id = $this->objTipoIndicador->getId(); 
        $nom = $this->objTipoIndicador->getNombre();
            
        $comandoSql = "INSERT INTO tipoindicador(id,nombre) VALUES ('$id', '$nom')";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }
    
    function consultar(){
        $id= $this->objTipoIndicador->getId(); 
    
        $comandoSql = "SELECT * FROM tipoindicador WHERE id = '$id'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if ($row = $recordSet->fetch_array(MYSQLI_BOTH)){
            $this->objTipoIndicador->setContrasena($row['contrasena']);
        }
        $objControlConexion->cerrarBd();
        return $this->objTipoIndicador;
    }

    function modificar(){
        $id = $this->objTipoIndicador->getId(); 
        $nom = $this->objTipoIndicador->getNombre();
        
        $comandoSql = "UPDATE tipoindicador SET id='$id' WHERE nombre = '$nom'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function borrar(){
        $id= $this->objTipoIndicador->getId(); 
        $comandoSql = "DELETE FROM tipoindicador WHERE id = '$id'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat'],$GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function listar(){
        $comandoSql = "SELECT * FROM tipoindicador";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if (mysqli_num_rows($recordSet) > 0) {
            $arregloTipoIndicador = array();
            $i = 0;
            while($row = $recordSet->fetch_array(MYSQLI_BOTH)){
                $objTipoIndicador = new TipoIndicador("","");
                $objTipoIndicador->setId($row['id']);
                $objTipoIndicador->setNombre($row['nombre']);
                $arregloTipoIndicador[$i] = $objTipoIndicador;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloTipoIndicador;
    }
}
?>