<?php
class ControlFuente{
    var $objFuente;

    function __construct($objFuente){
        $this->objFuente = $objFuente;
    }
    function guardar(){
        $nom = $this->objFuente->getNombre();
            
        $comandoSql = "INSERT INTO Fuente(nombre) VALUES ('$nom')";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }
    
    function consultar(){
        $nom= $this->objFuente->getNombre(); 
    
        $comandoSql = "SELECT * FROM Fuente WHERE nombre = '$nom'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if ($row = $recordSet->fetch_array(MYSQLI_BOTH)){
            $this->objFuente->setContrasena($row['contrasena']);
        }
        $objControlConexion->cerrarBd();
        return $this->objFuente;
    }

    function modificar(){
        $nom = $this->objFuente->getNombre();
        
        $comandoSql = "UPDATE Fuente SET nombre='$nom' WHERE nombre = '$nom'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function borrar(){
        $nom= $this->objFuente->getNombre(); 
        $comandoSql = "DELETE FROM Fuente WHERE nombre = '$nom'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat'],$GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function listar(){
        $comandoSql = "SELECT * FROM Fuente";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if (mysqli_num_rows($recordSet) > 0) {
            $arregloFuentes = array();
            $i = 0;
            while($row = $recordSet->fetch_array(MYSQLI_BOTH)){
                $objFuente = new Fuente("","");
                $objFuente->setId($row['id']);
                $objFuente->setNombre($row['nombre']);
                $arregloFuentes[$i] = $objFuente;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloFuentes;
    }
}
?>