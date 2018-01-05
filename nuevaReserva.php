<?php
include('session.php');
if(isset($_SESSION['login'])){
	include('funciones.php');
	include('header.php');
	include('navbarRecepcion.php');
	include('declaracionFechas.php');
	if(isset($_POST['addReserva'])){
		$insert = mysqli_query($link,"INSERT INTO Reserva VALUES ('{$_POST['idReserva']}','{$_SESSION['user']}',{$_POST['dni']},{$_POST['tipoReserva']},'{$dateTime}',0,0,null)");
		$queryPerformed = "INSERT INTO Reserva VALUES ({$_POST['idReserva']},{$_SESSION['user']},{$_POST['dni']},1,{$dateTime},0,0,null)";
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

	if(isset($_POST['addReservaConfirmada'])){
		if(!isset($_POST['camaAdicional'])){$camaAdicional = false;}else{$camaAdicional = true;}
		$insert = mysqli_query($link, "INSERT INTO HabitacionReservada VALUES ('{$_POST['nroHabitacion']}','{$_POST['idReserva']}',3,'{$_POST['fechaInicio']}','{$_POST['fechaFin']}'
                  ,'{$_POST['preferencias']}','{$camaAdicional}','{$_POST['tarifa']}')");
	}

	if(isset($_POST['addReservaPendiente'])){
		$insert = mysqli_query($link,"INSERT INTO ReservaPendiente VALUES 
        ('{$_POST['tipoHabitacion']}','{$_POST['idReserva']}','{$_POST['numHabitaciones']}','{$_POST['checkin']}','{$_POST['checkout']}','{$_POST['preferencias']}','{$_POST['tarifa']}')");
		$queryPerformed = "INSERT INTO ReservaPendiente VALUES 
        ({$_POST['tipoHabitacion']},{$_POST['idReserva']},{$_POST['numHabitaciones']},{$_POST['checkin']},{$_POST['checkout']},{$_POST['preferencias']},{$_POST['tarifa']})";
		$databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','DATOS RESERVA PENDIENTE','{$queryPerformed}')");
	}

	if(isset($_POST['addOcupante'])){
	    $idHuesped = null;
	    $query = mysqli_query($link,"SELECT * FROM Huesped WHERE nombreCompleto = '{$_POST['nombres']}'");
	    while($row = mysqli_fetch_array($query)){
	        $idHuesped = $row['idHuesped'];
	        break;
        }
		if(!isset($_POST['cargos'])){$cargos = false;}else{$cargos = true;}
	    $insert = mysqli_query($link,"INSERT INTO Ocupantes VALUES ('{$_POST['idReserva']}','{$idHuesped}','{$_POST['idHabitacion']}','{$cargos}')");
		$queryPerformed = "INSERT INTO Ocupantes VALUES ({$_POST['idReserva']},{$idHuesped},{$_POST['idHabitacion']},{$cargos})";
		$databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','OCUPANTE','{$queryPerformed}')");
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
                                <div class="col-3 offset-3">
                                    <p><strong>Nombre:</strong> <?php echo $nombreHuesped; ?></p>
                                    <p><strong>Teléfono:</strong> <?php echo $telefonoHuesped; ?></p>
                                </div>
                                <div class="col-5">
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
                                            <th>Cama Adicional</th>
                                            <th>Check-In</th>
                                            <th>Check-Out</th>
                                            <th>Tarifa</th>
                                            <th>Preferencias</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <form method="post" action="#">
                                            <input type="hidden" name="idReserva" value="<?php echo $_POST['idReserva'];?>">
                                            <tr>
                                                <td>
                                                    <select class="form-control" name="tipoHabitacion" onchange="getHabitacion(this.value);getTarifa(this.value)">
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
                                                <td>
                                                    <input class="form-control" type="checkbox" name="camaAdicional" value="true">
                                                </td>
                                                <td>
                                                    <input type="date" name="fechaInicio" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="date" name="fechaFin" class="form-control">
                                                </td>
                                                <td>
                                                    <select class="form-control" name="tarifa" id="tarifa">
                                                        <option selected disabled>Seleccionar</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="preferencias" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="submit" name="addReservaConfirmada" class="btn btn-primary btn" value="Agregar">
                                                </td>
                                            </tr>
                                        </form>
										<?php
										$query = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE idReserva = '{$_POST['idReserva']}'");
										while($row = mysqli_fetch_array($query)){
											echo "<tr>";
											$query2 = mysqli_query($link,"SELECT * FROM Habitacion WHERE idHabitacion = '{$row['idHabitacion']}'");
											while($row2 = mysqli_fetch_array($query2)){
												$query3 = mysqli_query($link,"SELECT * FROM TipoHabitacion WHERE idTipoHabitacion = '{$row2['idTipoHabitacion']}'");
												while($row3 = mysqli_fetch_array($query3)){
													echo "<td>{$row3['descripcion']}</td>";
												}
											}
											echo "<td>{$row['idHabitacion']}</td>";
											if($row['camaAdicional'] == 1){
												echo "<td>Sí</td>";
											}else{
												echo "<td>No</td>";
											}
											$fechaInicial = substr($row['fechaInicio'],0,10);
											echo "<td>{$fechaInicial}</td>";
											$fechaFinal = substr($row['fechaFin'],0,10);
											echo "<td>{$fechaFinal}</td>";
											$query2 = mysqli_query($link,"SELECT * FROM Tarifa WHERE idTarifa = '{$row['idTarifa']}'");
											while($row2 = mysqli_fetch_array($query2)){
												echo "<td>{$row2['descripcion']}</td>";
											}
											echo "<td>{$row['preferencias']}</td>";
											echo "<td>
                                                    <form method='post' action='#'>
                                                        <input type='hidden' name='idHabitacion' value='{$row['idHabitacion']}'>
                                                        <input type='hidden' name='idReserva' value='{$_POST['idReserva']}'>
                                                        <input type='submit' class='btn btn-sm btn-outline-danger' name='deleteHabitacion' value='Eliminar'>
                                                    </form>
	                                            </td>";
											echo "</tr>";
										}
										?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-8 offset-2 text-center">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Huésped</th>
                                            <th>Habitación</th>
                                            <th>Cargos</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <form method="post" action="#">
                                            <input type="hidden" value="<?php echo $_POST['idReserva'];?>" name="idReserva">
                                            <tr>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="text" name="nombres" id="nombres" class="form-control">&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalHuesped">Nuevo Huésped</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <select class="form-control" name="idHabitacion">
                                                        <option selected disabled>Seleccionar</option>
                                                        <?php
                                                        $query = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE idReserva = '{$_POST['idReserva']}'");
                                                        while($row = mysqli_fetch_array($query)){
                                                            echo "<option value='{$row['idHabitacion']}'>{$row['idHabitacion']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="checkbox" class="form-control" name="cargos" value="true">
                                                </td>
                                                <td>
                                                    <input type="submit" name="addOcupante" class="btn btn-primary btn" value="Agregar">
                                                </td>
                                            </tr>
                                        </form>
                                        <?php
                                        $query = mysqli_query($link,"SELECT * FROM Ocupantes WHERE idReserva = '{$_POST['idReserva']}'");
                                        while($row = mysqli_fetch_array($query)){
                                            echo "<tr>";
                                                $query2 = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped = '{$row['idHuesped']}'");
                                                while($row2 = mysqli_fetch_array($query2)){
                                                    echo "<td>{$row2['nombreCompleto']}</td>";
                                                }
                                                echo "<td>{$row['idHabitacion']}</td>";
                                                if($row['cargos'] == 1){
                                                    echo "<td>Sí</td>";
                                                }else{
	                                                echo "<td>No</td>";
                                                }
	                                            echo "<td>
                                                    <form method='post' action='#'>
                                                        <input type='hidden' name='idHuesped' value='{$row['idHuesped']}'>
                                                        <input type='hidden' name='idReserva' value='{$_POST['idReserva']}'>
                                                        <input type='submit' class='btn btn-sm btn-outline-danger' name='deleteOcupante' value='Eliminar'>
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
                                <input type="hidden" value="<?php echo $_POST['idReserva'];?>" name="idReserva">
                                <div class="row">
                                    <div class="form-group col-6" id="divDni">
                                        <label class="col-form-label" for="dni">DNI Titular:</label>
                                        <input type="number" name="dni" id="dni" class="form-control">
                                    </div>
                                    <div class="form-group col-6" id="divNombre">
                                        <label class="col-form-label" for="nombres">Nombre Completo:</label>
                                        <input type="text" name="nombres" id="nombres" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6" id="divTelf">
                                        <label class="col-form-label" for="telefono">Teléfono Celular:</label>
                                        <input type="text" name="telefono" id="telefono" class="form-control">
                                    </div>
                                    <div class="form-group col-6" id="divEmail">
                                        <label class="col-form-label" for="email">Correo Electrónico:</label>
                                        <input type="email" name="email" id="email" class="form-control">
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
                                            <th>Tarifa</th>
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
                                                    <select class="form-control" name="tipoHabitacion" onchange="getTarifa(this.value)">
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
                                                <td>
                                                    <select class="form-control" name="tarifa" id="tarifa">
                                                        <option selected disabled>Seleccionar</option>
                                                    </select>
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
											$query2 = mysqli_query($link,"SELECT * FROM Tarifa WHERE idTarifa = '{$row['idTarifa']}'");
											while($row2 = mysqli_fetch_array($query2)){
												echo "<td>{$row2['descripcion']}</td>";
											}
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