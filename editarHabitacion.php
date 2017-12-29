<?php
include('declaracionFechas.php');
include('funciones.php');
include('session.php');
if(isset($_SESSION['login'])){
	include('header.php');
	include('navbarRecepcion.php');

	$idHabitacion = null;
	$idTipoHabitacion = null;
	$tipoHabitacion = null;
	$idVista = null;
	$vista = null;

	$query = mysqli_query($link,"SELECT * FROM Habitacion WHERE idHabitacion = '{$_POST['idHabitacionSeleccionada']}'");
	while($row = mysqli_fetch_array($query)) {
		$idHabitacion = $row['idHabitacion'];
		$query2 = mysqli_query($link, "SELECT * FROM TipoHabitacion WHERE idTipoHabitacion = '{$row['idTipoHabitacion']}'");
		while ($row2 = mysqli_fetch_array($query2)) {
			$idTipoHabitacion = $row['idTipoHabitacion'];
			$tipoHabitacion = $row2['descripcion'];
		}
		$query2 = mysqli_query($link, "SELECT * FROM TipoVista WHERE idTipoVista = '{$row['idTipoVista']}'");
		while ($row2 = mysqli_fetch_array($query2)) {
			$idVista = $row['idTipoVista'];
			$vista = $row2['descripcion'];
		}
	}

	if(isset($_POST['addCaracteristica'])){
		$insert = mysqli_query($link,"INSERT INTO CaracteristicaHabitacion VALUES ('{$_POST['selectCaracteristica']}','{$_POST['idHabitacionSeleccionada']}','{$_POST['valor']}')");
		$queryPerformed = "INSERT INTO CaracteristicaHabitacion VALUES ({$_POST['selectCaracteristica']},{$_POST['idHabitacionSeleccionada']},{$_POST['valor']})";
		$databaseLog = mysqli_query($link, "INSERT INTO DatabaseLog (idColaborador,fechaHora,evento,tipo,consulta) VALUES ('{$_SESSION['user']}','{$date}','INSERT HABITACION','INSERT','{$queryPerformed}')");
	}

	if(isset($_POST['deleteCaracteristica'])){
		$delete = mysqli_query($link,"DELETE FROM CaracteristicaHabitacion WHERE idHabitacion = '{$_POST['idHabitacionSeleccionada']}' AND idCaracteristica = '{$_POST['deleteCaracteristica']}'");
	}

	if(isset($_POST['deleteTarifa'])){
		$delete = mysqli_query($link,"DELETE FROM Tarifa WHERE idTarifa = '{$_POST['deleteTarifa']}'");
	}

	if(isset($_POST['addTarifa'])){
	    $insert = mysqli_query($link,"INSERT INTO Tarifa(idTipoHabitacion, descripcion, valor, moneda)
                  VALUES ('{$idTipoHabitacion}','{$_POST['descripcion']}','{$_POST['valor']}','{$_POST['moneda']}')");
    }
	?>

    <section class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-inverse card-info">
                        <div class="float-left">
                            <i class="fa fa-bed"></i>
                            Editar Habitación
                        </div>
                        <div class="float-right">
                            <div class="dropdown">
                                <input type='submit' value='Guardar' name='editHabitacion' class='btn btn-light btn-sm' form="form">
                                <input type='submit' value='Regresar' name='regresar' class='btn btn-light btn-sm' form="form">
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="col-12">
                            <div class="spacer15"></div>
                            <form method="post" action="gestionHabitaciones.php" id="form">
                                <div class="form-group row">
                                    <label for="numero" class="col-2 col-form-label">Nro./Nombre Habitación:</label>
                                    <div class="col-2">
                                        <input class="form-control" type="number" id="numero" name="numero" value="<?php echo $_POST['idHabitacionSeleccionada'];?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tipoHabitacion" class="col-2 col-form-label">Tipo Habitación:</label>
                                    <div class="col-10">
                                        <select class="form-control" name="tipoHabitacion" id="tipoHabitacion">
											<?php
											$query = mysqli_query($link,"SELECT * FROM TipoHabitacion");
											while($row = mysqli_fetch_array($query)){
												if($row['idTipoHabitacion'] == $idTipoHabitacion){
													echo "<option value='{$idTipoHabitacion}' selected>{$tipoHabitacion}</option>";
												}else{
													echo "<option value='{$row['idTipoHabitacion']}'>{$row['descripcion']}</option>";
												}
											}
											?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="vista" class="col-2 col-form-label">Vista:</label>
                                    <div class="col-10">
                                        <select class="form-control" name="vista" id="vista">
											<?php
											$query = mysqli_query($link,"SELECT * FROM TipoVista");
											while($row = mysqli_fetch_array($query)){
												if($row['idTipoVista'] == $idVista){
													echo "<option value='{$idVista}' selected>{$vista}</option>";
												}else{
													echo "<option value='{$row['idTipoVista']}'>{$row['descripcion']}</option>";
												}
											}
											?>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="spacer15"></div>
    <section class="container">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header card-inverse card-info">
                        <div class="float-left">
                            <i class="fa fa-info-circle"></i>
                            Características
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="col-12">
                            <form method="post">
                                <table class="table text-center">
                                    <thead>
                                    <tr>
                                        <th>Característica</th>
                                        <th>Descripción</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php
									$query = mysqli_query($link,"SELECT * FROM CaracteristicaHabitacion WHERE idHabitacion = '{$idHabitacion}'");
									while($row = mysqli_fetch_array($query)){
										echo "<tr>";
										$query2 = mysqli_query($link,"SELECT * FROM Caracteristica WHERE idCaracteristica = '{$row['idCaracteristica']}'");
										while($row2 = mysqli_fetch_array($query2)){
											echo "<td><strong>{$row2['descripcion']}:</strong></td>";
										}
										echo "<td>{$row['valor']}</td>";
										echo "<td>
                                                <form method='post' id='caractForm'>
                                                    <input type='hidden' name='idHabitacionSeleccionada' value='{$_POST['idHabitacionSeleccionada']}'>
                                                    <button type='submit' class='btn btn-sm btn-outline-danger' value='{$row['idCaracteristica']}' formaction='#' form='caractForm' name='deleteCaracteristica'>Eliminar</button>
                                                </form>
                                            </td>";
										echo "</tr>";
									}
									?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalCaracteristica">Agregar Característica</button>
                        </div>
                        <div class="spacer20"></div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header card-inverse card-info">
                        <div class="float-left">
                            <i class="fa fa-money"></i>
                            Tarifas
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="col-12">
                            <form method="post">
                                <table class="table text-center">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Descripción</th>
                                        <th class="text-center">Costo</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php
									$query = mysqli_query($link,"SELECT * FROM Tarifa WHERE idTipoHabitacion = '{$idTipoHabitacion}'");
									while($row = mysqli_fetch_array($query)){
										echo "<tr>";
										echo "<td>{$row['descripcion']}</td>";
										echo "<td>{$row['moneda']} {$row['valor']}</td>";
										echo "<td>
                                                <form method='post' id='tarifaForm'>
                                                    <input type='hidden' name='idHabitacionSeleccionada' value='{$_POST['idHabitacionSeleccionada']}'>
                                                    <button type='submit' class='btn btn-sm btn-outline-danger' value='{$row['idTarifa']}' formaction='#' form='tarifaForm' name='deleteTarifa'>Eliminar</button>
                                                </form>
                                            </td>";
										echo "</tr>";
									}
									?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalCrearTarifa">Crear Nueva Tarifa</button>
                        </div>
                        <div class="spacer20"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <form method="post" action="#" id="formModal">
        <input type="hidden" name="idHabitacionSeleccionada" value="<?php echo $_POST['idHabitacionSeleccionada'];?>">
        <div class="modal fade" id="modalCaracteristica" tabindex="-1" role="dialog" aria-labelledby="modalCaracteristica" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Característica a Habitación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group row">
                                <select class="form-control" name="selectCaracteristica">
                                    <option selected disabled>Seleccionar</option>
									<?php
									$query = mysqli_query($link,"SELECT * FROM Caracteristica");
									while($row = mysqli_fetch_array($query)){
										echo "<option value='{$row['idCaracteristica']}'>{$row['descripcion']}</option>";
									}
									?>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label" for="valor">Valor:</label>
                                <input type="text" name="valor" id="valor" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" form="formModal" value="Submit" name="addCaracteristica">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form method="post" action="#" id="formCrearTarifa">
        <input type="hidden" name="idHabitacionSeleccionada" value="<?php echo $_POST['idHabitacionSeleccionada'];?>">
        <div class="modal fade" id="modalCrearTarifa" tabindex="-1" role="dialog" aria-labelledby="modalCrearTarifa" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Crear Nueva Tarifa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form id="formTarifa" method="post" action="#">
                                <div class="form-group row">
                                    <label for="descripcion" class="col-4 col-form-label">Descripción:</label>
                                    <div class="col-8">
                                        <input class="form-control" type="text" id="descripcion" name="descripcion">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="valor" class="col-4 col-form-label">Valor:</label>
                                    <div class="col-3">
                                        <input class="form-control" type="number" id="valor" name="valor" min=0>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="moneda" class="col-4 col-form-label">Moneda:</label>
                                    <div class="col-8">
                                        <select name="moneda" id="moneda" class="form-control">
                                            <option selected disabled>Seleccionar</option>
                                            <option value="$">Dólares</option>
                                            <option value="S/.">Soles</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button form="formTarifa" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button class="btn btn-primary" form="formCrearTarifa" value="Submit" name="addTarifa">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
	<?php

	include('footer.php');
}
?>
