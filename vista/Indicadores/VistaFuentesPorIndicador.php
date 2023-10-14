<?php
include '../controlador/configBd.php';
include '../controlador/ControlConexion.php';
include '../controlador/ControlFuentesPorIndicador.php';
include '../modelo/FuentesPorIndicador.php';

$boton = "";
$fkidFuente = "";
$fkidIndicador = "";
$objFuentesPorIndicador = new ControlFuentesPorIndicador(null);
$arregloFuentesPorIndicador = $objFuentesPorIndicador->listar();

if (isset($_POST['bt'])) $boton = $_POST['bt']; // Toma del arreglo post el valor del botón
if (isset($_POST['txtFkIdFuente'])) $fkidFuente = $_POST['txtFkIdFuente'];
if (isset($_POST['txtFkIdIndicador'])) $fkidIndicador = $_POST['txtFkIdIndicador'];

switch ($boton) {
    case 'Guardar':
        $objFuentesPorIndicador = new FuentesPorIndicador($fkidFuente, $fkidIndicador);
        $objControlFuentesPorIndicador = new ControlFuentesPorIndicador($objFuentesPorIndicador);
        $objControlFuentesPorIndicador->guardar();
        header('Location: VistaFuentesPorIndicador.php');
        break;
    case 'Consultar':
        $objFuentesPorIndicador = new FuentesPorIndicador($fkidFuente, $fkidIndicador);
        $objControlFuentesPorIndicador = new ControlFuentesPorIndicador($objFuentesPorIndicador);
        $objFuentesPorIndicador = $objControlFuentesPorIndicador->consultar();
        $fkidFuente = $objFuentesPorIndicador->getFkIdFuente();
        $fkidIndicador = $objFuentesPorIndicador->getFkIdIndicador();
        break;
    case 'Modificar':
        $objFuentesPorIndicador = new FuentesPorIndicador($fkidFuente, $fkidIndicador);
        $objControlFuentesPorIndicador = new ControlFuentesPorIndicador($objFuentesPorIndicador);
        $objControlFuentesPorIndicador->modificar();
        header('Location: VistaFuentesPorIndicador.php');
        break;
    case 'Borrar':
        $objFuentesPorIndicador = new FuentesPorIndicador($fkidFuente, $fkidIndicador);
        $objControlFuentesPorIndicador = new ControlFuentesPorIndicador($objFuentesPorIndicador);
        $objControlFuentesPorIndicador->borrar();
        header('Location: VistaFuentesPorIndicador.php');
        break;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Fuentes Por Indicador</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vista/css/misCss.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2 class="miEstilo">Gestión <b>Fuentes Por Indicador</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#crudModal" class="btn btn-primary" data-toggle="modal"><i class="material-icons">&#Xf02e;</i> <span>Gestión Fuentes Por Indicador</span></a>
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
                            <th>ID Fuente</th>
                            <th>ID Indicador</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($arregloFuentesPorIndicador); $i++) {
                        ?>
                            <tr>
                                <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                        <label for="checkbox1"></label>
                                    </span>
                                </td>
                                <td><?php echo $arregloFuentesPorIndicador[$i]->getFkIdFuente(); ?></td>
                                <td><?php echo $arregloFuentesPorIndicador[$i]->getFkIdIndicador(); ?></td>
                                <td>
                                    <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                    <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </
