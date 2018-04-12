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

        $query = mysqli_query($link,"INSERT INTO Huesped(idEmpresa,idCiudad,idGenero,nacionalidad_idPais,nombreCompleto,direccion,correoElectronico,codigoPostal,telefonoFijo,telefonoCelular,fechaNacimiento,preferencias,vip,contacto,dni) VALUES ('{$_POST['idEmpresa']}',null,null,null,'{$_POST['nombreCompleto']}',null,'{$_POST['email']}',null,'{$_POST['telefono']}','{$_POST['anexo']}',null,null,null,1,'{$_POST['dni']}')");
        $queryPerformed = "INSERT INTO Huesped(idEmpresa,idCiudad,idGenero,nacionalidad_idPais,nombreCompleto,direccion,correoElectronico,codigoPostal,telefonoFijo,telefonoCelular,fechaNacimiento,preferencias,vip,contacto,dni) VALUES ({$_POST['idEmpresa']},null,null,null,{$_POST['nombreCompleto']},null,{$_POST['email']},null,{$_POST['telefono']},{$_POST['anexo']}'null,null,null,1,{$_POST['dni']})";
        $databaseLog = mysqli_query($link, "INSERT INTO DatabaseLog (idColaborador,fechaHora,evento,tipo,consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','Contacto','{$queryPerformed}')");

    }

	if(isset($_POST['addEmpresa'])){
		$insert = mysqli_query($link,"INSERT INTO Empresa VALUES ('{$_POST['ruc']}','{$_POST['razonSocial']}','{$_POST['rubro']}','{$_POST['direccion']}')");
	}

	if(isset($_POST['eliminar'])){

        $query = mysqli_query($link,"UPDATE Huesped SET contacto = 0 WHERE idHuesped = '{$_POST['idHuesped']}'");
        $queryPerformed = "UPDATE Huesped SET contacto = 0 WHERE idHuesped = {$_POST['idHuesped']}";
        $databaseLog = mysqli_query($link, "INSERT INTO DatabaseLog (idColaborador,fechaHora,evento,tipo,consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','DELETE','Contacto','{$queryPerformed}')");

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
									<th>Teléfono Fijo</th>
                                    <th>Teléfono Celular</th>
									<th>E-Mail</th>
                                    <th>Acciones</th>
								</tr>
								</thead>
								<tbody>
								<?php
								$query = mysqli_query($link,"SELECT * FROM Huesped WHERE contacto = 1 AND idEmpresa = '{$_POST['ruc']}')");
								while($fila = mysqli_fetch_array($query)){
									echo "<tr>";
									echo "<td>{$fila['nombreCompleto']}</td>";
									echo "<td>{$fila['telefonoFijo']}</td>";
									echo "<td>{$fila['telefonoCelular']}</td>";
									echo "<td>{$fila['correoElectronico']}</td>";
									echo "<td>
                                            <form method='post' action='#' id='deleteForm'>
                                                <input type='hidden' name='ruc' value='{$_POST['ruc']}'>
                                                <button type='submit' name='eliminar' value='{$fila['idHuesped']}' class='btn btn-sm btn-outline-danger' form='deleteForm'>Eliminar</button>
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
									<label class="col-form-label" for="telefono">Teléfono Fijo:</label>
									<input type="text" name="telefono" id="telefono" class="form-control">
								</div>
								<div class="form-group row">
									<label class="col-form-label" for="anexo">Telefono Celular:</label>
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