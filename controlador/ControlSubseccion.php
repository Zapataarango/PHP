<?php
class ControlSubseccion{
    var $objSubseccion;

    function __construct($objSubseccion){
        $this->objSubseccion = $objSubseccion;
    }
    function guardar(){
        $id = $this->objSubseccion->getId(); 
        $nom = $this->objSubseccion->getNombre();
            
        $comandoSql = "INSERT INTO Subseccion(id,nombre) VALUES ('$id', '$nom')";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }
    
    function consultar(){
        $id= $this->objSubseccion->getId(); 
    
        $comandoSql = "SELECT * FROM Subseccion WHERE id = '$id'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if ($row = $recordSet->fetch_array(MYSQLI_BOTH)){
            $this->objSubseccion->setContrasena($row['contrasena']);
        }
        $objControlConexion->cerrarBd();
        return $this->objSubseccion;
    }

    function modificar(){
        $id = $this->objSubseccion->getId(); 
        $nom = $this->objSubseccion->getNombre();
        
        $comandoSql = "UPDATE Subseccion SET id='$id' WHERE nombre = '$nom'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function borrar(){
        $id= $this->objSubseccion->getId(); 
        $comandoSql = "DELETE FROM Subseccion WHERE id = '$id'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat'],$GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function listar(){
        $comandoSql = "SELECT * FROM Subseccion";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if (mysqli_num_rows($recordSet) > 0) {
            $arregloSubseccion = array();
            $i = 0;
            while($row = $recordSet->fetch_array(MYSQLI_BOTH)){
                $objSubseccion = new Subseccion("","");
                $objSubseccion->setId($row['id']);
                $objSubseccion->setNombre($row['nombre']);
                $arregloSubseccion[$i] = $objSubseccion;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloSubseccion;
    }
}
?>