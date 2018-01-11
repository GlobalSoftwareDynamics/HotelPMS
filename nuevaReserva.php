<?php
include('session.php');
if(isset($_SESSION['login'])){
	include('funciones.php');
	include('header.php');
	include('navbarRecepcion.php');
	include('declaracionFechas.php');

	if(isset($_POST['confirmaReserva'])){
	    $update = mysqli_query($link,"UPDATE Reserva SET idEstado = 3 WHERE idReserva = '{$_POST['idReserva']}'");
	    $queryPerformed = "UPDATE Reserva SET idEstado = 3 WHERE idReserva = {$_POST['idReserva']}";
		$databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','CONFIRMACION RESERVA ','{$queryPerformed}')");
    }

	if(isset($_POST['addRecojo'])){
	    $flag = false;
	    $query = mysqli_query($link,"SELECT * FROM Recojo WHERE idReserva = '{$_POST['idReserva']}'");
	    while($row = mysqli_fetch_array($query)){
	        $flag = true;
        }
        if(!$flag){
	        $insert = mysqli_query($link,"INSERT INTO Recojo (idReserva, nroTicket, fechaHora, lugarRecojo, numPersonas, personaPrincipal) 
                  VALUES ('{$_POST['idReserva']}','{$_POST['nroTicket']}','{$_POST['fechaRecojo']}','{$_POST['lugarRecojo']}','{$_POST['numPersonas']}','{$_POST['personaPrincipal']}')");
	        $queryPerformed = "INSERT INTO Recojo (idReserva, nroTicket, fechaHora, lugarRecojo, numPersonas, personaPrincipal) 
                  VALUES ({$_POST['idReserva']},{$_POST['nroTicket']},{$_POST['fechaRecojo']},{$_POST['lugarRecojo']},{$_POST['numPersonas']},{$_POST['personaPrincipal']})";
	        $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','RECOJO RESERVA ','{$queryPerformed}')");
        }else{
            $update = mysqli_query($link,"UPDATE Recojo SET nroTicket = '{$_POST['nroTicket']}', fechaHora = '{$_POST['fechaRecojo']}', lugarRecojo = '{$_POST['lugarRecojo']}', 
            numPersonas = '{$_POST['numPersonas']}', personaPrincipal = '{$_POST['personaPrincipal']}' WHERE idReserva = '{$_POST['idReserva']}'");
            $queryPerformed = "UPDATE Recojo SET nroTicket = {$_POST['nroTicket']}, fechaHora = {$_POST['fechaRecojo']}, lugarRecojo = {$_POST['lugarRecojo']}, 
            numPersonas = {$_POST['numPersonas']}, personaPrincipal = {$_POST['personaPrincipal']} WHERE idReserva = {$_POST['idReserva']}";
	        $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','RECOJO RESERVA ','{$queryPerformed}')");
        }
	}

	if(isset($_POST['addReserva'])){
		$insert = mysqli_query($link,"INSERT INTO Huesped VALUES ('{$_POST['dni']}',null,null,null,null,'{$_POST['nombres']}',null,'{$_POST['email']}',null,null,'{$_POST['telefono']}',null,null)");
		$queryPerformed = "INSERT INTO Huesped VALUES ({$_POST['dni']},null,null,null,null,{$_POST['nombres']},null,{$_POST['email']},null,null,{$_POST['telefono']},null,null)";
		$databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','CREAR HUESPED','{$queryPerformed}')");

		if(!$insert){
		    $update = mysqli_query($link,"UPDATE Huesped SET nombreCompleto = '{$_POST['nombres']}', correoElectronico = '{$_POST['email']}', telefonoCelular = '{$_POST['telefono']}' WHERE idHuesped = '{$_POST['dni']}'");
		    $queryPerformed = "UPDATE Huesped SET nombreCompleto = {$_POST['nombres']}, correoElectronico = {$_POST['email']}, telefonoCelular = {$_POST['telefono']} WHERE idHuesped = {$_POST['dni']}";
			$databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','HUESPED','{$queryPerformed}')");
        }

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
		$insert = mysqli_query($link,"INSERT INTO Huesped VALUES ('{$_POST['dni']}',null,null,null,null,'{$_POST['nombres']}',null,null,null,null,null,null,null)");
		$queryPerformed = "INSERT INTO Huesped VALUES ({$_POST['dni']},null,null,null,null,{$_POST['nombres']},null,null,null,null,null,null,null)";
		$databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','CREAR HUESPED','{$queryPerformed}')");

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

    if(isset($_POST['deleteOcupante'])){
	    $delete = mysqli_query($link,"DELETE FROM Ocupantes WHERE idReserva = '{$_POST['idReserva']}' AND idHuesped = '{$_POST['idHuesped']}'");
	    $queryPerformed = "DELETE FROM Ocupantes WHERE idReserva = {$_POST['idReserva']} AND idHuesped = {$_POST['idHuesped']}";
	    $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','DELETE','OCUPANTE ','{$queryPerformed}')");
    }

    if(isset($_POST['deleteHabitacion'])){
        $delete = mysqli_query($link,"DELETE FROM HabitacionReservada WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");
        $queryPerformed = "DELETE FROM HabitacionReservada WHERE idReserva = {$_POST['idReserva']} AND idHabitacion = {$_POST['idHabitacion']}";
	    $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','DELETE','HABITACION RESERVADA ','{$queryPerformed}')");
    }

    if(isset($_POST['checkinHabitacion'])){
        $update = mysqli_query($link,"UPDATE HabitacionReservada SET idEstado = 4, fechaInicio = '{$dateTime}' WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");
        $queryPerformed = "UPDATE HabitacionReservada SET idEstado = 4 WHERE idReserva = {$_POST['idReserva']} AND idHabitacion = {$_POST['idHabitacion']}";
	    $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','CHECKIN HABITACION','{$queryPerformed}')");

        $query = mysqli_query($link,"INSERT INTO HistorialReserva(idHabitacion,idReserva,idColaborador,idEstado,fechaHora,descripcion,tipo) VALUES ('{$_POST['idHabitacion']}','{$_POST['idReserva']}','{$_SESSION['user']}',5,'{$dateTime}','Check In de habitación {$_POST['idHabitacion']} para reserva {$_POST['idReserva']}','Check In')");

        $queryPerformed = "INSERT INTO HistorialReserva(idHabitacion,idReserva,idColaborador,idEstado,fechaHora,descripcion,tipo) VALUES ({$_POST['idHabitacion']},{$_POST['idReserva']},{$_SESSION['user']},5,{$dateTime},CheckIn de habitación {$_POST['idHabitacion']} para reserva {$_POST['idReserva']},CheckIn)";

        $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','HistorialReserva','{$queryPerformed}')");

    }

	if($estadoReserva == '3') {

        $pendiente = mysqli_query($link,"SELECT * FROM ReservaPendiente WHERE idReserva = '{$_POST['idReserva']}'");
        while($rowPendiente = mysqli_fetch_array($pendiente)){
            ?>
            <section class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table"></i> Detalles de la Reserva Preliminar
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table text-center">
                                            <thead>
                                            <tr>
                                                <th>Tipo de Habitación</th>
                                                <th>Cantidad</th>
                                                <th>Fecha Inicio</th>
                                                <th>Fecha Fin</th>
                                                <th>Prefencias</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $query = mysqli_query($link,"SELECT * FROM ReservaPendiente WHERE idReserva = '{$_POST['idReserva']}'");
                                            while($row = mysqli_fetch_array($query)){
                                                echo "<tr>";
                                                    $query2 = mysqli_query($link,"SELECT * FROM tipohabitacion WHERE idTipoHabitacion = '{$row['idTipoHabitacion']}'");
                                                    while($row2 = mysqli_fetch_array($query2)){
                                                        echo "<td>{$row2['descripcion']}</td>";
                                                    }
                                                    echo "<td>{$row['numeroHabitaciones']}</td>";
	                                                echo "<td>{$row['fechaInicio']}</td>";
	                                                echo "<td>{$row['fechaFin']}</td>";
	                                                echo "<td>{$row['preferencias']}</td>";
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
		?>

        <section class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-table"></i> Detalles de la Reserva
                            <div class="float-right">
                                <button name="addRecojo" type="submit" form="formRecojo" class="btn btn-light btn-sm" formaction="agenda.php">Guardar Reserva</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <p><strong>Nombre:</strong> <?php echo $nombreHuesped; ?></p>
                                    <p><strong>Teléfono:</strong> <?php echo $telefonoHuesped; ?></p>
                                    <p><strong>DNI:</strong> <?php echo $idHuesped; ?></p>
                                    <p><strong>Email:</strong> <?php echo $emailHuesped; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-table"></i> Detalles del Recojo
                        </div>
                        <div class="card-body">
                            <form method="post" action="#" id="formRecojo">
                                <input type="hidden" name="idReserva" value="<?php echo $_POST['idReserva'];?>">
                                <div class="row">
                                    <?php
                                    $flagRecojo = false;
                                    $search = mysqli_query($link, "SELECT * FROM Recojo WHERE idReserva = '{$_POST['idReserva']}'");
                                    while($searchRow = mysqli_fetch_array($search)) {
                                        $flagRecojo = true;
                                        ?>
                                        <div class="col-6 text-center">
                                            <select class="form-control" name="lugarRecojo">
                                                <?php
                                                if($searchRow['lugarRecojo'] == 'Aeropuerto'){
                                                    echo "<option selected value='Aeropuerto'>Aeropuerto</option>";
                                                    echo "<option value='Terminal Terrestre'>Terminal Terrestre</option>";
                                                }else{
                                                    echo "<option value='Aeropuerto'>Aeropuerto</option>";
                                                    echo "<option selected value='Terminal Terrestre'>Terminal Terrestre</option>";
                                                }
                                                ?>
                                            </select><br>
                                            <input type="text" class="form-control" name="personaPrincipal" placeholder="Persona Principal" value="<?php echo $searchRow['personaPrincipal'];?>">
                                            <br>
                                            <input type="text" class="form-control" name="nroTicket" placeholder="Número de Vuelo/Bus" value="<?php echo $searchRow['nroTicket'];?>">
                                        </div>
                                        <div class="col-6 text-center">
                                            <?php
                                            $fechaRecojo = $searchRow['fechaHora'];
                                            $arrayFecha = explode(" ",$fechaRecojo);
                                            $hora = explode(":",$arrayFecha[1]);
                                            $fechaRecojo = $arrayFecha[0]."T".$hora[0].":".$hora[1];
                                            ?>
                                            <input type="datetime-local" class="form-control" name="fechaRecojo" placeholder="Fecha y Hora de Recojo" value="<?php echo $fechaRecojo;?>">
                                            <br>
                                            <input type="number" class="form-control" name="numPersonas" placeholder="Número de Personas" value="<?php echo $searchRow['numPersonas'];?>">
                                            <br>
                                            <input type="submit" value="Guardar Recojo" class="btn btn-primary" name="addRecojo">
                                        </div>
                                        <?php
                                    }
                                    if(!$flagRecojo){
                                        ?>
                                        <div class="col-12 text-center">
                                            <table>
                                                <thead>
                                                <tr>
                                                    <th>Lugar de Recojo</th>
                                                    <th>Persona Principal</th>
                                                    <th>Fecha y Hora</th>
                                                    <th>Cantidad de personas</th>
                                                    <th>Número de ticket</th>
                                                    <th>Acciones</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td><select class="form-control" name="lugarRecojo">
                                                            <option selected disabled>Seleccionar lugar de recojo</option>
                                                            <option value="Aeropuerto">Aeropuerto</option>
                                                            <option value="Terminal Terrestre">Terminal Terrestre</option>
                                                        </select></td>
                                                    <td><input type="text" class="form-control" name="personaPrincipal" placeholder="Persona Principal"></td>
                                                    <td><input type="datetime-local" class="form-control" name="fechaRecojo" placeholder="Fecha y Hora de Recojo"></td>
                                                    <td><input type="number" class="form-control" name="numPersonas" placeholder="Número de Personas"></td>
                                                    <td><input type="text" class="form-control" name="nroTicket" placeholder="Número de Vuelo/Bus"></td>
                                                    <td><input type="submit" value="Guardar Recojo" class="btn btn-primary" name="addRecojo"></td>
                                                </tr>
                                                <?php
                                                $recojos = mysqli_query($link,"SELECT * FROM Recojo WHERE idReserva = '{$_POST['idReserva']}'");
                                                while($rowRecojos = mysqli_fetch_array($recojos)){
                                                    echo "<tr>";
                                                        echo "<td>{$rowRecojos['lugarRecojo']}</td>";
                                                        echo "<td>{$rowRecojos['personaPrincipal']}</td>";
                                                        echo "<td>{$rowRecojos['fechaHora']}</td>";
                                                        echo "<td>{$rowRecojos['numPersonas']}</td>";
                                                        echo "<td>{$rowRecojos['nroTicket']}</td>";
                                                    echo "</tr>";
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-table"></i> Habitaciones
                        </div>
                        <div class="card-body">
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
                                            <th>Estado</th>
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
                                                    <input disabled readonly class="form-control">
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
											$query2 = mysqli_query($link,"SELECT * FROM Estado WHERE idEstado = {$row['idEstado']}");
											while($row2 = mysqli_fetch_array($query2)){
											    echo "<td>{$row2['descripcion']}</td>";
                                            }
											echo "<td>
                                                        <form method='post'>
                                                            <div class=\"dropdown\">
                                                                <button class=\"btn btn-outline btn-sm dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                                                Acciones
                                                                </button>
                                                                <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                                                                    <input type='hidden' name='idHabitacion' value='{$row['idHabitacion']}'>
                                                                    <input type='hidden' name='idReserva' value='{$_POST['idReserva']}'>
                                                                    <input type=\"submit\" value=\"Registrar Check-In\" class=\"dropdown-item\" formaction=\"#\" name='checkinHabitacion'>
                                                                    <input type=\"submit\" value=\"Eliminar\" class=\"dropdown-item\" formaction=\"#\" name='deleteHabitacion'>
                                                                </div>
                                                            </div>
                                                        </form>
                                                      </td>
                                                ";
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

        <section class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-table"></i> Ocupantes
                        </div>
                        <div class="card-body">
                            <hr>
                            <div class="row">
                                <div class="col-10 offset-1 text-center">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th colspan="2">Huésped</th>
                                            <th>Habitación</th>
                                            <th>Cargos</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <form method="post" action="#" id="formOcupante">
                                            <input type="hidden" value="<?php echo $_POST['idReserva'];?>" name="idReserva">
                                            <tr>
                                                <td id="divDni">
                                                    <input type="text" name="dni" id="dni" class="form-control" placeholder="DNI" onchange="getNombre2(this.value)">
                                                </td>
                                                <td id="divNombre">
                                                    <div class="input-group">
                                                        <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Nombre Completo" onchange="getID2(this.value)">&nbsp;&nbsp;&nbsp;&nbsp;
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
                                <input type="hidden" value="<?php echo $_POST['idReserva'];?>" name="idReserva">
                                <div class="row">
                                    <div class="form-group col-6" id="divDni">
                                        <label class="col-form-label" for="dni">DNI Titular:</label>
                                        <input type="number" name="dni" id="dni" class="form-control" min="0" value="<?php $dni = idgenNum(); echo $dni;?>">
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
                                <form method="post" action="agenda.php" id="formReservaPendiente">
                                    <input type="hidden" value="<?php echo $_POST['idReserva'];?>" name="idReserva">
                                    <button type="submit" class="btn btn-sm btn-light" form="formReservaPendiente" formaction="agenda.php">Guardar</button>
                                    <button type="submit" class="btn btn-sm btn-light" form="formReservaPendiente" formaction="#" name="confirmaReserva">Confirmar Reserva</button>
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
                                                    <input type="number" min='0' class="form-control" name="numHabitaciones" id="numHabitaciones">
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