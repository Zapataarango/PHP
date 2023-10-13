<?php
class ControlSeccion{
    var $objSeccion;

    function __construct($objSeccion){
        $this->objSeccion = $objSeccion;
    }
    function guardar(){
        $id = $this->objSeccion->getId(); 
        $nom = $this->objSeccion->getNombre();
            
        $comandoSql = "INSERT INTO Seccion(id,nombre) VALUES ('$id', '$nom')";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }
    
    function consultar(){
        $id= $this->objSeccion->getId(); 
    
        $comandoSql = "SELECT * FROM Seccion WHERE id = '$id'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if ($row = $recordSet->fetch_array(MYSQLI_BOTH)){
            $this->objSeccion->setContrasena($row['contrasena']);
        }
        $objControlConexion->cerrarBd();
        return $this->objRol;
    }

    function modificar(){
        $id = $this->objSeccion->getId(); 
        $nom = $this->objSeccion->getNombre();
        
        $comandoSql = "UPDATE Seccion SET id='$id' WHERE nombre = '$nom'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function borrar(){
        $id= $this->objSeccion->getId(); 
        $comandoSql = "DELETE FROM Seccion WHERE id = '$id'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat'],$GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function listar(){
        $comandoSql = "SELECT * FROM Seccion";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if (mysqli_num_rows($recordSet) > 0) {
            $arregloSeccion = array();
            $i = 0;
            while($row = $recordSet->fetch_array(MYSQLI_BOTH)){
                $objSeccion = new Seccion("","");
                $objSeccion->setId($row['id']);
                $objSeccion->setNombre($row['nombre']);
                $arregloSeccion[$i] = $objSeccion;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloSeccion;
    }
}
?>