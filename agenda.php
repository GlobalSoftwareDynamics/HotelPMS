<?php
include('session.php');
if(isset($_SESSION['login'])){
	include('header.php');
	include('navbarRecepcion.php');
	include('declaracionFechas.php');

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
            numPersonas = '{$_POST['numPersonas']}', personaPrincipal = '{$_POST['personaPrincipal']}'");
			$queryPerformed = "UPDATE Recojo SET nroTicket = {$_POST['nroTicket']}, fechaHora = {$_POST['fechaRecojo']}, lugarRecojo = {$_POST['lugarRecojo']}, 
            numPersonas = {$_POST['numPersonas']}, personaPrincipal = {$_POST['personaPrincipal']}";
			$databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','RECOJO RESERVA ','{$queryPerformed}')");
		}
	}

	if (isset($_POST['checkOut'])){

	    $query = mysqli_query($link,"UPDATE HabitacionReservada SET idEstado = 5 WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");

	    $queryPerformed = "UPDATE HabitacionReservada SET idEstado = 5 WHERE idReserva = {$_POST['idReserva']} AND idHabitacion = {$_POST['idHabitacion']}";

        $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','HabitacionReservada-CheckOut','{$queryPerformed}')");

        $result = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE idReserva = '{$_POST['idReserva']}' AND idEstado = 4");
        $numrow = mysqli_num_rows($result);

        if ($numrow == 0){

            $query = mysqli_query($link,"UPDATE Reserva SET idEstado = 5 WHERE idReserva = '{$_POST['idReserva']}'");

            $queryPerformed = "UPDATE Reserva SET idEstado = 5 WHERE idReserva = {$_POST['idReserva']}";

            $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','Reserva-CheckOut Completo','{$queryPerformed}')");

        }

        $result = mysqli_query($link,"SELECT * FROM Reserva WHERE idReserva = '{$_POST['idReserva']}'");
        while ($fila = mysqli_fetch_array($result)){
            $montoTotal = $fila['montoTotal'] + $_POST['montoHabitacionReserva'];
        }

        $query = mysqli_query($link,"UPDATE Reserva SET montoTotal = '{$montoTotal}', montoPendiente = '{$_POST['montoCancelado']}' WHERE idReserva = '{$_POST['idReserva']}'");

        $queryPerformed = "UPDATE Reserva SET montoTotal = '{$montoTotal}', montoPendiente = '{$_POST['montoCancelado']}' WHERE idReserva = {$_POST['idReserva']}";

        $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','Reserva-Montos','{$queryPerformed}')");

    }
	?>

	<section class="container">
		<div class="row">
			<div class="col-12">
				<div class="card mb-3">
					<div class="card-header">
							<div class="row">
								<div class="col-8"><i class="fa fa-calendar"></i> Agenda de Eventos</div>
								<div class="col-1 no-padding text-center"><button type="button" class="btn btn-sm btn-light"><</button></div>
								<div class="col-1 no-padding-lg text-center"><input type="date" class="form-control input-thin"></div>
								<div class="col-1 no-padding text-center"><button type="button" class="btn btn-sm btn-light">></button></div>
								<div class="col-1 no-padding text-center"><button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#modalReserva">Nueva Reserva</button></div>
							</div>
					</div>
					<div class="card-body">
						<table class="bordered-calendar text-center">
							<thead>
							<tr>
								<th class="habitacion">Habitación</th>
								<th class="fecha">1</th>
								<th class="fecha">2</th>
								<th class="fecha">3</th>
								<th class="fecha">4</th>
								<th class="fecha">5</th>
								<th class="fecha">6</th>
								<th class="fecha">7</th>
								<th class="fecha">8</th>
								<th class="fecha">9</th>
								<th class="fecha">10</th>
								<th class="fecha">11</th>
								<th class="fecha">12</th>
								<th class="fecha">13</th>
								<th class="fecha">14</th>
								<th class="fecha">15</th>
								<th class="fecha">16</th>
								<th class="fecha">17</th>
								<th class="fecha">18</th>
								<th class="fecha">19</th>
								<th class="fecha">20</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<th class="habitacion">Hab. Simple</th>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>103</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td class="reserva" colspan="2" data-id="2"></td>
								<td class="reserva"></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>203</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td class="reserva"></td>
								<td class="reserva"></td>
								<td class="reserva"></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

	<nav id="context-menu" class="context-menu">
		<ul class="context-menu__items">
            <li class="context-menu__item">
                <a href="#" class="context-menu__link" data-action="Checkin" id="checkin"><i class="fa fa-sign-in"></i> Registrar Check-In</a>
            </li>
            <li class="context-menu__item">
                <a href="#" class="context-menu__link" data-action="Checkout" id="checkout"><i class="fa fa-sign-out"></i> Registrar Check-Out</a>
            </li>
			<li class="context-menu__item">
				<a href="#" class="context-menu__link" data-action="View" data-id="ver" id="ver"><i class="fa fa-eye"></i> Ver Reserva</a>
			</li>
			<li class="context-menu__item">
				<a href="#" class="context-menu__link" data-action="Edit" id="editar"><i class="fa fa-edit"></i> Editar Reserva</a>
			</li>
			<li class="context-menu__item">
				<a href="#" class="context-menu__link" data-action="Delete" id="eliminar"><i class="fa fa-times"></i> Eliminar Reserva</a>
			</li>
		</ul>
	</nav>

	<?php
	include('footer.php');
}
?>