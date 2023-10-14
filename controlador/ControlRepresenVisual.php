<?php
class ControlRepresenVisual{
    var $objRepresenVisual;

    function __construct($objRepresenVisual){
        $this->objRepresenVisual = $objRepresenVisual;
    }
    function guardar(){
        $id = $this->objRepresenVisual->getId(); 
        $nom = $this->objRepresenVisual->getNombre();
            
        $comandoSql = "INSERT INTO Represenvisual(id,nombre) VALUES ('$id', '$nom')";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }
    
    function consultar(){
        $id= $this->objRepresenVisual->getId(); 
    
        $comandoSql = "SELECT * FROM Represenvisual WHERE id = '$id'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if ($row = $recordSet->fetch_array(MYSQLI_BOTH)){
            $this->objRepresenVisual->setContrasena($row['contrasena']);
        }
        $objControlConexion->cerrarBd();
        return $this->objRepresenVisual;
    }

    function modificar(){
        $id = $this->objRepresenVisual->getId(); 
        $nom = $this->objRepresenVisual->getNombre();
        
        $comandoSql = "UPDATE Represenvisual SET id='$id' WHERE nombre = '$nom'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function borrar(){
        $id= $this->objRepresenVisual->getId(); 
        $comandoSql = "DELETE FROM Represenvisual WHERE id = '$id'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat'],$GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function listar(){
        $comandoSql = "SELECT * FROM Represenvisual";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if (mysqli_num_rows($recordSet) > 0) {
            $arregloRepresenVisuals = array();
            $i = 0;
            while($row = $recordSet->fetch_array(MYSQLI_BOTH)){
                $objRepresenVisual = new RepresenVisual("","");
                $objRepresenVisual->setId($row['id']);
                $objRepresenVisual->setNombre($row['nombre']);
                $arregloRepresenVisuals[$i] = $objRepresenVisual;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloRepresenVisuals;
    }
}
?>