<?php
include '../controlador/configBd.php';
include '../controlador/ControlConexion.php';
include '../controlador/Indicadores/ControlVariable.php';
include '../modelo/Indicadores/Variable';

$boton = "";
$id = "";
$nombre = "";
$fechacreacion = "";
$fkemailusuario = "";

$objVariable = new ControlVariable(null);
$arregloVariables = $objVariable->listar();

if (isset($_POST['bt'])) $boton = $_POST['bt'];
if (isset($_POST['txtId'])) $id = $_POST['txtId'];
if (isset($_POST['txtNombre'])) $nombre = $_POST['txtNombre'];
if (isset($_POST['txtFechaCreacion'])) $fechacreacion = $_POST['txtFechaCreacion'];
if (isset($_POST['txtFkEmailUsuario'])) $fkemailusuario = $_POST['txtFkEmailUsuario'];

switch ($boton) {
    case 'Guardar':
        $objVariable = new Variable($id, $nombre, $fechacreacion, $fkemailusuario);
        $objControlVariable = new ControlVariable($objVariable);
        $objControlVariable->guardar();
        header('Location: VistaVariable.php');
        break;

    case 'Consultar':
        $objVariable = new Variable($id, "", "", "");
        $objControlVariable = new ControlVariable($objVariable);
        $objVariable = $objControlVariable->consultar();
        $nombre = $objVariable->getNombre();
        $fechacreacion = $objVariable->getFechaCreacion();
        $fkemailusuario = $objVariable->getFkEmailUsuario();
        break;

    case 'Modificar':
        $objVariable = new Variable($id, $nombre, $fechacreacion, $fkemailusuario);
        $objControlVariable = new ControlVariable($objVariable);
        $objControlVariable->modificar();
        header('Location: VistaVariable.php');
        break;

    case 'Borrar':
        $objVariable = new Variable($id, "", "", "");
        $objControlVariable = new ControlVariable($objVariable);
        $objControlVariable->borrar();
        header('Location: VistaVariable.php');
        break;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Variables</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vista/css/misCss.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="../vista/js/misFunciones.js"></script>
</head>

<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2 class="miEstilo">Gestión <b>variables</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#crudModal" class="btn btn-primary" data-toggle="modal"><i class="material-icons">&#Xf02e;</i> <span>Gestión de variables</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label>
                                </span>
                            </th>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Fecha de Creación</th>
                            <th>Email del Usuario</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($arregloVariables); $i++) {
                        ?>
                            <tr>
                                <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                        <label for="checkbox1"></label>
                                    </span>
                                </td>
                                <td><?php echo $arregloVariables[$i]->getId(); ?></td>
                                <td><?php echo $arregloVariables[$i]->getNombre(); ?></td>
                                <td><?php echo $arregloVariables[$i]->getFechaCreacion(); ?></td>
                                <td><?php echo $arregloVariables[$i]->getFkEmailUsuario(); ?></td>
                                <td>
                                    <a href="#editVariableModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                    <a href="#deleteVariableModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Showing <?php echo $i ?><b></b> out of <b><?php echo count($arregloVariables) ?></b> entries</div>
                    <ul class="pagination">
                        <li class="page-item disabled"><a href="#">Previous</a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item active"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                        <li class="page-item"><a href="#" class="page-link">Next</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- CRUD Modal HTML -->
    <div id="crudModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="vistaUsuarios.php" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Variable</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" id="txtId" name="txtId" class="form-control" value="<?php echo $id ?>">
                        </div>
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" id="txtNombre" name="txtNombre" class="form-control" value="<?php echo $nombre ?>">
                        </div>
                        <div class="form-group">
                            <label>Fecha de Creación</label>
                            <input type="text" id="txtFechaCreacion" name="txtFechaCreacion" class="form-control" value="<?php echo $fechacreacion ?>">
                        </div>
                        <div class="form-group">
                            <label>Email del Usuario</label>
                            <input type="text" id="txtFkEmailUsuario" name="txtFkEmailUsuario" class="form-control" value="<?php echo $fkemailusuario ?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" id="btnGuardar" name="bt" class="btn btn-success" value="Guardar">
                            <input type="submit" id="btnConsultar" name="bt" class="btn btn-success" value="Consultar">
                            <input type="submit" id="btnModificar" name="bt" class="btn btn-warning" value="Modificar">
                            <input type="submit" id="btnBorrar" name="bt" class="btn btn-warning" value="Borrar">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
