<?php
class ControlTipoActor{
    var $objTipoActor;

    function __construct($objTipoActor){
        $this->objTipoActor = $objTipoActor;
    }
    function guardar(){
        $id = $this->objTipoActor->getId(); 
        $nom = $this->objTipoActor->getNombre();
            
        $comandoSql = "INSERT INTO tipoactor(id,nombre) VALUES ('$id', '$nom')";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }
    
    function consultar(){
        $id= $this->objTipoActor->getId(); 
    
        $comandoSql = "SELECT * FROM tipoactor WHERE id = '$id'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if ($row = $recordSet->fetch_array(MYSQLI_BOTH)){
            $this->objTipoActor->setContrasena($row['contrasena']);
        }
        $objControlConexion->cerrarBd();
        return $this->objTipoActor;
    }

    function modificar(){
        $id = $this->objTipoActor->getId(); 
        $nom = $this->objTipoActor->getNombre();
        
        $comandoSql = "UPDATE tipoactor SET id='$id' WHERE nombre = '$nom'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function borrar(){
        $id= $this->objTipoActor->getId(); 
        $comandoSql = "DELETE FROM tipoactor WHERE id = '$id'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat'],$GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function listar(){
        $comandoSql = "SELECT * FROM tipoactor";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if (mysqli_num_rows($recordSet) > 0) {
            $arregloTipoActor = array();
            $i = 0;
            while($row = $recordSet->fetch_array(MYSQLI_BOTH)){
                $objTipoActor = new TipoActor("","");
                $objTipoActor->setId($row['id']);
                $objTipoActor->setNombre($row['nombre']);
                $arregloTipoActor[$i] = $objTipoActor;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloTipoActor;
    }
}
?>