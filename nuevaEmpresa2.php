<?php
include('funciones.php');
include('declaracionFechas.php');
include('session.php');
if(isset($_SESSION['login'])){
	include('header.php');
    if($_SESSION['userType'] == 1){
        include('navbarRecepcion.php');
    }else{
        include('navbarAdmin.php');
    }

	if(isset($_POST['addContacto'])){
        $dni = 1;
        if($_POST['dni'] != ''){
            $dni = $_POST['dni'];
        }else{
            $id = mysqli_query($link, "SELECT * FROM Contacto");
            $dni += mysqli_num_rows($id);
        }
		$insert = mysqli_query($link,"INSERT INTO Contacto VALUES ('{$dni}','{$_POST['nombreCompleto']}','{$_POST['telefono']}','{$_POST['anexo']}','{$_POST['email']}','{$_POST['area']}','{$_POST['cargo']}')");
		$insert = mysqli_query($link,"INSERT INTO ContactoEmpresa VALUES ('{$_POST['ruc']}','{$dni}')");
	}

	if(isset($_POST['addEmpresa'])){
		$insert = mysqli_query($link,"INSERT INTO Empresa VALUES ('{$_POST['ruc']}','{$_POST['razonSocial']}','{$_POST['rubro']}','{$_POST['direccion']}')");
	}

	if(isset($_POST['eliminar'])){
		$delete = mysqli_query($link,"DELETE FROM ContactoEmpresa WHERE idContacto = '{$_POST['eliminar']}'");
		$delete = mysqli_query($link,"DELETE FROM Contacto WHERE idContacto = '{$_POST['eliminar']}'");
	}
		?>
		<section class="container">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header formularios card-inverse card-info">
							<form method="post" action="gestionEmpresas.php" id="form">
								<div class="float-left">
									<i class="fa fa-industry"></i>
									Listado de Contactos
								</div>
								<div class="float-right">
									<button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#modalContacto">Agregar Contacto</button>
									<input type="submit" value="Finalizar" formaction="gestionEmpresas.php" class="btn btn-sm btn-light">
								</div>
							</form>
						</div>
						<div class="card-block">
							<table class="table text-center">
								<thead>
								<tr>
									<th>Nombre</th>
									<th>Área</th>
									<th>Cargo</th>
									<th>Teléfono</th>
									<th>Anexo</th>
									<th>E-Mail</th>
                                    <th>Acciones</th>
								</tr>
								</thead>
								<tbody>
								<?php
								$query = mysqli_query($link,"SELECT * FROM Contacto WHERE idContacto IN (SELECT idContacto FROM ContactoEmpresa WHERE idEmpresa = '{$_POST['ruc']}')");
								while($fila = mysqli_fetch_array($query)){
									echo "<tr>";
									echo "<td>{$fila['nombreCompleto']}</td>";
									echo "<td>{$fila['area']}</td>";
									echo "<td>{$fila['cargo']}</td>";
									echo "<td>{$fila['telefono']}</td>";
									echo "<td>{$fila['anexo']}</td>";
									echo "<td>{$fila['correoElectronico']}</td>";
									echo "<td>
                                            <form method='post' action='#' id='deleteForm'>
                                                <input type='hidden' name='ruc' value='{$_POST['ruc']}'>
                                                <button type='submit' name='eliminar' value='{$fila['idContacto']}' class='btn btn-sm btn-outline-danger' form='deleteForm'>Eliminar</button>
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
			<input type="hidden" name="ruc" value="<?php echo $_POST['ruc'];?>">
			<div class="modal fade" id="modalContacto" tabindex="-1" role="dialog" aria-labelledby="modalContacto" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Agregar Contacto</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="container-fluid">
								<div class="form-group row">
									<label class="col-form-label" for="dni">DNI:</label>
									<input type="number" min="0" name="dni" id="dni" class="form-control" required>
								</div>
								<div class="form-group row">
									<label class="col-form-label" for="nombreCompleto">Nombre Completo:</label>
									<input type="text" name="nombreCompleto" id="nombreCompleto" class="form-control" required>
								</div>
								<div class="form-group row">
									<label class="col-form-label" for="area">Área:</label>
									<input type="text" name="area" id="area" class="form-control">
								</div>
								<div class="form-group row">
									<label class="col-form-label" for="cargo">Cargo:</label>
									<input type="text" name="cargo" id="cargo" class="form-control">
								</div>
								<div class="form-group row">
									<label class="col-form-label" for="telefono">Teléfono:</label>
									<input type="text" name="telefono" id="telefono" class="form-control">
								</div>
								<div class="form-group row">
									<label class="col-form-label" for="anexo">Anexo:</label>
									<input type="text" name="anexo" id="anexo" class="form-control">
								</div>
								<div class="form-group row">
									<label class="col-form-label" for="email">E-Mail:</label>
									<input type="text" name="email" id="email" class="form-control">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							<button type="submit" class="btn btn-primary" form="formModal" value="Submit" name="addContacto">Guardar Cambios</button>
						</div>
					</div>
				</div>
			</div>
		</form>

		<?php
	include('footer.php');
}
?>