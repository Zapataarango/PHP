<?php
class ControlActor{
    var $objActor;

    function __construct($objActor){
        $this->objActor = $objActor;
    }
    function guardar(){
        $id = $this->objActor->getId(); 
        $nom = $this->objActor->getNombre();
        $fkidtipoactor = $this->objActor->getTipoActor();
            
        $comandoSql = "insert into actor(id,nombre,fkidtipoactor) values ('$id', '$nom', '$fkidtipoactor')";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function borrar(){
        $id= $this->objActor->getId(); 
        $comandoSql = "DELETE FROM actor WHERE id = '$id'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat'],$GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function listar(){
        $comandoSql = "SELECT * FROM actor";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if (mysqli_num_rows($recordSet) > 0) {
            $arregloActor = array();
            $i = 0;
            while($row = $recordSet->fetch_array(MYSQLI_BOTH)){
                $objActor = new Actor("","","");
                $objActor->setId($row['id']);
                $objActor->setNombre($row['nombre']);
                $objActor->setTipoActor($row['fkidtipoactor']);
                $arregloActor[$i] = $objActor;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloActor;
    }
}
?>