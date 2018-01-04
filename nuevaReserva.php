<?php
include('session.php');
if(isset($_SESSION['login'])){
	include('header.php');
	include('navbarRecepcion.php');
	include('declaracionFechas.php');
	if(isset($_POST['addReserva'])){
		$insert = mysqli_query($link,"INSERT INTO Reserva VALUES ('{$_POST['idReserva']}','{$_SESSION['user']}',{$_POST['dni']},{$_POST['tipoReserva']},'{$dateTime}',0,0)");
		$queryPerformed = "INSERT INTO Reserva VALUES ({$_POST['idReserva']},{$_SESSION['user']},{$_POST['dni']},1,{$dateTime},0,0)";
		$databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','CREAR RESERVA','{$queryPerformed}')");
	}

	$queryReserva = mysqli_query($link,"SELECT * FROM Reserva WHERE idReserva = '{$_POST['idReserva']}'");
	while($rowReserva = mysqli_fetch_array($queryReserva)) {
		$estadoReserva = $rowReserva['idEstado'];
		$queryHuesped = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped = {$rowReserva['idHuesped']}");
		while($rowHuesped = mysqli_fetch_array($queryHuesped)){
			$idHuesped = $rowHuesped['idHuesped'];
			$nombreHuesped = $rowHuesped['nombreCompleto'];
			$telefonoHuesped = $rowHuesped['telefonoCelular'];
			$emailHuesped = $rowHuesped['correoElectronico'];
		}
	}

	if(isset($_POST['addReservaPendiente'])){
	    $insert = mysqli_query($link,"INSERT INTO ReservaPendiente VALUES 
        ('{$_POST['tipoHabitacion']}','{$_POST['idReserva']}','{$_POST['numHabitaciones']}','{$_POST['checkin']}','{$_POST['checkout']}','{$_POST['preferencias']}')");
	    $queryPerformed = "INSERT INTO ReservaPendiente VALUES 
        ({$_POST['tipoHabitacion']},{$_POST['idReserva']},{$_POST['numHabitaciones']},{$_POST['checkin']},{$_POST['checkout']},{$_POST['preferencias']})";
	    $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','DATOS RESERVA PENDIENTE','{$queryPerformed}')");
    }

	if($estadoReserva == '3') {
		?>

        <section class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-table"></i> Detalles de la Reserva
                            <div class="float-right">
                                <button type="button" class="btn btn-sm btn-light" data-toggle="modal"
                                        data-target="#modalReserva">Nueva Reserva
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <p><strong>Nombre:</strong> <?php echo $nombreHuesped; ?></p>
                                    <p><strong>Teléfono:</strong> <?php echo $telefonoHuesped; ?></p>
                                </div>
                                <div class="col-6">
                                    <p><strong>DNI:</strong> <?php echo $idHuesped; ?></p>
                                    <p><strong>Email:</strong> <?php echo $emailHuesped; ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Tipo de Habitación</th>
                                            <th>Habitación</th>
                                            <th>Titular</th>
                                            <th>Adultos</th>
                                            <th>Niños</th>
                                            <th>Check-In</th>
                                            <th>Check-Out</th>
                                            <th>Tarifa</th>
                                            <th>Impuestos</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <select class="form-control" name="tipoHabitacion" onchange="getHabitacion(this.value)">
                                                    <option selected disabled>Seleccionar</option>
													<?php
													$query = mysqli_query($link, "SELECT * FROM TipoHabitacion");
													while ($row = mysqli_fetch_array($query)) {
														echo "<option value='{$row['idTipoHabitacion']}'>{$row['descripcion']}</option>";
													}
													?>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" name="nroHabitacion" id="nroHabitacion">
                                                    <option selected disabled>Seleccionar</option>
                                                </select>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                            data-target="#modalHuesped">Añadir Huésped
                                    </button>
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
            </div>
        </section>

        <form method="post" action="#">
            <div class="modal fade" id="modalHuesped" tabindex="-1" role="dialog" aria-labelledby="modalReserva"
                 aria-hidden="true">
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
	}elseif($estadoReserva == '9'){
		?>
        <section class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-table"></i> Detalles de la Reserva
                            <div class="float-right">
                                <form method="get" action="agenda.php" id="formReservaPendiente">
                                    <button type="submit" class="btn btn-sm btn-light" form="formReservaPendiente" formaction="agenda.php?idReserva=<?php echo $_POST['idReserva'];?>">Guardar</button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <p><strong>Nombre:</strong> <?php echo $nombreHuesped; ?></p>
                                    <p><strong>Teléfono:</strong> <?php echo $telefonoHuesped; ?></p>
                                </div>
                                <div class="col-6">
                                    <p><strong>DNI:</strong> <?php echo $idHuesped; ?></p>
                                    <p><strong>Email:</strong> <?php echo $emailHuesped; ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12 text-center">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Tipo de Habitación</th>
                                                <th>Cant.</th>
                                                <th>Fecha In.</th>
                                                <th>Fecha Fin</th>
                                                <th>Preferencias</th>
                                                <th>Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <form method="post" action="#">
                                                <input type="hidden" value="<?php echo $_POST['idReserva'];?>" name="idReserva">
                                            <tr>
                                                <td style="width: 14%">
                                                    <select class="form-control" name="tipoHabitacion">
                                                        <option selected disabled>Seleccionar</option>
														<?php
														$query = mysqli_query($link, "SELECT * FROM TipoHabitacion");
														while ($row = mysqli_fetch_array($query)) {
															echo "<option value='{$row['idTipoHabitacion']}'>{$row['descripcion']}</option>";
														}
														?>
                                                    </select>
                                                </td>
                                                <td style="width: 10%">
                                                    <input type="number" class="form-control" name="numHabitaciones" id="numHabitaciones">
                                                </td>
                                                <td style="width: 10%;">
                                                    <input type="date" class="form-control" name="checkin" id="checkin">
                                                </td>
                                                <td style="width: 10%;">
                                                    <input type="date" class="form-control" name="checkout" id="checkout">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="preferencias">
                                                </td>
                                                <td>
                                                    <input type="submit" class="form-control" name="addReservaPendiente" value="Agregar">
                                                </td>
                                            </tr>
                                            </form>
                                            <?php
                                            $query = mysqli_query($link,"SELECT * FROM ReservaPendiente WHERE idReserva = '{$_POST['idReserva']}'");
                                            while($row = mysqli_fetch_array($query)){
                                                echo "<tr>";
                                                $query2 = mysqli_query($link,"SELECT * FROM TipoHabitacion WHERE idTipoHabitacion = '{$row['idTipoHabitacion']}'");
                                                while($row2 = mysqli_fetch_array($query2)){
                                                    $tipoHabitacion = $row2['descripcion'];
                                                }
                                                echo "<td>{$tipoHabitacion}</td>";
	                                            echo "<td>{$row['numeroHabitaciones']}</td>";
	                                            echo "<td>{$row['fechaInicio']}</td>";
	                                            echo "<td>{$row['fechaFin']}</td>";
	                                            echo "<td>{$row['preferencias']}</td>";
	                                            echo "<td>
                                                    <form method='post' action='#'>
                                                        <input type='hidden' name='idTipoHabitacion' value='{$row['idTipoHabitacion']}'>
                                                        <input type='hidden' name='idReserva' value='{$_POST['idReserva']}'>
                                                        <input type='submit' class='btn btn-sm btn-outline-danger' name='deleteTipoHabitacion' value='Eliminar'>
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
                </div>
            </div>
        </section>

		<?php
	}
	include('footer.php');
}
?>