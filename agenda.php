<?php
include('session.php');
if(isset($_SESSION['login'])){
	include('header.php');
	include('navbarRecepcion.php');
	include('declaracionFechas.php');

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

        $query = mysqli_query($link,"INSERT INTO HistorialReserva(idHabitacion,idReserva,idColaborador,idEstado,fechaHora,descripcion,tipo) VALUES ('{$_POST['idHabitacion']}','{$_POST['idReserva']}','{$_SESSION['user']}',5,'{$dateTime}','Retiro normal de habitación {$_POST['idHabitacion']} para reserva {$_POST['idReserva']}','Check Out')");

        $queryPerformed = "INSERT INTO HistorialReserva(idHabitacion,idReserva,idColaborador,idEstado,fechaHora,descripcion,tipo) VALUES ({$_POST['idHabitacion']},{$_POST['idReserva']},{$_SESSION['user']},5,{$dateTime},Retiro normal de habitación {$_POST['idHabitacion']} para reserva {$_POST['idReserva']},Check Out)";

        $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','HistorialReserva','{$queryPerformed}')");

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
                            <?php
                            $date1 = date("Y-m-d", strtotime($date . ' -9 days'));
                            $arrayFechas = array();
                            for($i = 0; $i < 20; $i++){
                                $date1 = date('Y-m-d', strtotime($date1 . ' +1 day'));
                                $arrayFechas[$i] = $date1;
                                $hoy = "";
                                if($date1 == $date){
                                    $hoy = "background-color: lightblue";
                                }
                                echo "<th class=\"fecha\" style='{$hoy}'>$date1</th>";
                            }
                            ?>
                            </tr>
							</thead>
							<tbody>
                            <?php
                            $result = mysqli_query($link,"SELECT * FROM TipoHabitacion ORDER BY idTipoHabitacion");
                            while ($fila = mysqli_fetch_array($result)){
                                echo "<tr>";
                                echo "<th>{$fila['descripcion']}</th>";
                                echo "<td colspan='20'></td>";
                                echo "</tr>";
                                $result1 = mysqli_query($link,"SELECT * FROM Habitacion WHERE idTipoHabitacion = '{$fila['idTipoHabitacion']}' ORDER BY idHabitacion");
                                while ($fila1 = mysqli_fetch_array($result1)){
                                    echo "<tr>";
                                    echo "<td class=\"habitacion\">{$fila1['idHabitacion']}</td>";
                                    $flag = false;
                                    $idReserva = 0;
                                    $interval = 1;
                                    for($i = 0; $i < 20; $i = $i+$interval){
                                        $result2 = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE fechaInicio <= '{$arrayFechas[$i]} 23:59:59' AND fechaFin > '{$arrayFechas[$i]}' AND idHabitacion = '{$fila1['idHabitacion']}' AND idEstado IN (3,4,5,8)");
                                        $numrow = mysqli_num_rows($result2);
                                        while ($fila2 = mysqli_fetch_array($result2)){
                                            $fechaInicio = explode(" ",$fila2['fechaInicio']);
                                            $fechaInicio = explode("-",$fechaInicio[0]);
                                            $date1 = date_create("{$fechaInicio[0]}-{$fechaInicio[1]}-{$fechaInicio[2]}");
                                            $fechaFin = explode(" ",$fila2['fechaFin']);
                                            $fechaFin = explode("-",$fechaFin[0]);
                                            $date2 = date_create("{$fechaFin[0]}-{$fechaFin[1]}-{$fechaFin[2]}");
                                            $interval = date_diff($date1,$date2);
                                            $interval = $interval->d;
                                            if($date1 == $date2){
                                                $interval = $interval +1;
                                            }
                                            if($idReserva == $fila2['idReserva']){
                                                $flag = true;
                                            }
                                            $idReserva = $fila2['idReserva'];
                                        }
                                        if ($numrow == 0 && $idReserva == 0){
                                            echo "<td>{$arrayFechas[$i]}</td>";
                                            $idReserva = 0;
                                            $interval = 1;
                                        }elseif($numrow > 0){
                                            echo "<td class=\"reserva\" colspan='{$interval}'>{$idReserva}</td>";
                                        }
                                    }
                                    echo "</tr>";
                                }
                            }
                            ?>
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