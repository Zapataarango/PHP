<?php
	include '../controlador/configBd.php';
	include '../controlador/ControlConexion.php';
	include '../controlador/ControlActor.php';
	include '../controlador/ControlTipoActor.php';
	include '../modelo/Actor.php';
	include '../modelo/TipoActor.php';
	$boton = "";
	$id = "";
	$nom = "";
	$nombre = "";
    $fkIdTipoActor = "";
	$combobox1 = "";
	$objActor = new ControlActor(null);
	$arregloActor = $objActor->listar();

	$objControlTipoActor = new ControlTipoActor(null);
	$arregloTipoActor = $objControlTipoActor->listar();
	if (isset($_POST['bt'])) $boton = $_POST['bt'];//toma del arreglo post el value del bt	
	if (isset($_POST['txtId'])) $id = $_POST['txtId'];
	if (isset($_POST['txtNombre'])) $nom = $_POST['txtNombre'];
	if (isset($_POST['combobox1'])) $combobox1 = $_POST['combobox1'];
	var_dump($combobox1);
	switch ($boton) {
		case 'Guardar':		
			if ($combobox1 != ""){		
					list($fkIdTipoActor, $nombre) = explode(";", $combobox1);
					$objActor = new Actor($id, $nom, $fkIdTipoActor);
					$objControlActor = new ControlActor($objActor);
					$objControlActor->guardar();
				
			}
			header('Location: VistaActor.php');
			break;
		case 'Borrar':
			$objActor = new Actor($id, "", "");
			$objControlTipoActor = new ControlActor($objActor);
			$objControlTipoActor->borrar();
			header('Location: VistaActor.php');
			break;
		
		default:
			# code...
			break;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Actores</title>
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
						<h2 class="miEstilo">Gestión <b>actores</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#crudModal" class="btn btn-primary" data-toggle="modal"><i class="material-icons">&#Xf02e;</i> <span>Gestión actores</span></a>
						
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
                        <th>Tipo actor</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					for($i = 0; $i < count($arregloActor); $i++){
					?>
						<tr>
							<td>
								<span class="custom-checkbox">
									<input type="checkbox" id="checkbox1" name="options[]" value="1">
									<label for="checkbox1"></label>
								</span>
							</td>
							<td><?php echo $arregloActor[$i]->getId();?></td>
							<td><?php echo $arregloActor[$i]->getNombre();?></td>
                            <td><?php echo $arregloActor[$i]->getTipoActor();?></td>
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
				<div class="hint-text">Showing <?php echo$i?><b></b> out of <b><?php echo count($arregloActor) ?></b> entries</div>
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
<!-- crud Modal HTML -->
<div id="crudModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="vistaActor.php" method="post">
				<div class="modal-header">						
					<h4 class="modal-title">Actor</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
				<div class="container">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#home">Datos de actor</a>
							</li>
							<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#menu1">Tipo de actor</a>
							</li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div id="home" class="container tab-pane active"><br>
							<div class="form-group">
						<label>ID</label>
						<input type="text" id="txtId" name="txtId" class="form-control" value="<?php echo $id ?>">
							</div>
							<div class="form-group">
						<label>Nombre</label>
						<input type="text" id="txtNombre" name="txtNombre" class="form-control" value="<?php echo $nom ?>">
							</div>
							<div class="form-group">
									<input type="submit" id="btnGuardar" name="bt" class="btn btn-success" value="Guardar">
									<input type="submit" id="btnBorrar" name="bt" class="btn btn-warning" value="Borrar">
							</div>
							</div>
							<div id="menu1" class="container tab-pane fade"><br>
							<div class="container">
								<div class="form-group">
									<label for="combobox1">Tipos de actor</label>
								<select class="form-control" id="combobox1" name="combobox1">
									<?php for($i=0; $i<count($arregloTipoActor); $i++){ ?>
									<option value="<?php echo $arregloTipoActor[$i]->getId().";". $arregloTipoActor[$i]->getNombre(); ?>">
										<?php echo $arregloTipoActor[$i]->getId().";". $arregloTipoActor[$i]->getNombre(); ?>
									</option>
									<?php } ?>
								</select>
							</div>
						</div>				
					</div>
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