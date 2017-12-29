<?php
include('session.php');
include('declaracionFechas.php');
include('funciones.php');
if(isset($_SESSION['login'])){
	include('header.php');
	include('navbarRecepcion.php');

	if(isset($_POST['addCaracteristica'])){
		$insert = mysqli_query($link,"INSERT INTO TipoHabitacion (descripcion) VALUES ('{$_POST['valor']}')");
		$queryPerformed = "INSERT INTO TipoHabitacion (descripcion) VALUES ({$_POST['valor']})";
		$databaseLog = mysqli_query($link, "INSERT INTO DatabaseLog (idColaborador,fechaHora,evento,tipo,consulta) VALUES ('{$_SESSION['user']}','{$date}','INSERT CARACTERISTICA','INSERT','{$queryPerformed}')");
	}

if(isset($_POST['deleteTipoHabitacion'])){
	$delete = mysqli_query($link,"DELETE FROM TipoHabitacion WHERE idTipoHabitacion = '{$_POST['deleteTipoHabitacion']}'");
}
	?>

	<section class="container">
		<div class="card">
			<div class="card-header card-inverse card-info">
				<i class="fa fa-list"></i>
				Gestión de Habitaciones
				<div class="float-right">
					<div class="dropdown">
						<button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Acciones
						</button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <form method="post">
                                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#modalCaracteristica">Registrar Nuevo Tipo de Habitación</button>
                            </form>
                        </div>
					</div>
				</div>
			</div>
			<div class="card-block">
				<div class="spacer10"></div>
				<div class="row">
					<div class="col-12">
						<table class="table table-bordered text-center" id="myTable">
							<thead class="thead-default">
							<tr>
								<th class="text-center">Tipo de Habitacion</th>
								<th class="text-center">Acciones</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$query = mysqli_query($link,"SELECT * FROM TipoHabitacion");
							while($row = mysqli_fetch_array($query)){
								echo "<tr>";
								echo "<td>{$row['descripcion']}</td>";
								echo "<td>
										<form method='post' action='detalleTipoHabitacion.php'>
											<button type='submit' value='{$row['idTipoHabitacion']}' name='idTipoHabitacion' class='btn btn-sm btn-outline-primary'>Ver Detalle</button>
											<button type='submit' value='{$row['idTipoHabitacion']}' name='deleteTipoHabitacion' formaction='#' class='btn btn-sm btn-outline-danger ml-3'>Eliminar</button>
										</form>
									</td>";
								echo "</tr>";
							}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

    <form method="post" action="#" id="formModal">
        <input type='hidden' name='idTipoHabitacion' value='<?php echo $_POST['idTipoHabitacion'];?>'>
        <div class="modal fade" id="modalCaracteristica" tabindex="-1" role="dialog" aria-labelledby="modalCaracteristica" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nuevo Tipo de Habitación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group row">
                                <label class="col-form-label" for="valor">Descripción:</label>
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
	<?php
	include('footer.php');
}
?>
