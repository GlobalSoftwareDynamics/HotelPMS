<?php
include('session.php');
if(isset($_SESSION['login'])){
	include('funciones.php');
	include('header.php');
    if($_SESSION['userType'] == 1){
        include('navbarRecepcion.php');
    }else{
        include('navbarAdmin.php');
    }
	include('declaracionFechas.php');

    ?>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    <?php

    if(isset($_GET['idReserva'])) {
        $_POST['idReserva'] = $_GET['idReserva'];
    }

    if(isset($_POST['modificarPreferencias'])){
        $update = mysqli_query($link,"UPDATE HabitacionReservada SET preferencias = '{$_POST['preferenciasEditar']}', fechaInicio = '{$_POST['checkInEditar']}', fechaFin = '{$_POST['checkOutEditar']}'
          WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}' AND idHabitacionReservada = '{$_POST['idHabitacionReservada']}'");
        $queryPerformed = "UPDATE HabitacionReservada SET preferencias = {$_POST['preferenciasEditar']}, fechaInicio = {$_POST['checkInEditar']}, fechaFin = {$_POST['checkOutEditar']}
          WHERE idReserva = {$_POST['idReserva']} AND idHabitacion = {$_POST['idHabitacion']} AND idHabitacionReservada = {$_POST['idHabitacionReservada']}";
        $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','PREFERENCIAS DE RESERVA','{$queryPerformed}')");
    }

	if(isset($_POST['confirmaReserva'])){
		$update = mysqli_query($link,"UPDATE Reserva SET idEstado = 3 WHERE idReserva = '{$_POST['idReserva']}'");
		$queryPerformed = "UPDATE Reserva SET idEstado = 3 WHERE idReserva = {$_POST['idReserva']}";
		$databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','CONFIRMACION RESERVA ','{$queryPerformed}')");
	}

	if(isset($_POST['addRecojo'])){
		$insert = mysqli_query($link,"INSERT INTO Recojo (idReserva, nroTicket, fechaHora, lugarRecojo, numPersonas, personaPrincipal) 
                  VALUES ('{$_POST['idReserva']}','{$_POST['nroTicket']}','{$_POST['fechaRecojo']}','{$_POST['lugarRecojo']}','{$_POST['numPersonas']}','{$_POST['personaPrincipal']}')");
		$queryPerformed = "INSERT INTO Recojo (idReserva, nroTicket, fechaHora, lugarRecojo, numPersonas, personaPrincipal) 
                  VALUES ({$_POST['idReserva']},{$_POST['nroTicket']},{$_POST['fechaRecojo']},{$_POST['lugarRecojo']},{$_POST['numPersonas']},{$_POST['personaPrincipal']})";
		$databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','RECOJO RESERVA ','{$queryPerformed}')");
	}

	if(isset($_POST['updateTipoPago'])){
		$update = mysqli_query($link,"UPDATE Reserva SET tipoPago = '{$_POST['tipoPago']}' WHERE idReserva = '{$_POST['idReserva']}'");
		$queryPerformed = "UPDATE Reserva SET tipoPago = {$_POST['tipoPago']} WHERE idReserva = {$_POST['idReserva']}";
		$databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','RECOJO RESERVA ','{$queryPerformed}')");
	}

    if(isset($_POST['earlyCheckIn'])){

	    $result = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");
	    while ($fila = mysqli_fetch_array($result)){
	        switch ($fila['modificadorCheckIO']){
                case 0:

                    $update = mysqli_query($link,"UPDATE HabitacionReservada SET modificadorCheckIO = '1' WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");

                    $queryPerformed = "UPDATE HabitacionReservada SET modificadorCheckIO = 1 WHERE idReserva = {$_POST['idReserva']} AND idHabitacion = {$_POST['idHabitacion']}";

                    $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','Early CheckIn','{$queryPerformed}')");

                    break;
                case 1:
                    break;
                case 2:

                    $update = mysqli_query($link,"UPDATE HabitacionReservada SET modificadorCheckIO = '3' WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");

                    $queryPerformed = "UPDATE HabitacionReservada SET modificadorCheckIO = 3 WHERE idReserva = {$_POST['idReserva']} AND idHabitacion = {$_POST['idHabitacion']}";

                    $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','Early CheckIn','{$queryPerformed}')");

                    break;
                case 3:
                    break;
                case 4:
                    break;
            }
        }
	}

    if(isset($_POST['lateCheckOut'])){

        $result = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");
        while ($fila = mysqli_fetch_array($result)){
            switch ($fila['modificadorCheckIO']){
                case 0:

                    $update = mysqli_query($link,"UPDATE HabitacionReservada SET modificadorCheckIO = '2' WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");

                    $queryPerformed = "UPDATE HabitacionReservada SET modificadorCheckIO = 2 WHERE idReserva = {$_POST['idReserva']} AND idHabitacion = {$_POST['idHabitacion']}";

                    $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','Late CheckOut','{$queryPerformed}')");

                    break;
                case 1:

                    $update = mysqli_query($link,"UPDATE HabitacionReservada SET modificadorCheckIO = '3' WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");

                    $queryPerformed = "UPDATE HabitacionReservada SET modificadorCheckIO = 3 WHERE idReserva = {$_POST['idReserva']} AND idHabitacion = {$_POST['idHabitacion']}";

                    $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','Late CheckOut','{$queryPerformed}')");

                    break;
                case 2:
                    break;
                case 3:
                    break;
                case 4:
                    break;
            }
        }
    }

	if(isset($_POST['addReserva'])){
		$dni = 1;
		$flagPaquete = false;

		if($_POST['dni'] != ''){
			$dni = $_POST['dni'];
		}else{
			$id = mysqli_query($link, "SELECT * FROM Huesped");
			$dni += mysqli_num_rows($id);
		}

		if($_POST['tipoReserva'] == 10){
			$_POST['tipoReserva'] = 3;
			$flagPaquete = true;
		}

        if($_POST['empresa'] == 'Seleccionar'){
            $_POST['empresa'] = "null";
        }else{
            $_POST['empresa'] = "'{$_POST['empresa']}'";
        }

        $idHuespedUsado = null;
        $searchDNI = mysqli_query($link,"SELECT * FROM Huesped WHERE dni = '{$_POST['dni']}'");
        while($rowSearch = mysqli_fetch_array($searchDNI)){
            $idHuespedUsado = $rowSearch['idHuesped'];
        }
		if(mysqli_num_rows($searchDNI) > 0){
            $update = mysqli_query($link,"UPDATE Huesped SET nombreCompleto = '{$_POST['nombres']}', correoElectronico = '{$_POST['email']}', telefonoCelular = '{$_POST['telefono']}', idEmpresa = {$_POST['empresa']} WHERE dni = '{$dni}'");
            $queryPerformed = "UPDATE Huesped SET nombreCompleto = {$_POST['nombres']}, correoElectronico = {$_POST['email']}, telefonoCelular = {$_POST['telefono']}, idEmpresa = {$_POST['empresa']} WHERE dni = {$dni}";
            $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','HUESPED','{$queryPerformed}')");
        }else{
            $insert = mysqli_query($link,"INSERT INTO Huesped (idEmpresa, idCiudad, idGenero, nacionalidad_idPais, nombreCompleto, direccion, correoElectronico, codigoPostal, telefonoFijo, telefonoCelular, fechaNacimiento, preferencias, vip, contacto, dni) VALUES ({$_POST['empresa']},null,null,null,'{$_POST['nombres']}',null,'{$_POST['email']}',null,null,'{$_POST['telefono']}',null,null,0,0,{$dni})");
            $queryPerformed = "INSERT INTO Huesped VALUES ({$_POST['empresa']},null,null,null,{$_POST['nombres']},null,{$_POST['email']},null,null,{$_POST['telefono']},null,null,0,0,{$dni})";
            $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','CREAR HUESPED','{$queryPerformed}')");
        }

        if($idHuespedUsado != null){
            $insert = mysqli_query($link,"INSERT INTO Reserva VALUES ('{$_POST['idReserva']}','{$_SESSION['user']}',{$idHuespedUsado},{$_POST['tipoReserva']},'{$dateTime}',0,0,null)");
            $queryPerformed = "INSERT INTO Reserva VALUES ({$dni},{$_SESSION['user']},{$dni},1,{$dateTime},0,0,null)";
            $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','CREAR RESERVA','{$queryPerformed}')");
        }else{
            $getHuesped = mysqli_query($link,"SELECT * FROM Huesped ORDER BY idHuesped DESC");
            while($rowHuesped = mysqli_fetch_array($getHuesped)){
                $idHuespedUsado = $rowHuesped['idHuesped'];
                break;
            }
            $insert = mysqli_query($link,"INSERT INTO Reserva VALUES ('{$_POST['idReserva']}','{$_SESSION['user']}',{$idHuespedUsado},{$_POST['tipoReserva']},'{$dateTime}',0,0,null)");
            $queryPerformed = "INSERT INTO Reserva VALUES ({$dni},{$_SESSION['user']},{$dni},1,{$dateTime},0,0,null)";
            $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','CREAR RESERVA','{$queryPerformed}')");
        }

		if($flagPaquete){
			$insert = mysqli_query($link,"INSERT INTO ReservaPaquete VALUES ('{$_POST['paqueteSeleccionado']}','{$_POST['idReserva']}')");
			$queryPerformed = "INSERT INTO ReservaPaquete VALUES ({$_POST['paqueteSeleccionado']},{$_POST['idReserva']})";
			$databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','CREAR RESERVA','{$queryPerformed}')");

			$query = mysqli_query($link,"SELECT * FROM TipoHabitacionPaquete WHERE idPaquete = '{$_POST['paqueteSeleccionado']}'");
			while($row = mysqli_fetch_array($query)){
				$query2 = mysqli_query($link,"SELECT * FROM Paquete WHERE idPaquete = '{$_POST['paqueteSeleccionado']}'");
				while($row2 = mysqli_fetch_array($query2)){
					$preferencias = $row2['descripcion'];
				}
				$insert = mysqli_query($link,"INSERT INTO ReservaPendiente VALUES ('{$row['idTipoHabitacion']}','{$_POST['idReserva']}',
                          '{$row['nroHabitaciones']}',null,null,'{$preferencias}','{$row['idTarifa']}')");
				$queryPerformed = "INSERT INTO ReservaPendiente VALUES ({$row['idTipoHabitacion']},{$_POST['idReserva']},
                          {$row['nroHabitaciones']},null,null,$preferencias,{$row['idTarifa']})";
				$databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','CREAR RESERVA','{$queryPerformed}')");
			}
		}
	}

	if(isset($_POST['idReserva'])){
		$queryReserva = mysqli_query($link,"SELECT * FROM Reserva WHERE idReserva = '{$_POST['idReserva']}'");
		while($rowReserva = mysqli_fetch_array($queryReserva)) {
			$estadoReserva = $rowReserva['idEstado'];
			$tipoPago = $rowReserva['tipoPago'];
			$queryHuesped = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped = {$rowReserva['idHuesped']}");
			while($rowHuesped = mysqli_fetch_array($queryHuesped)){
				$idHuesped = $rowHuesped['idHuesped'];
				$nombreHuesped = $rowHuesped['nombreCompleto'];
				$telefonoHuesped = $rowHuesped['telefonoCelular'];
				$emailHuesped = $rowHuesped['correoElectronico'];
				$dniHuesped = $rowHuesped['dni'];
			}
		}
	}


	if(isset($_POST['addReservaConfirmada'])){
		if(!isset($_POST['camaAdicional'])){$camaAdicional = false;}else{$camaAdicional = true;}
		$insert = mysqli_query($link, "INSERT INTO HabitacionReservada(idHabitacion,idReserva,idEstado,fechaInicio,fechaFin,preferencias,camaAdicional,idTarifa,modificadorCheckIO,idHabitacionReservadaPrevia) VALUES ('{$_POST['nroHabitacion']}','{$_POST['idReserva']}',3,'{$_POST['fechaInicio']}','{$_POST['fechaFin']} 00:00:01','{$_POST['preferencias']}','{$camaAdicional}','{$_POST['tarifa']}',0,null)");
		$queryPerformed = "INSERT INTO HabitacionReservada(idHabitacion,idReserva,idEstado,fechaInicio,fechaFin,preferencias,camaAdicional,idTarifa,modificadorCheckIO,idHabitacionReservadaPrevia) VALUES ({$_POST['nroHabitacion']},{$_POST['idReserva']},3,{$_POST['fechaInicio']},{$_POST['fechaFin']} 00:00:01,{$_POST['preferencias']},{$camaAdicional},{$_POST['tarifa']},0,null)";
        $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','HabitacionReservada','{$queryPerformed}')");
	}

    if(isset($_POST['cambioHabitacion'])){
        if(!isset($_POST['camaAdicional'])){$camaAdicional = false;}else{$camaAdicional = true;}

        $update = mysqli_query($link, "UPDATE HabitacionReservada SET fechaFin = '{$_POST['fechaInicio']}', idEstado = 5 WHERE idHabitacionReservada = '{$_POST['idHabitacionReservadaAnterior']}'");
        $queryPerformed = "UPDATE HabitacionReservada SET fechaFin = {$_POST['fechaInicio']} WHERE idHabitacionReservada = {$_POST['idHabitacionReservadaAnterior']}";
        $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','HabitacionReservada','{$queryPerformed}')");

        $insert = mysqli_query($link, "INSERT INTO HabitacionReservada(idHabitacion,idReserva,idEstado,fechaInicio,fechaFin,preferencias,camaAdicional,idTarifa,modificadorCheckIO,idHabitacionReservadaPrevia) VALUES ('{$_POST['nroHabitacion']}','{$_POST['idReserva']}',4,'{$_POST['fechaInicio']}','{$_POST['fechaFin']} 00:00:01','{$_POST['preferencias']}','{$camaAdicional}','{$_POST['tarifa']}',0,'{$_POST['idHabitacionReservadaAnterior']}')");
        $queryPerformed = "INSERT INTO HabitacionReservada(idHabitacion,idReserva,idEstado,fechaInicio,fechaFin,preferencias,camaAdicional,idTarifa,modificadorCheckIO,idHabitacionReservadaPrevia) VALUES ({$_POST['nroHabitacion']},{$_POST['idReserva']},4,{$_POST['fechaInicio']},{$_POST['fechaFin']} 00:00:01,{$_POST['preferencias']},{$camaAdicional},{$_POST['tarifa']},0,null)";
        $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','HabitacionReservada','{$queryPerformed}')");

        $query = mysqli_query($link,"SELECT * FROM Ocupantes WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacionAnterior']}'");
        while($row = mysqli_fetch_array($query)){
            $insert = mysqli_query($link, "INSERT INTO Ocupantes(idReserva,idHuesped,idHabitacion,cargos) VALUES ('{$row['idReserva']}','{$row['idHuesped']}','{$_POST['nroHabitacion']}','{$row['cargos']}')");
            $queryPerformed = "INSERT INTO Ocupantes(idReserva,idHuesped,idHabitacion,cargos) VALUES ({$row['idReserva']},{$row['idHuesped']},{$_POST['nroHabitacion']},{$row['cargos']})";
            $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','HabitacionReservada','{$queryPerformed}')");
        }
    }

	if(isset($_POST['addReservaPendiente'])){

		$insert = mysqli_query($link,"INSERT INTO ReservaPendiente (idTipoHabitacion, idReserva, numeroHabitaciones, fechaInicio, fechaFin, preferencias, idTarifa) VALUES 
        ('{$_POST['tipoHabitacion']}','{$_POST['idReserva']}','{$_POST['numHabitaciones']}','{$_POST['checkin']}','{$_POST['checkout']}','{$_POST['preferencias']}','{$_POST['tarifa']}')");

		$queryPerformed = "INSERT INTO ReservaPendiente VALUES 
        ({$_POST['tipoHabitacion']},{$_POST['idReserva']},{$_POST['numHabitaciones']},{$_POST['checkin']},{$_POST['checkout']},{$_POST['preferencias']},{$_POST['tarifa']})";

		$databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','DATOS RESERVA PENDIENTE','{$queryPerformed}')");
	}

	if(isset($_POST['deleteTipoHabitacion'])){
        $delete = mysqli_query($link,"DELETE FROM ReservaPendiente WHERE idReserva = '{$_POST['idReserva']}' AND idTipoHabitacion = '{$_POST['idTipoHabitacion']}'");
        $queryPerformed = "DELETE FROM ReservaPendiente WHERE idReserva = {$_POST['idReserva']} AND idTipoHabitacion = {$_POST['idTipoHabitacion']}";
        $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','DELETE','DATOS RESERVA PENDIENTE','{$queryPerformed}')");
    }

	if(isset($_POST['addOcupante'])){
        $idHuespedUsado = null;
		$searchDNI = mysqli_query($link,"SELECT * FROM Huesped WHERE dni = '{$_POST['dni']}'");
		while($rowDNI = mysqli_fetch_array($searchDNI)){
		    $idHuespedUsado = $rowDNI['idHuesped'];
        }

        if($idHuespedUsado == null){
            $insert = mysqli_query($link,"INSERT INTO Huesped (idEmpresa, idCiudad, idGenero, nacionalidad_idPais, nombreCompleto, direccion, correoElectronico, codigoPostal, telefonoFijo, telefonoCelular, fechaNacimiento, preferencias, vip, contacto, dni) VALUES (null,null,null,null,'{$_POST['nombres']}',null,null,null,null,null,null,null,0,0,'{$_POST['dni']}')");
            $queryPerformed = "INSERT INTO Huesped VALUES (null,null,null,null,{$_POST['nombres']},null,null,null,null,null,null,null,0,0,'{$dni}')";
            $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','CREAR HUESPED','{$queryPerformed}')");
            $getHuesped = mysqli_query($link,"SELECT * FROM Huesped ORDER BY idHuesped DESC");
            while($rowHuesped = mysqli_fetch_array($getHuesped)){
                $idHuespedUsado = $rowHuesped['idHuesped'];
                break;
            }
        }

		if(!isset($_POST['cargos'])){$cargos = false;}else{$cargos = true;}

		$insert = mysqli_query($link,"INSERT INTO Ocupantes(idReserva,idHuesped,idHabitacion,cargos) VALUES ('{$_POST['idReserva']}','{$idHuespedUsado}','{$_POST['idHabitacion']}','{$cargos}')");
		$queryPerformed = "INSERT INTO Ocupantes(idReserva,idHuesped,idHabitacion,cargos) VALUES ({$_POST['idReserva']},{$idHuespedUsado},{$_POST['idHabitacion']},{$cargos})";
		$databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','OCUPANTE','{$queryPerformed}')");
	}

	if(isset($_POST['deleteOcupante'])){
		$delete = mysqli_query($link,"DELETE FROM Ocupantes WHERE idReserva = '{$_POST['idReserva']}' AND idHuesped = '{$_POST['idHuesped']}'");
		$queryPerformed = "DELETE FROM Ocupantes WHERE idReserva = {$_POST['idReserva']} AND idHuesped = {$_POST['idHuesped']}";
		$databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','DELETE','OCUPANTE ','{$queryPerformed}')");
	}

	if(isset($_POST['deleteHabitacion'])){
		$delete = mysqli_query($link,"DELETE FROM Ocupantes WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");
	    $delete = mysqli_query($link,"DELETE FROM HabitacionReservada WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}' AND idHabitacionReservada = '{$_POST['idHabitacionReservada']}'");
		$queryPerformed = "DELETE FROM HabitacionReservada WHERE idReserva = {$_POST['idReserva']} AND idHabitacion = {$_POST['idHabitacion']} AND idHabitacionReservada = {$_POST['idHabitacionReservada']}";
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

	if(isset($_POST['deleteRecojo'])){
		$delete = mysqli_query($link,"DELETE FROM Recojo WHERE idRecojo = '{$_POST['idRecojo']}'");
		$queryPerformed = "DELETE FROM Recojo WHERE idRecojo = {$_POST['idRecojo']}";
		$databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','DELETE','Recojo','{$queryPerformed}')");
	}

	if(isset($_POST['idReserva'])){
		if($estadoReserva == '3') {
			$pendiente = mysqli_query($link,"SELECT * FROM ReservaPendiente WHERE idReserva = '{$_POST['idReserva']}'");
			while($rowPendiente = mysqli_fetch_array($pendiente)){
				?>
                <section class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-3">
                                <div class="card-header reservas">
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
                                                    <th>Preferencias</th>
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
                            <div class="card-header reservas">
                                <i class="fa fa-table"></i> Detalles de la Reserva
                                <div class="float-right">
                                    <button name="addRecojo" type="submit" form="formRecojo" class="btn btn-light btn-sm" formaction="agenda.php">Guardar Reserva</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 offset-2">
                                        <p><strong>Nombre:</strong> <?php echo $nombreHuesped; ?></p>
                                        <p><strong>Teléfono:</strong> <?php echo $telefonoHuesped; ?></p>
                                        <p><strong>DNI:</strong> <?php echo $dniHuesped; ?></p>
                                        <p><strong>Email:</strong> <?php echo $emailHuesped; ?></p>
                                    </div>
                                    <div class="col-6">
                                        <form method="post">
                                            <input type="hidden" name="idReserva" value="<?php echo $_POST['idReserva'];?>">
                                            <div class="col-6 text-center">
                                                <p>Seleccione el tipo de pago:</p>
                                                <select name="tipoPago" class="form-control">
				                                    <?php
				                                    if($tipoPago == null){
					                                    echo "<option disabled selected>Seleccionar</option>";
					                                    echo "<option value='Crédito'>Crédito</option>";
					                                    echo "<option value='Pago Directo'>Pago Directo</option>";
					                                    echo "<option value='Pago Diferido'>Pago Diferido</option>";
				                                    }else{
					                                    echo "<option selected>{$tipoPago}</option>";
					                                    switch($tipoPago){
						                                    case 'Crédito':
							                                    echo "<option value='Pago Directo'>Pago Directo</option>";
							                                    echo "<option value='Pago Diferido'>Pago Diferido</option>";
							                                    break;
						                                    case 'Pago Directo':
							                                    echo "<option value='Crédito'>Crédito</option>";
							                                    echo "<option value='Pago Diferido'>Pago Diferido</option>";
							                                    break;
						                                    case 'Pago Diferido':
							                                    echo "<option value='Crédito'>Crédito</option>";
							                                    echo "<option value='Pago Directo'>Pago Directo</option>";
							                                    break;
					                                    }
				                                    }
				                                    ?>
                                                </select>
                                                <div class="spacer20"></div>
                                                <input type="submit" value="Guardar" class="btn btn-primary" name="updateTipoPago">
                                        </form>
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
                            <div class="card-header reservas">
                                <i class="fa fa-table"></i> Detalles del Recojo
                            </div>
                            <div class="card-body">
                                <form method="post" action="#" id="formRecojo">
                                    <input type="hidden" name="idReserva" value="<?php echo $_POST['idReserva'];?>">
                                    <div class="row">
                                        <div class="col-12 ">
                                            <table class="table text-center">
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
                                                <tr><td colspan="6"></td></tr>
												<?php
												$recojos = mysqli_query($link,"SELECT * FROM Recojo WHERE idReserva = '{$_POST['idReserva']}'");
												while($rowRecojos = mysqli_fetch_array($recojos)){
													echo "<tr>";
													echo "<td>{$rowRecojos['lugarRecojo']}</td>";
													echo "<td>{$rowRecojos['personaPrincipal']}</td>";
													echo "<td>{$rowRecojos['fechaHora']}</td>";
													echo "<td>{$rowRecojos['numPersonas']}</td>";
													echo "<td>{$rowRecojos['nroTicket']}</td>";
													echo "<td>
                                                        <form method='post'>
                                                                    <input type='hidden' name='idRecojo' value='{$rowRecojos['idRecojo']}'>
                                                                    <input type='hidden' name='idReserva' value='{$_POST['idReserva']}'>
                                                                    <input type=\"submit\" value=\"Eliminar\" class=\"btn btn-sm btn-primary\" formaction=\"#\" name='deleteRecojo'>
                                                        </form>
                                                      </td>
                                                ";
													echo "</tr>";
												}
												?>
                                                </tbody>
                                            </table>
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
                            <div class="card-header reservas">
                                <i class="fa fa-table"></i> Habitaciones
                                <div class="pull-right">
                                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAddHabitacion">Agregar Habitación</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Check-In</th>
                                                <th>Check-Out</th>
                                                <th>Tipo de Habitación</th>
                                                <th>Habitación</th>
                                                <th>Cama Adicional</th>
                                                <th>Tarifa</th>
                                                <th>Preferencias</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
											<?php
											$query = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE idReserva = '{$_POST['idReserva']}'");
											while($row = mysqli_fetch_array($query)){
												echo "<tr>";
												$fechaInicial = substr($row['fechaInicio'],0,10);
												echo "<td>{$fechaInicial}</td>";
												$fechaFinal = substr($row['fechaFin'],0,10);
												echo "<td>{$fechaFinal}</td>";
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
												echo "<td>{$row['idTarifa']}</td>";
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
                                                                    <input type='hidden' name='idHabitacionReservada' value='{$row['idHabitacionReservada']}'>
                                                                    ";
												if ($row['idEstado'] == 3){
												    echo "<input type=\"submit\" value=\"Registrar Check-In\" class=\"dropdown-item\" formaction=\"#\" name='checkinHabitacion'>";
                                                    echo "<input type=\"button\" value=\"Modificar Datos\" class=\"dropdown-item\" data-toggle=\"modal\" data-target=\"#modalHabitacion\" data-preferencias=\"{$row['preferencias']}\" data-habitacion='{$row['idHabitacion']}' data-reserva='{$_POST['idReserva']}' data-habitacionreservada='{$row['idHabitacionReservada']}' data-checkinedit='{$row['fechaInicio']}' data-checkoutedit='{$row['fechaFin']}'>";
                                                    echo "<input type=\"submit\" value=\"Asignar Early Check-In\" class=\"dropdown-item\" formaction=\"#\" name='earlyCheckIn'>";
                                                    echo "<input type=\"submit\" value=\"Asignar Late Check-Out\" class=\"dropdown-item\" formaction=\"#\" name='lateCheckOut'>";
                                                }elseif($row['idEstado'] == 4){
                                                    echo "<input type=\"button\" value=\"Modificar Datos\" class=\"dropdown-item\" data-toggle=\"modal\" data-target=\"#modalHabitacion\" data-preferencias=\"{$row['preferencias']}\" data-habitacion='{$row['idHabitacion']}' data-reserva='{$_POST['idReserva']}' data-habitacionreservada='{$row['idHabitacionReservada']}' data-checkinedit='{$row['fechaInicio']}' data-checkoutedit='{$row['fechaFin']}'>";
                                                    echo "<input type=\"submit\" value=\"Asignar Early Check-In\" class=\"dropdown-item\" formaction=\"#\" name='earlyCheckIn'>";
                                                    echo "<input type=\"submit\" value=\"Asignar Late Check-Out\" class=\"dropdown-item\" formaction=\"#\" name='lateCheckOut'>";
                                                    echo "<input type=\"submit\" value=\"Registrar Cambio de Habitación\" class=\"dropdown-item\" formaction=\"cambioHabitacion.php\" name='cambioHabitacion'>";
                                                }
												echo "
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
                            <div class="card-header reservas">
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
													echo "<td colspan='2'>{$row2['nombreCompleto']}</td>";
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
                                            <input type="number" name="dni" id="dni" class="form-control" min="0">
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

            <!-- Modal -->
            <div class="modal fade" id="modalHabitacion" tabindex="-1" role="dialog" aria-labelledby="modalHabitacion" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modificación de Preferencias</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="#" method="post" id="formHabitacionRes">
                                <div class="form-group row">
                                    <label for="checkInEditar" class="col-form-label col-1 offset-1">CheckIn:</label>
                                    <div class="col-3">
                                        <input type="date" class="form-control checkinedit" name="checkInEditar" id="checkInEditar" required>
                                    </div>
                                    <label for="checkOutEditar" class="col-form-label col-1 offset-1">CheckOut:</label>
                                    <div class="col-3">
                                        <input type="date" class="form-control checkoutedit" name="checkOutEditar" id="checkOutEditar" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <h6 class="mx-5">Preferencias</h6>
                                    <textarea name="preferenciasEditar" id="preferenciasEditar" cols="30" rows="2" class="form-control mx-5 preferencias"></textarea>
                                </div>
                                <input type="hidden" name="idHabitacion" class="idHabitacion">
                                <input type="hidden" name="idHabitacionReservada" class="idHabitacionReservada">
                                <input type="hidden" name="idReserva" class="idReserva">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" form="formHabitacionRes" name="modificarPreferencias">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalAddHabitacion" tabindex="-1" role="dialog" aria-labelledby="modalAddHabitacionLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAddHabitacionLabel">Agregar Habitación</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="#" method="post" id="formAddHabitacion">
                                <input type="hidden" name="idReserva" value="<?php echo $_POST['idReserva'];?>">
                                <div class="form-group row">
                                    <label for="inicioCheckIn" class="col-form-label col-2 offset-1">Check In</label>
                                    <input type="date" name="fechaInicio" class="form-control col-3" id="inicioCheckIn">
                                    <label for="finCheckOut" class="col-form-label col-2">Check Out</label>
                                    <input type="date" name="fechaFin" class="form-control col-3" id="finCheckOut">
                                </div>
                                <div class="form-group row">
                                    <label for="tipoHabitacion" class="col-form-label col-2 offset-1">Tipo Hab.</label>
                                    <select class="form-control col-3" name="tipoHabitacion" onchange="getHabitacion(this.value);getTarifaTooltip(this.value)">
                                        <option selected disabled>Seleccionar</option>
                                        <?php
                                        $query = mysqli_query($link, "SELECT * FROM TipoHabitacion");
                                        while ($row = mysqli_fetch_array($query)) {
                                            echo "<option value='{$row['idTipoHabitacion']}'>{$row['descripcion']}</option>";
                                        }
                                        ?>
                                    </select>
                                    <label for="nroHabitacion" class="col-form-label col-2">Número Hab.</label>
                                    <select class="form-control col-3" name="nroHabitacion" id="nroHabitacion">
                                        <option selected disabled>Seleccionar</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="camaAdicional" class="col-form-label col-2 offset-1">Cama Adicional</label>
                                    <input class="form-control col-1 mt-2" type="checkbox" name="camaAdicional"  id="camaAdicional" value="true">
                                    <label for="inputTarifa" class="col-form-label col-2 offset-2">Tarifa</label>
                                    <div id="tarifa" class="col-3 px-0">
                                        <input type="number" step="0.01" min="0" name="tarifa" id="inputTarifa" data-animation="true" class="form-control col-12" data-toggle="tooltip" data-placement="bottom" title="Seleccione un Tipo de Habitación para ver las tarifas disponibles" form="formHabitacion">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="preferencias" class="col-form-label col-2 offset-1">Preferencias</label>
                                    <textarea name="preferencias" id="preferencias" cols="30" rows="3" class="form-control col-8"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" form="formAddHabitacion" name="addReservaConfirmada">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

			<?php
		}elseif($estadoReserva == '9'){
			?>
            <section class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-3">
                            <div class="card-header reservas">
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
                                        <p><strong>DNI:</strong> <?php echo $dniHuesped; ?></p>
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
                                                        <select class="form-control" name="tipoHabitacion" onchange="getTarifaTooltip(this.value)">
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
                                                        <!--<select class="form-control" name="tarifa" id="tarifa">
                                                            <option selected disabled>Seleccionar</option>
                                                        </select>-->
                                                        <input type="number" min="0" name="tarifa" data-animation="true" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Seleccione un Tipo de Habitación para ver las tarifas disponibles">
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
                                                echo "<td>{$row['idTarifa']}</td>";
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
	}
	include('footer.php');
}
?>