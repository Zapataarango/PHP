<?php
include '../controlador/configBd.php';
include '../controlador/ControlConexion.php';
include '../controlador/ControlIndicador.php';
include '../modelo/Indicador.php'; 

include '../controlador/ControlRepresenVisual.php';
include '../modelo/RepresenVisual.php'; 

include '../controlador/ControlRepresenVisualPorIndicador.php';
include '../modelo/RepresenVisualPorIndicador.php';

include '../controlador/ControlFuente.php';
include '../modelo/Fuente.php';

include '../controlador/ControlFuentesPorIndicador.php';
include '../modelo/FuentesPorIndicador.php';

include '../controlador/ControlActor.php';
include '../modelo/Actor.php';

include '../controlador/ControlVariable.php';
include '../modelo/Variable.php';

include '../controlador/ControlVariablesPorIndicador.php';
include '../modelo/VariablesPorIndicador.php';

include '../controlador/ControlTipoIndicador.php';
include '../modelo/TipoIndicador.php';

include '../controlador/ControlResponsablesPorIndicador.php';
include '../modelo/ResponsablesPorIndicador.php';



$boton = "";
$id = ""; 
$nom = "";
$codigo = "";
$objetivo = "";
$alcance = "";
$formula = "";
$meta = "";
$meta = "";
$fkidindicador = "";
$listbox1 = array();
$listbox2 = array();
$listbox3 = array();
$listbox4 = array();
$objIndicador = new ControlIndicador(null);
$arregloIndicadores = $objIndicador->listar();

$objActor = new ControlActor(null);
$arregloActor = $objActor->listar();

$objRepresenVisual = new ControlRepresenVisual(null);
$arregloRepresenVisual = $objRepresenVisual->listar();

$objFuente = new ControlFuente(null);
$arregloFuentes = $objFuente->listar();

$objVariables = new ControlVariable(null);
$arregloVariables = $objVariables->listar();

$objTipoIndicador = new ControlTipoIndicador(null);
$arregloTipoIndicador = $objTipoIndicador->listar();

$objResponsableIndicador = new ControlResponsablesPorIndicador(null);
$arregloResponsableIndicador = $objResponsableIndicador->listar();

if (isset($_POST['bt'])) $boton = $_POST['bt'];
if (isset($_POST['txtId'])) $id = $_POST['txtId'];
if (isset($_POST['txtCodigo'])) $codigo = $_POST['txtCodigo'];
if (isset($_POST['txtNombre'])) $nom = $_POST['txtNombre'];
if (isset($_POST['txtObjetivo'])) $objetivo = $_POST['txtObjetivo'];
if (isset($_POST['txtAlcance'])) $alcance = $_POST['txtAlcance'];
if (isset($_POST['txtFormula'])) $formula = $_POST['txtFormula'];
if (isset($_POST['txtMeta'])) $meta = $_POST['txtMeta'];
if (isset($_POST['listbox1'])) $listbox1 = $_POST['listbox1'];
if (isset($_POST['listbox2'])) $listbox2 = $_POST['listbox2'];
if (isset($_POST['listbox3'])) $listbox3 = $_POST['listbox3'];
if (isset($_POST['listbox4'])) $listbox4 = $_POST['listbox4'];

switch ($boton) {
    case 'Guardar':
        if ($listbox1 !="") {
        $objIndicador = new Indicador("",$codigo, $nom, $objetivo, $alcance, $formula, 1, 15, $meta,5, 5, "2.5.3.2.11.5", 0, 0, 0);
        $objControlIndicador = new ControlIndicador($objIndicador);
        $fkidindicador = $objControlIndicador->guardar(); 
			if ($listbox1 != ""){
				for($i = 0; $i < count($listbox1); $i++){
					$cadenas = explode(";", $listbox1[$i]);
					$fkidrepresenvisual = $cadenas[0];
            
					$objRepresenVisualPorIndicador = new RepresenVisualPorIndicador($fkidrepresenvisual, $fkidindicador);
					$objControlRepresenVisualPorIndicador= new ControlRepresenVisualPorIndicador($objRepresenVisualPorIndicador);
					$objControlRepresenVisualPorIndicador->guardar();
				}
            }
                
                if ($listbox2 != ""){
                    for($i = 0; $i < count($listbox2); $i++){
                        $cadenas = explode(";", $listbox2[$i]);
                        $idResponsable = $cadenas[0];
                        date_default_timezone_set('America/Bogota');
                        $timestamp = time();
                        $fechaAsignacion = date("Y-m-d H:i:s", $timestamp);
                        $objResponsableIndicador = new ResponsablesPorIndicador($idResponsable, $fkidindicador, $fechaAsignacion);
		                $objControlTipoActor = new ControlResponsablesPorIndicador($objResponsableIndicador);
		                $objControlTipoActor->guardar();
                    }
                }

                    if ($listbox3 != ""){
                        for($i = 0; $i < count($listbox3); $i++){
                            $cadenas = explode(";", $listbox3[$i]);
                            $fkidfuente = $cadenas[0];
                            $objfuentesPorIndicador = new FuentesPorIndicador($fkidfuente, $fkidindicador);
                            $objControlFuentesPorIndicador = new ControlFuentesPorIndicador($objfuentesPorIndicador);
                            $objControlFuentesPorIndicador->guardar();
                        }
                    }

                    if ($listbox4 != ""){
                        for($i = 0; $i < count($listbox4); $i++){
                            $cadenas = explode(";", $listbox4[$i]);
                            $fkidvariable = $cadenas[0];
                            date_default_timezone_set('America/Bogota');
                             $timestamp = time();
                             $fechaAsignacion = date("Y-m-d H:i:s", $timestamp);
                            $id = $idResponsable;
                             $objVariablesPorIndicador = new VariablesPorIndicador("",$fkidvariable, $fkidindicador,"40","admin@empresa.com",$fechaAsignacion);
                             $objControlVariablesPorIndicador = new ControlVariablesPorIndicador($objVariablesPorIndicador);
                             $objControlVariablesPorIndicador->guardar();
                        }
                    }
        }
        header('Location: VistaIndicador.php');
        break;
    case 'Consultar':
        $objIndicador = new Indicador($id, "", "", "", "", "", "", "", "", "", "", "", "", "", "");
        $objControlIndicador = new ControlIndicador($objIndicador);
        $objIndicador = $objControlIndicador->consultar();
        $id = $objIndicador->getId();
        $codigo = $objIndicador->getCodigo();
        $nombre = $objIndicador->getNombre();
        $objetivo = $objIndicador->getObjetivo();
        $alcance = $objIndicador->getAlcance();
        $formula = $objIndicador->getFormula();
        $fkidtipoindicador = $objIndicador->getFkidtipoindicador();
        $fkidunidadmedicion = $objIndicador->getFkidunidadmedicion();
        $meta = $objIndicador->getMeta();
        $fkidsentido = $objIndicador->getFkidsentido();
        $fkidfrecuencia = $objIndicador->getFkidfrecuencia();
        $fkidarticulo = $objIndicador->getFkidarticulo();
        $fkidliteral = $objIndicador->getFkidliteral();
        $fkidnumeral = $objIndicador->getFkidnumeral();
        $fkidparagrafo = $objIndicador->getFkidparagrafo();
        break;
    case 'Modificar':
        $objIndicador = new Indicador($id, $codigo, $nombre, $objetivo, $alcance, $formula, $fkidtipoindicador, $fkidunidadmedicion, $meta, $fkidsentido, $fkidfrecuencia, $fkidarticulo, $fkidliteral, $fkidnumeral, $fkidparagrafo);
        $objControlIndicador = new ControlIndicador($objIndicador);
        $objControlIndicador->modificar();
        header('Location: VistaIndicador.php');
        break;
    case 'Borrar':
        $objIndicador = new Indicador("","", $nom, "", "", "", "", "", "", "", "", "", "", "", "");
        $objControlIndicador = new ControlIndicador($objIndicador);
        $objControlIndicador->borrar();
        header('Location: VistaIndicador.php');
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
    <title>Indicadores</title>
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
                            <h2>Gestión <b>indicadores</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#crudModal" class="btn btn-primary" data-toggle="modal"><i class="material-icons">&#Xe8e5;</i> <span>Gestión indicadores</span></a>
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
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Objetivo</th>
                            <th>Alcance</th>
                            <th>Formula</th>
                            <th>ID Tipo Indicador</th>
                            <th>ID Unidad Medición</th>
                            <th>Meta</th>
                            <th>ID Sentido</th>
                            <th>ID Frecuencia</th>
                            <th>ID Artículo</th>
                            <th>ID Literal</th>
                            <th>ID Numeral</th>
                            <th>ID Parágrafo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($arregloIndicadores); $i++) {
                        ?>
                            <tr>
                                <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                        <label for="checkbox1"></label>
                                    </span>
                                </td>
                                <td><?php echo $arregloIndicadores[$i]->getId(); ?></td>
                                <td><?php echo $arregloIndicadores[$i]->getCodigo(); ?></td>
                                <td><?php echo $arregloIndicadores[$i]->getNombre(); ?></td>
                                <td><?php echo $arregloIndicadores[$i]->getObjetivo(); ?></td>
                                <td><?php echo $arregloIndicadores[$i]->getAlcance(); ?></td>
                                <td><?php echo $arregloIndicadores[$i]->getFormula(); ?></td>
                                <td><?php echo $arregloIndicadores[$i]->getFkidtipoindicador(); ?></td>
                                <td><?php echo $arregloIndicadores[$i]->getFkidunidadmedicion(); ?></td>
                                <td><?php echo $arregloIndicadores[$i]->getMeta(); ?></td>
                                <td><?php echo $arregloIndicadores[$i]->getFkidsentido(); ?></td>
                                <td><?php echo $arregloIndicadores[$i]->getFkidfrecuencia(); ?></td>
                                <td><?php echo $arregloIndicadores[$i]->getFkidarticulo(); ?></td>
                                <td><?php echo $arregloIndicadores[$i]->getFkidliteral(); ?></td>
                                <td><?php echo $arregloIndicadores[$i]->getFkidnumeral(); ?></td>
                                <td><?php echo $arregloIndicadores[$i]->getFkidparagrafo(); ?></td>
                                <td>
                                    <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                    <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Showing <?php echo $i ?><b></b> out of <b><?php echo count($arregloIndicadores) ?></b> entries</div>
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
            <form action="VistaIndicador.php" method="post">
            <div class="modal-header">
                        <h4 class="modal-title">Indicadore</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home">Datos de indicadores</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menuRepresenVisualIndicador">Representación Visual por Indicador</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menuResponsablePorIndicador">Responsable por Indicador</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menuFuentesPorIndicador">Fuentes por Indicador</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menuVariablesPorIndicador">Variables por Indicador</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menuTipoIndicador">Tipo de Indicador</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                    <div class="tab-content">
                
                        <div id="home" class="container tab-pane active"><br>
                        <div class="form-group">
                            <label>codigo</label>
                            <input type="text" id="txtId" name="txtCodigo" class="form-control" value="<?php echo $codigo ?>">
                        </div>
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" id="txtNombre" name="txtNombre" class="form-control" value="<?php echo $nom ?>">
                        </div>
                        <div class="form-group">
                            <label>Objetivo</label>
                            <input type="text" id="txtObjetivo" name="txtObjetivo" class="form-control" value="<?php echo $objetivo ?>">
                        </div>
                        <div class="form-group">
                            <label>Alcance</label>
                            <input type="text" id="txtAlcance" name="txtAlcance" class="form-control" value="<?php echo $alcance ?>">
                        </div>
                        <div class="form-group">
                            <label>Formula</label>
                            <input type="text" id="txtFormula" name="txtFormula" class="form-control" value="<?php echo $formula ?>">
                        </div>
                        <div class="form-group">
                            <label>Meta</label>
                            <input type="text" id="txtMeta" name="txtMeta" class="form-control" value="<?php echo $meta ?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" id="btnGuardar" name="bt" class="btn btn-success" value="Guardar">
                            <input type="submit" id="btnConsultar" name="bt" class="btn btn-success" value="Consultar">
                            <input type="submit" id="btnModificar" name="bt" class="btn btn-warning" value="Modificar">
                            <input type="submit" id="btnBorrar" name="bt" class="btn btn-warning" value="Borrar">
                        </div>
                        </div>
                        <div id="menuRepresenVisualIndicador" class="container tab-pane fade"><br>
							<div class="container">
								<div class="form-group">
									<label for="combobox1">Representación visual por indicador</label>
								<select class="form-control" id="combobox1" name="combobox1">
									<?php for($i=0; $i<count($arregloRepresenVisual); $i++){ ?>
									<option value="<?php echo $arregloRepresenVisual[$i]->getId().";". $arregloRepresenVisual[$i]->getNombre(); ?>">
										<?php echo $arregloRepresenVisual[$i]->getId().";". $arregloRepresenVisual[$i]->getNombre(); ?>
									</option>
									<?php } ?>
								</select>
								<br>
								<label for="listbox1">Representación visual elegida: </label>
								<select multiple class="form-control" id="listbox1" name="listbox1[]">
									
								</select>
								</div>
									<div class="form-group">
										<button type="button" id="btnAgregarItem" name="bt" class="btn btn-success" onclick="agregarItem('combobox1', 'listbox1')">Agregar Item</button>
										<button type="button" id="btnRemoverItem" name="bt" class="btn btn-success" onclick="removerItem('listbox1')">Remover Item</button>
									</div>
								</div>
							</div>
                        <div id="menuResponsablePorIndicador" class="container tab-pane fade"><br>
                            <div class="container">
						    		<div class="form-group">
                                        <label for="combobox2">Responsable por indicador</label>
                                        <select class="form-control" id="combobox2" name="combobox2">
						    			<?php for($i=0; $i<count($arregloActor); $i++){ ?>
						    			<option value="<?php echo $arregloActor[$i]->getId().";". $arregloActor[$i]->getNombre(); ?>">
						    				<?php echo $arregloActor[$i]->getId().";". $arregloActor[$i]->getNombre(); ?>
						    			</option>
						    			<?php } ?>
						    		</select>
						    		<br>
						    		<label for="listbox2">Responsable elegido: </label>
						    		<select multiple class="form-control" id="listbox2" name="listbox2[]">
                                        
						    		</select>
						    		</div>
						    			<div class="form-group">
						    				<button type="button" id="btnAgregarItem" name="bt" class="btn btn-success" onclick="agregarItem('combobox2', 'listbox2')">Agregar Item</button>
						    				<button type="button" id="btnRemoverItem" name="bt" class="btn btn-success" onclick="removerItem('listbox2')">Remover Item</button>
						    			</div>
						    		</div>
						</div>

                        <div id="menuFuentesPorIndicador" class="container tab-pane fade"><br>
                            <div class="container">
						    		<div class="form-group">
                                        <label for="combobox3">Fuentes por indicador</label>
                                        <select class="form-control" id="combobox3" name="combobox3">
						    			<?php for($i=0; $i<count($arregloFuentes); $i++){ ?>
						    			<option value="<?php echo $arregloFuentes[$i]->getId().";". $arregloFuentes[$i]->getNombre(); ?>">
						    				<?php echo $arregloFuentes[$i]->getId().";". $arregloFuentes[$i]->getNombre(); ?>
						    			</option>
						    			<?php } ?>
						    		</select>
						    		<br>
						    		<label for="listbox3">Fuentes elegidas </label>
						    		<select multiple class="form-control" id="listbox3" name="listbox3[]">
                                        
						    		</select>
						    		</div>
						    			<div class="form-group">
						    				<button type="button" id="btnAgregarItem" name="bt" class="btn btn-success" onclick="agregarItem('combobox3', 'listbox3')">Agregar Item</button>
						    				<button type="button" id="btnRemoverItem" name="bt" class="btn btn-success" onclick="removerItem('listbox3')">Remover Item</button>
						    			</div>
						    		</div>
						</div>

                        <div id="menuVariablesPorIndicador" class="container tab-pane fade"><br>
                            <div class="container">
						    		<div class="form-group">
                                        <label for="combobox4">Variables indicador</label>
                                        <select class="form-control" id="combobox4" name="combobox4">
						    			<?php for($i=0; $i<count($arregloVariables); $i++){ ?>
						    			<option value="<?php echo $arregloVariables[$i]->getId().";". $arregloVariables[$i]->getNombre(); ?>">
						    				<?php echo $arregloVariables[$i]->getId().";". $arregloVariables[$i]->getNombre(); ?>
						    			</option>
						    			<?php } ?>
						    		</select>
						    		<br>
						    		<label for="listbox3">Variables elegidas</label>
						    		<select multiple class="form-control" id="listbox4" name="listbox4[]">
                                        
						    		</select>
						    		</div>
						    			<div class="form-group">
						    				<button type="button" id="btnAgregarItem" name="bt" class="btn btn-success" onclick="agregarItem('combobox4', 'listbox4')">Agregar Item</button>
						    				<button type="button" id="btnRemoverItem" name="bt" class="btn btn-success" onclick="removerItem('listbox4')">Remover Item</button>
						    			</div>
						    		</div>
						</div>

                        <div id="menuTipoIndicador" class="container tab-pane fade"><br>
                            <div class="container">
						    		<div class="form-group">
                                        <label for="combobox5">Tipo indicador</label>
                                        <select class="form-control" id="combobox4" name="combobox5">
						    			<?php for($i=0; $i<count($arregloTipoIndicador); $i++){ ?>
						    			<option value="<?php echo $arregloTipoIndicador[$i]->getId().";". $arregloTipoIndicador[$i]->getNombre(); ?>">
						    				<?php echo $arregloTipoIndicador[$i]->getId().";". $arregloTipoIndicador[$i]->getNombre(); ?>
						    			</option>
						    			<?php } ?>
						    		</select>
						    		<br>
						    		<label for="listbox3">Tipo elegido</label>
						    		<select multiple class="form-control" id="listbox5" name="listbox4[]">
                                        
						    		</select>
						    		</div>
						    			<div class="form-group">
						    				<button type="button" id="btnAgregarItem" name="bt" class="btn btn-success" onclick="agregarItem('combobox5', 'listbox5')">Agregar Item</button>
						    				<button type="button" id="btnRemoverItem" name="bt" class="btn btn-success" onclick="removerItem('listbox5')">Remover Item</button>
						    			</div>
						    		</div>
						</div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    </div>
                </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</body>

</html>