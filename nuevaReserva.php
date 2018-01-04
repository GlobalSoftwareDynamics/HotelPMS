<?php
include('session.php');
if(isset($_SESSION['login'])){
	include('header.php');
	include('navbarRecepcion.php');
    include('declaracionFechas.php');
	if(isset($_POST['addReserva'])){
	    $insert = mysqli_query($link,"INSERT INTO Reserva VALUES ('{$_POST['idReserva']}',{$_SESSION['user']},{$_POST['dni']},1,'{$dateTime}',0,0)");
	    $queryPerformed = "INSERT INTO Reserva VALUES ({$_POST['idReserva']}{$_SESSION['user']},{$_POST['dni']},1,{$dateTime},0,0)";
	    $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','CREAR RESERVA','{$queryPerformed}')");
    }

    $queryReserva = mysqli_query($link,"SELECT * FROM Reserva WHERE idReserva = {$_POST['idReserva']}");
	?>

	<section class="container">
		<div class="row">
			<div class="col-6">
				<div class="card mb-3">
					<div class="card-header">
						<i class="fa fa-table"></i> Detalles del Huésped
						<div class="float-right">
							<button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#modalReserva">Nueva Reserva</button>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-6">
								<p><strong>Nombre:</strong> <?php echo $_POST['nombres']?></p>
								<p><strong>Teléfono:</strong> <?php echo $_POST['telefono']?></p>
							</div>
							<div class="col-6">
								<p><strong>DNI:</strong> <?php echo $_POST['dni']?></p>
								<p><strong>Email:</strong> <?php echo $_POST['email']?></p>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-12 text-center">
								<table class="table">
									<thead>
									<tr>
										<th>Nombres</th>
										<th>Fechas</th>
										<th>Noches</th>
										<th>Tipo</th>
										<th>Cargos</th>
										<th>Acciones</th>
									</tr>
									</thead>
                                    <tbody>
                                    <tr>
                                        <td>Juan Pérez</td>
                                        <td>03/03/2018</td>
                                        <td>4</td>
                                        <td>Adulto</td>
                                        <td>Sí</td>
                                        <td>
                                            <form method="post">
                                                <input type="hidden" name="idReserva" value="<?php echo $_POST['idReserva'];?>">
                                                <input type="submit" class="btn btn-sm btn-danger" value="Eliminar">
                                            </form>
                                        </td>
                                    </tr>
                                    </tbody>
								</table>
								<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalHuesped">Añadir Huésped</button>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-12 text-center">
								<h6><strong>Preferencias</strong></h6>
								<textarea class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="card mb-3">
					<div class="card-header">
						<i class="fa fa-table"></i> Detalles Generales</div>
					<div class="card-body">
						<div class="row">
							<div class="col-6">
                                <p><strong>Detalles de la Estadía</strong></p>
                                <div class="form-group">
                                    <label class="col-form-label sr-only" for="fechaInicio">Check-In:</label>
                                    <input type="text" name="fechaInicio" id="fechaInicio" class="form-control" placeholder="Fecha de Check-In">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label sr-only" for="noches">Noches:</label>
                                    <input type="number" name="noches" id="noches" class="form-control" placeholder="Número de Noches">
                                </div>
                                <hr>
                                <p><strong>Detalles del Recojo</strong></p>
                                <div class="form-group">
                                    <label class="col-form-label sr-only" for="tipoRecojo">Tipo de Recojo:</label>
                                    <select class="form-control" name="tipoRecojo" id="tipoRecojo">
                                        <option>Seleccionar Tipo</option>
                                        <option>Aeropuerto</option>
                                        <option>Autobus</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label sr-only" for="horaRecojo">Hora de Recojo:</label>
                                    <input type="datetime-local" name="horaRecojo" id="horaRecojo" class="form-control" placeholder="Hora de Recojo">
                                </div>
                                <hr>
                                <p><strong>Sujeto a impuestos</strong></p>
                                <div class="custom-controls-stacked d-block my-3">
                                    <label class="custom-control custom-radio">
                                        <input id="sujetoImpuestos1" name="sujetoImpuestos" type="radio" class="custom-control-input" required>
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Sí</span>
                                    </label>
                                    <label class="custom-control custom-radio">
                                        <input id="sujetoImpuestos2" name="sujetoImpuestos" type="radio" class="custom-control-input" required>
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">No</span>
                                    </label>
                                </div>
							</div>
							<div class="col-6">
                                <p><strong>Detalles del Pago</strong></p>
                                <div class="form-group">
                                    <label class="col-form-label sr-only" for="tarifa">Tarifa:</label>
                                    <select class="form-control" name="tarifa" id="tarifa">
                                        <option>Seleccionar Tarifa</option>
                                        <option>Tarifa Estándar (S/. 300)</option>
                                        <option>Tarifa Corporativa (S/. 250)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label sr-only" for="impuesto">Impuesto:</label>
                                    <input type="number" step="0.01" name="impuesto" id="impuesto" class="form-control" placeholder="Valor de Impuestos" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label sr-only" for="adicionales">Adicionales:</label>
                                    <input type="number" step="0.01" name="adicionales" id="adicionales" class="form-control" placeholder="Valor de Adicionales">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="col-form-label sr-only" for="subtotal">Subtotal:</label>
                                    <input type="number" step="0.01" name="subtotal" id="subtotal" class="form-control" placeholder="Subtotal" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label sr-only" for="descuento">Descuento:</label>
                                    <input type="number" step="0.01" name="descuento" id="descuento" class="form-control" placeholder="Descuento">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="col-form-label sr-only" for="total">Total:</label>
                                    <input type="number" step="0.01" name="total" id="total" class="form-control" placeholder="Total" disabled>
                                </div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-12 text-center">
								<h6><strong>Tarifas/Paquetes</strong></h6>
								<table class="table">
									<thead>
									<tr>
										<th>Paquete/Tarifa</th>
										<th>Fecha</th>
										<th>Monto</th>
										<th>Noches</th>
									</tr>
									</thead>
                                    <tbody>
                                    <tr>
                                        <td>All Meals Incl.</td>
                                        <td>03/03/2018 - 07/03/2018</td>
                                        <td>500.00</td>
                                        <td>4</td>
                                    </tr>
                                    </tbody>
								</table>
								<button class="btn btn-sm btn-primary">Cambiar Tarifa/Paquete</button>
								<button class="btn btn-sm btn-primary">Agregar Descuento</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

    <form method="post" action="#">
        <div class="modal fade" id="modalHuesped" tabindex="-1" role="dialog" aria-labelledby="modalReserva" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nuevo Huésped</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group row">
                                <label class="col-form-label" for="nombres">Nombre Completo:</label>
                                <input type="text" name="nombres" id="nombres" class="form-control">
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label" for="tarifa">Tarifa:</label>
                                <select class="form-control" id="tarifa" name="tarifa">
                                    <option>Seleccionar</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label class="col-form-label" for="fechaInicio">Fecha Inicio:</label>
                                    <input type="date" name="fechaInicio" id="fechaInicio" class="form-control">
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label" for="fechaFin">Fecha Fin:</label>
                                    <input type="date" name="fechaFin" id="fechaFin" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label class="col-form-label" for="tipo">Tipo:</label>
                                    <select class="form-control" name="tipo" id="tipo">
                                        <option>Seleccionar</option>
                                        <option>Adulto</option>
                                        <option>Niño</option>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <div class="spacer30"></div>
                                    <label class="col-form-label" for="cargos">Cargos:</label>
                                    <label class="custom-control custom-checkbox al">
                                        <input type="checkbox" class="custom-control-input" name="checkboxDscto">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Sí</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cerrar">
                        <input type="submit" class="btn btn-primary" name="addReserva" value="Guardar Cambios">
                    </div>
                </div>
            </div>
        </div>
    </form>

	<?php
	include('footer.php');
}
?>