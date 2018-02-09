<?php
include('session.php');
include('funciones.php');
include('declaracionFechas.php');
if(isset($_SESSION['login'])){
	include('header.php');
	include('navbarRecepcion.php');

	if(isset($_POST['addHabitacion'])){
		$insert = mysqli_query($link,"INSERT INTO Habitacion VALUES ('{$_POST['numero']}','{$_POST['tipoHabitacion']}','{$_POST['vista']}',1)");
		$queryPerformed = "INSERT INTO Habitacion VALUES ({$_POST['numero']},{$_POST['tipoHabitacion']},{$_POST['vista']},1)";
		$databaseLog = mysqli_query($link, "INSERT INTO DatabaseLog (idColaborador,fechaHora,evento,tipo,consulta) VALUES ('{$_SESSION['user']}','{$date}','INSERT HABITACION','INSERT','{$queryPerformed}')");

		$search = mysqli_query($link,"SELECT * FROM CaracteristicaTipoHabitacion WHERE idTipoHabitacion = '{$_POST['tipoHabitacion']}'");
		while($fila = mysqli_fetch_array($search)){
			$insert = mysqli_query($link,"INSERT INTO CaracteristicaHabitacion VALUES ('{$fila['idCaracteristica']}','{$_POST['numero']}','{$fila['valor']}')");
			$queryPerformed = "INSERT INTO CaracteristicaHabitacion VALUES ({$fila['idCaracteristica']},{$_POST['numero']},{$fila['valor']})";
			$databaseLog = mysqli_query($link, "INSERT INTO DatabaseLog (idColaborador,fechaHora,evento,tipo,consulta) VALUES ('{$_SESSION['user']}','{$date}','INSERT CARACTERISTICAS STANDARD TIPOHABITACION','INSERT','{$queryPerformed}')");
		}
	}

	if(isset($_POST['addCaracteristica'])){
		$insert = mysqli_query($link,"INSERT INTO CaracteristicaHabitacion VALUES ('{$_POST['selectCaracteristica']}','{$_POST['numero']}','{$_POST['valor']}')");
		$queryPerformed = "INSERT INTO CaracteristicaHabitacion VALUES ({$_POST['selectCaracteristica']},{$_POST['numero']},{$_POST['valor']})";
		$databaseLog = mysqli_query($link, "INSERT INTO DatabaseLog (idColaborador,fechaHora,evento,tipo,consulta) VALUES ('{$_SESSION['user']}','{$date}','INSERT HABITACION','INSERT','{$queryPerformed}')");
	}

	if(isset($_POST['deleteCaracteristica'])){
		$delete = mysqli_query($link,"DELETE FROM CaracteristicaHabitacion WHERE idHabitacion = '{$_POST['numero']}' AND idCaracteristica = '{$_POST['deleteCaracteristica']}'");
	}

	?>

	<section class="container">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header formularios card-inverse card-info">
						<div class="float-left mt-1">
							<i class="fa fa-bed"></i>
							&nbsp;&nbsp;Características de Habitación
						</div>
						<div class="float-right">
							<form method="post" id="formInsumo">
								<button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#modalCaracteristica">Agregar Caracteristica</button>
								<input name="fin" type="submit" form="formInsumo" class="btn btn-light btn-sm" formaction="gestionHabitaciones.php" value="Finalizar">
							</form>
						</div>
					</div>
					<div class="card-block">
						<div class="col-12">
							<div class="spacer20"></div>
							<table class="table text-center">
								<thead>
								<tr>
									<th>Característica</th>
									<th>Valor</th>
									<th>Acciones</th>
								</tr>
								</thead>
								<tbody>
								<?php
								$query = mysqli_query($link,"SELECT * FROM CaracteristicaHabitacion WHERE idHabitacion = {$_POST['numero']}");
								while($row = mysqli_fetch_array($query)){
									$query2 = mysqli_query($link,"SELECT * FROM Caracteristica WHERE idCaracteristica = '{$row['idCaracteristica']}'");
									while($row2 = mysqli_fetch_array($query2)){
										echo "<tr>";
											echo "<td>{$row2['descripcion']}</td>";
											echo "<td>{$row['valor']}</td>";
											echo "<td>
													<form method='post' id='caractForm'>
			                                            <input type='hidden' value='{$_POST['numero']}' name='numero'>
			                                            <button type='submit' class='btn btn-sm btn-outline-danger' value='{$row['idCaracteristica']}' formaction='#' form='caractForm' name='deleteCaracteristica'>Eliminar</button>
			                                        </form>
												</td>";
										echo "</tr>";
									}
								}
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<form method="post" action="nuevaHabitacion2.php" id="formModal">
		<input type="hidden" name="numero" value="<?php echo $_POST['numero'];?>">
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
						<button type="submit" class="btn btn-primary" form="formModal" value="Submit" name="addCaracteristica" formaction="nuevaHabitacion2.php">Guardar Cambios</button>
					</div>
				</div>
			</div>
		</div>
	</form>

	<?php
	include('footer.php');
}
?>