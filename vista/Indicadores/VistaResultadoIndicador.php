<?php
include '../controlador/configBd.php';
include '../controlador/ControlConexion.php';
include '../controlador/ControlResultadoIndicador.php';
include '../modelo/ResultadoIndicador.php';

$boton = "";
$id = "";
$fechaCalculo = "";
$resultado = "";
$fkIndicador = "";

$objControlResultadoIndicador = new ControlResultadoIndicador(null);
$arregloResultadoIndicador = $objControlResultadoIndicador->listar();

if (isset($_POST['bt'])) $boton = $_POST['bt'];
if (isset($_POST['txtId'])) $id = $_POST['txtId'];

switch ($boton) {
    case 'Guardar':
        $objResultadoIndicador = new ResultadoIndicador($id, $resultado, $fechaCalculo, $fkIndicador);
        $objControlResultadoIndicador = new ControlResultadoIndicador($objResultadoIndicador);
        $objControlResultadoIndicador->guardar();
        header('Location: VistaResultadoIndicador.php');
        break;
    case 'Consultar':
        $objResultadoIndicador = new ResultadoIndicador($id, "", "", "");
        $objControlResultadoIndicador = new ControlResultadoIndicador($objResultadoIndicador);
        $objResultadoIndicador = $objControlResultadoIndicador->consultar();
        $resultado = $objResultadoIndicador->getResultado();
        $fechaCalculo = $objResultadoIndicador->getFechaCalculo();
        $fkIndicador = $objResultadoIndicador->getFkIndicador();
        break;
    case 'Modificar':
        $objResultadoIndicador = new ResultadoIndicador($id, $resultado, $fechaCalculo, $fkIndicador);
        $objControlResultadoIndicador = new ControlResultadoIndicador($objResultadoIndicador);
        $objControlResultadoIndicador->modificar();
        header('Location: VistaResultadoIndicador.php');
        break;
    case 'Borrar':
        $objResultadoIndicador = new ResultadoIndicador($id, "", "", "");
        $objControlResultadoIndicador = new ControlResultadoIndicador($objResultadoIndicador);
        $objControlResultadoIndicador->borrar();
        header('Location: VistaResultadoIndicador.php');
        break;

    default:
        break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ResultadoIndicador</title>
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
                            <h2 class="miEstilo">Gestión <b>ResultadoIndicador</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#crudModal" class="btn btn-primary" data-toggle="modal"><i class="material-icons">&#xf02e;</i> <span>Gestión ResultadoIndicador</span></a>
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
                            <th>ID Resultado</th>
                            <th>ID Indicador</th>
                            <th>Fecha Calculo</th>
                            <th>Resultado</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($arregloResultadoIndicador); $i++) {
                        ?>
                            <tr>
                                <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                        <label for="checkbox1"></label>
                                    </span>
                                </td>
                                <td><?php echo $arregloResultadoIndicador[$i]->getId(); ?></td>
                                <td><?php echo $arregloResultadoIndicador[$i]->getFkIndicador(); ?></td>
                                <td><?php echo $arregloResultadoIndicador[$i]->getFechaCalculo(); ?></td>
                                <td><?php echo $arregloResultadoIndicador[$i]->getResultado(); ?></td>
                                <td>
                                    <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xe254;</i></a>
                                    <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xe872;</i></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Showing <?php echo $i ?><b></b> out of <b><?php echo count($arregloResultadoIndicador) ?></b> entries</div>
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
                <form action="vistaResultadoIndicador.php" method="post">
                    <div class="modal-header">                      
                        <h4 class="modal-title">ResultadoIndicador</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">                    
                        <div class="form-group">
                            <label>ID Resultado</label>
                            <input type="text" id="txtId" name="txtId" class="form-control" value="<?php echo $id ?>">
                        </div>
                        <div class="form-group">
                            <label>ID Indicador</label>
                            <input type="text" id="txtFkIndicador" name="txtFkIndicador" class="form-control" value="<?php echo $fkIndicador ?>">
                        </div>
                        <div class="form-group">
                            <label>Resultado</label>
                            <input type="text" id="txtResultado" name="txtResultado" class="form-control" value="<?php echo $resultado ?>">
                        </div>
                        <div class="form-group">
                            <label>Fecha Calculo</label>
                            <input type="text" id="txtFechaCalculo" name="txtFechaCalculo" class="form-control" value="<?php echo $fechaCalculo ?>">
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
