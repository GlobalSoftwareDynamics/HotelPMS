<?php
include('session.php');
include('declaracionFechas.php');
include('funciones.php');
if(isset($_SESSION['login'])){
	include('header.php');
	include('navbarRecepcion.php');

	if(isset($_POST['addCaracteristica'])){
		$insert = mysqli_query($link,"INSERT INTO Caracteristica (descripcion) VALUES ('{$_POST['valor']}')");
		$queryPerformed = "INSERT INTO Caracteristica (descripcion) VALUES ({$_POST['valor']})";
		$databaseLog = mysqli_query($link, "INSERT INTO DatabaseLog (idColaborador,fechaHora,evento,tipo,consulta) VALUES ('{$_SESSION['user']}','{$date}','INSERT CARACTERISTICA','INSERT','{$queryPerformed}')");
	}

	if(isset($_POST['deleteCaracteristica'])){
		$delete = mysqli_query($link,"DELETE FROM Caracteristica WHERE idCaracteristica = '{$_POST['deleteCaracteristica']}'");
	}
	?>

	<script>
        function myFunction() {
            // Declare variables
            var input, filter, table, tr, td, i;
            input = document.getElementById("caracteristica");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    }else{
                        tr[i].style.display = "none";
                    }
                }
            }
        }
	</script>

	<section class="container">
		<div class="card">
			<div class="card-header card-inverse card-info">
				<i class="fa fa-list"></i>
				Gestión de Características
				<div class="float-right">
					<div class="dropdown">
						<button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Acciones
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<form method="post">
								<button type="button" class="dropdown-item" data-toggle="modal" data-target="#modalCaracteristica">Registrar Nueva Característica</button>
							</form>
						</div>
					</div>
				</div>
				<span class="float-right">&nbsp;&nbsp;&nbsp;&nbsp;</span>
				<span class="float-right">
                    <button href="#collapsed" class="btn btn-light btn-sm" data-toggle="collapse">Mostrar Filtros</button>
                </span>
			</div>
			<div class="card-block">
				<div class="row">
					<div class="col-12">
						<div id="collapsed" class="collapse">
							<form class="form-inline justify-content-center" method="post" action="#">
								<label class="sr-only" for="caracteristica">Característica</label>
								<input type="text" class="form-control mt-2 mb-2 mr-2" id="caracteristica" placeholder="Característica" onkeyup="myFunction()">
								<input type="submit" class="btn btn-primary" value="Limpiar" style="padding-left:28px; padding-right: 28px;">
							</form>
						</div>
					</div>
				</div>
				<div class="spacer10"></div>
				<div class="row">
					<div class="col-12">
						<table class="table table-bordered text-center" id="myTable">
							<thead class="thead-default">
							<tr>
								<th class="text-center">Característica</th>
								<th class="text-center">Acciones</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$query = mysqli_query($link,"SELECT * FROM Caracteristica");
							while($row = mysqli_fetch_array($query)){
								echo "<tr>";
								echo "<td>{$row['descripcion']}</td>";
								echo "<td>
                                          <form method='post' id='caracteristicaForm'>
                                                    <button type='submit' class='btn btn-sm btn-outline-danger' value='{$row['idCaracteristica']}' formaction='#' form='caracteristicaForm' name='deleteCaracteristica'>Eliminar</button>
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
						<h5 class="modal-title">Nueva Característica</h5>
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
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
