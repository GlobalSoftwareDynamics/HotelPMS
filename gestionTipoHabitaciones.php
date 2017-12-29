<?php
include('session.php');
include('declaracionFechas.php');
include('funciones.php');
if(isset($_SESSION['login'])){
	include('header.php');
	include('navbarRecepcion.php');

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
								<a class="dropdown-item" href="nuevaHabitacion.php" style="font-size: 14px;">Registrar Nuevo Tipo de Habitación</a>
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

	<?php
	include('footer.php');
}
?>
