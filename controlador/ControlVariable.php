<?php
class ControlVariable {
    private $objVariable;

    public function __construct($objVariable) {
        $this->objVariable = $objVariable;
    }

    public function guardar() {
        $id = $this->objVariable->getId();
        $nombre = $this->objVariable->getNombre();
        $fechacreacion = $this->objVariable->getFechaCreacion();
        $fkemailusuario = $this->objVariable->getFkEmailUsuario();
        
        $comandoSql = "INSERT INTO variable(id, nombre, fechacreacion, fkemailusuario) VALUES ('$id', '$nombre', '$fechacreacion', '$fkemailusuario')";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }
    
    public function consultar() {
        $id = $this->objVariable->getId();
        
        $comandoSql = "SELECT * FROM variable WHERE id = '$id'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
            $this->objVariable->setNombre($row['nombre']);
            $this->objVariable->setFechaCreacion($row['fechacreacion']);
            $this->objVariable->setFkEmailUsuario($row['fkemailusuario']);
        }
        $objControlConexion->cerrarBd();
        return $this->objVariable;
    }

    public function modificar() {
        $id = $this->objVariable->getId();
        $nombre = $this->objVariable->getNombre();
        $fechacreacion = $this->objVariable->getFechaCreacion();
        $fkemailusuario = $this->objVariable->getFkEmailUsuario();
        
        $comandoSql = "UPDATE variable SET nombre = '$nombre', fechacreacion = '$fechacreacion', fkemailusuario = '$fkemailusuario' WHERE id = '$id'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    public function borrar() {
        $id = $this->objVariable->getId();
        $comandoSql = "DELETE FROM variable WHERE id = '$id'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    public function listar() {
        $comandoSql = "SELECT * FROM variable";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if (mysqli_num_rows($recordSet) > 0) {
            $arregloVariable = array();
            $i = 0;
            while($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
                $objVariable = new Variable("", "", "", "");
                $objVariable->setId($row['id']);
                $objVariable->setNombre($row['nombre']);
                $objVariable->setFechaCreacion($row['fechacreacion']);
                $objVariable->setFkEmailUsuario($row['fkemailusuario']);
                $arregloVariable[$i] = $objVariable;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloVariable;
    }
}
?>
