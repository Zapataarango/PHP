<?php
    include '../controlador/configBd.php';
    include '../controlador/ControlConexion.php';
    include '../controlador/ControlVariablesPorIndicador.php';
    include '../modelo/VariablesPorIndicador.php';

    $boton = "";
    $fkidVariable = "";
    $fkIdIndicador = "";
    $dato = "";
    $fkEmailUsuario = "";
    $fechaDato = "";

    $objVariablesPorIndicador = new ControlVariablesPorIndicador(null);
    $arregloVariablesPorIndicador = $objVariablesPorIndicador->listar();

    if (isset($_POST['bt'])) $boton = $_POST['bt'];
    if (isset($_POST['txtId'])) $id = $_POST['txtId'];

    switch ($boton) {
        case 'Guardar':
            $objVariablesPorIndicador = new VariablesPorIndicador($id,$fkidVariable, $fkIdIndicador, $dato, $fkEmailUsuario, $fechaDato);
            $objControlVariablesPorIndicador = new ControlVariablesPorIndicador($objVariablesPorIndicador);
            $objControlVariablesPorIndicador->guardar();
            header('Location: VistaVariablesPorIndicador.php');
            break;
        case 'Borrar':
            $objVariablesPorIndicador = new VariablesPorIndicador($id,$fkidVariable, $fkIdIndicador, "", "", "");
            $objControlVariablesPorIndicador = new ControlVariablesPorIndicador($objVariablesPorIndicador);
            $objControlVariablesPorIndicador->borrar();
            header('Location: VistaVariablesPorIndicador.php');
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
    <title>VariablesPorIndicador</title>
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
                            <h2 class="miEstilo">Gestión <b>VariablesPorIndicador</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#crudModal" class="btn btn-primary" data-toggle="modal"><i class="material-icons">&#xf02e;</i> <span>Gestión VariablesPorIndicador</span></a>
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
                            <th>ID Variable</th>
                            <th>ID Indicador</th>
                            <th>Dato</th>
                            <th>Email Usuario</th>
                            <th>Fecha Dato</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for($i = 0; $i < count($arregloVariablesPorIndicador); $i++) {
                        ?>
                            <tr>
                                <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                        <label for="checkbox1"></label>
                                    </span>
                                </td>
                                <td><?php echo $arregloVariablesPorIndicador[$i]->getFkIdVariable();?></td>
                                <td><?php echo $arregloVariablesPorIndicador[$i]->getFkIndicador();?></td>
                                <td><?php echo $arregloVariablesPorIndicador[$i]->getDato();?></td>
                                <td><?php echo $arregloVariablesPorIndicador[$i]->getFkEmailUsuario();?></td>
                                <td><?php echo $arregloVariablesPorIndicador[$i]->getFechaDato();?></td>
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
                    <div class="hint-text">Showing <?php echo$i?><b></b> out of <b><?php echo count($arregloVariablesPorIndicador) ?></b> entries</div>
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
                <form action="vistaVariablesPorIndicador.php" method="post">
                    <div class="modal-header">                      
                        <h4 class="modal-title">VariablesPorIndicador</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">                    
                        <div class="form-group">
                            <label>ID Variable</label>
                            <input type="email" id="txtFkIdVariable" name="txtFkIdVariable" class="form-control" value="<?php echo $fkidVariable ?>">
                        </div>
                        <div class="form-group">
                            <label>ID Indicador</label>
                            <input type="text" id="txtFkIndicador" name="txtFkIndicador" class="form-control" value="<?php echo $fkIdIndicador ?>">
                        </div>
                        <div class="form-group">
                            <label>Dato</label>
                            <input type="text" id="txtDato" name="txtDato" class="form-control" value="<?php echo $dato ?>">
                        </div>
                        <div class="form-group">
                            <label>Email Usuario</label>
                            <input type="text" id="txtFkEmailUsuario" name="txtFkEmailUsuario" class="form-control" value="<?php echo $fkEmailUsuario ?>">
                        </div>
                        <div class="form-group">
                            <label>Fecha Dato</label>
                            <input type="text" id="txtFechaDato" name="txtFechaDato" class="form-control" value="<?php echo $fechaDato ?>">
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
