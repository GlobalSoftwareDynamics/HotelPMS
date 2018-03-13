<?php
include('session.php');
include('declaracionFechas.php');
include('funciones.php');
if(isset($_SESSION['login'])){
	include('header.php');
	if($_SESSION['userType'] == 1){
        include('navbarRecepcion.php');
    }else{
	    include('navbarAdmin.php');
    }


	?>

    <script>
        $(document).ready(function() {
            $('.select2select').select2();
        });
    </script>

	<section class="container">
		<div class="row">
			<div class="col-4 mb-3">
				<div class="card text-white bg-card o-hidden h-100">
					<div class="card-body">
						<div class="card-body-icon">
							<i class="fa fa-fw fa-car"></i>
						</div>
                        <div class="spacer15"></div>
                        <?php
                        $date = date("Y-m-d");
                        $result = mysqli_query($link,"SELECT COUNT(*) AS nroArribos FROM HabitacionReservada WHERE fechaInicio = '{$date}' AND idEstado = '3'");
                        while ($fila = mysqli_fetch_array($result)){
                            $nroArribos = $fila['nroArribos'];
                        }
                        ?>
						<div class="card-body-text"><?php echo $nroArribos;?> Arribos</div>
					</div>
				</div>
			</div>
			<div class="col-4 mb-3">
                <div class="card text-white bg-card o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-fw fa-tags"></i>
                        </div>
                        <div class="spacer15"></div>
                        <?php
                        $date = date("Y-m-d");
                        $result = mysqli_query($link,"SELECT COUNT(*) AS nroSalidas FROM HabitacionReservada WHERE fechaFin = '{$date}' AND idEstado = '4'");
                        while ($fila = mysqli_fetch_array($result)){
                            $nroSalidas = $fila['nroSalidas'];
                        }
                        ?>
                        <div class="card-body-text"><?php echo $nroSalidas;?> Salidas</div>
                    </div>
                </div>
			</div>
			<div class="col-4 mb-3">
                <div class="card text-white bg-card o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-fw fa-bed"></i>
                        </div>
                        <div class="spacer15"></div>
                        <?php
                        $date = date("Y-m-d");
                        $result = mysqli_query($link,"SELECT COUNT(*) AS nroHuespedes FROM Ocupantes WHERE (idReserva, idHabitacion) IN (SELECT idReserva, idHabitacion FROM HabitacionReservada WHERE fechaFin >= '{$date}' AND idEstado = '4')");
                        while ($fila = mysqli_fetch_array($result)){
                            $nroHuespedes = $fila['nroHuespedes'];
                        }
                        ?>
                        <div class="card-body-text"><a href="gestionHuespedesAlojados.php" style="color: white; text-underline: none"><?php echo $nroHuespedes;?> Huespedes</a></div>
                        <div class="spacer20"></div>
                    </div>
                </div>
            </div>
		</div>
		<div class="spacer20"></div>
		<div class="row">
			<div class="col-6">
				<div class="card mb-3">
					<div class="card-header main">
						<i class="fa fa-table"></i> Reservas
                            <div class="float-right">
                                <form>
							        <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#modalReserva">Nueva Reserva</button>
                                    <button type="submit" class="btn btn-sm btn-light" formaction="reporteDesayunos.php">Lista de Desayuno</button>
                                </form>
                            </div>
					</div>
					<div class="card-body">
						<ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#pendientes" role="tab">Pendientes</a>
                            </li>
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#arribos" role="tab">Arribos</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#checkout" role="tab">Registrados</a>
							</li>
						</ul>
						<div class="tab-content" style="overflow-y: scroll; height: 250px">
							<div class="tab-pane active" id="arribos" role="tabpanel">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#hoy" role="tab">Hoy</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#manana" role="tab">Mañana</a>
									</li>
								</ul>
								<div class="spacer10"></div>
								<div class="tab-content">
									<div class="tab-pane active" id="hoy" role="tabpanel">
										<table class="table text-center">
											<thead>
											<tr>
												<th class="text-center">Huésped</th>
                                                <th class="text-center">Empresa</th>
												<th class="text-center">ID Reserva</th>
												<th class="text-center">Habitación</th>
												<th class="text-center">Acciones</th>
											</tr>
											</thead>
                                            <tbody>
                                            <?php
                                            $date = date("Y-m-d");
                                            $result = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE fechaInicio = '{$date}' AND idEstado = '3' ORDER BY fechaInicio DESC");
                                            while ($fila = mysqli_fetch_array($result)){
                                                echo "<tr>";
                                                $result1 = mysqli_query($link,"SELECT * FROM Ocupantes WHERE idReserva = '{$fila['idReserva']}' AND idHabitacion = '{$fila['idHabitacion']}' AND cargos = 1");
                                                $numrow = mysqli_num_rows($result1);
                                                if ($numrow > 0){
                                                    while ($fila1 = mysqli_fetch_array($result1)){
                                                        $result2 = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped = '{$fila1['idHuesped']}'");
                                                        while ($fila2 = mysqli_fetch_array($result2)){
                                                            $result3 = mysqli_query($link,"SELECT * FROM Empresa WHERE idEmpresa = '{$fila2['idEmpresa']}'");
                                                            $numrows = mysqli_num_rows($result3);
                                                            if ($numrows == 0){
                                                                $empresa = "Sin Empresa";
                                                            }else{
                                                                while ($fila3 = mysqli_fetch_array($result3)){
                                                                    $empresa = $fila3['razonSocial'];
                                                                }
                                                            }
                                                            $nombre = $fila2['nombreCompleto'];
                                                        }
                                                    }
                                                }else{
                                                    $empresa = "No Definido";
                                                    $nombre = "No Definido";
                                                }
                                                $result1 = mysqli_query($link,"SELECT * FROM Estado WHERE idEstado = '{$fila['idEstado']}'");
                                                while ($fila1 = mysqli_fetch_array($result1)){
                                                    $estado = $fila1['descripcion'];
                                                }
                                                echo "<td>{$nombre}</td>";
                                                echo "<td>{$empresa}</td>";
                                                echo "<td>{$fila['idReserva']}</td>";
                                                echo "<td>{$fila['idHabitacion']}</td>";
                                                echo "<td>
                                                        <form method='post'>
                                                            <div class=\"dropdown\">
                                                                <button class=\"btn btn-primary btn-sm dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                                                Acciones
                                                                </button>
                                                                <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                                                                    <input type='hidden' name='idReserva' value='{$fila['idReserva']}'>
                                                                    <input type='hidden' name='idHabitacion' value='{$fila['idHabitacion']}'>
                                                                    <input type=\"submit\" value=\"Check-In\" class=\"dropdown-item\" formaction=\"nuevaReserva.php\" name='confirmarReserva'>
                                                                    <input type=\"submit\" value=\"Ver Reserva\" class=\"dropdown-item\" formaction=\"verReserva.php\">
                                                                    <input type=\"submit\" value=\"Editar Reserva\" class=\"dropdown-item\" formaction=\"nuevaReserva.php\">
                                                                    <input type=\"submit\" value=\"Eliminar\" class=\"dropdown-item\" formaction=\"#\">
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
									<div class="tab-pane" id="manana" role="tabpanel">
										<table class="table text-center">
											<thead>
											<tr>
                                                <th class="text-center">Huésped</th>
                                                <th class="text-center">Empresa</th>
                                                <th class="text-center">ID Reserva</th>
                                                <th class="text-center">Habitación</th>
                                                <th class="text-center">Acciones</th>
											</tr>
											</thead>
                                            <tbody>
                                            <?php
                                            $date = date("Y-m-d");
                                            $date = date('Y-m-d', strtotime($date . ' +1 day'));
                                            $result = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE fechaInicio = '{$date}' AND idEstado = '3' ORDER BY fechaInicio DESC");
                                            while ($fila = mysqli_fetch_array($result)){
                                                echo "<tr>";
                                                $result1 = mysqli_query($link,"SELECT * FROM Ocupantes WHERE idReserva = '{$fila['idReserva']}' AND idHabitacion = '{$fila['idHabitacion']}' AND cargos = 1");
                                                $numrow = mysqli_num_rows($result1);
                                                if ($numrow > 0){
                                                    while ($fila1 = mysqli_fetch_array($result1)){
                                                        $result2 = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped = '{$fila1['idHuesped']}'");
                                                        while ($fila2 = mysqli_fetch_array($result2)){
                                                            $result3 = mysqli_query($link,"SELECT * FROM Empresa WHERE idEmpresa = '{$fila2['idEmpresa']}'");
                                                            $numrows = mysqli_num_rows($result3);
                                                            if ($numrows == 0){
                                                                $empresa = "Sin Empresa";
                                                            }else{
                                                                while ($fila3 = mysqli_fetch_array($result3)){
                                                                    $empresa = $fila3['razonSocial'];
                                                                }
                                                            }
                                                            $nombre = $fila2['nombreCompleto'];
                                                        }
                                                    }
                                                }else{
                                                    $empresa = "No Definido";
                                                    $nombre = "No Definido";
                                                }
                                                $result1 = mysqli_query($link,"SELECT * FROM Estado WHERE idEstado = '{$fila['idEstado']}'");
                                                while ($fila1 = mysqli_fetch_array($result1)){
                                                    $estado = $fila1['descripcion'];
                                                }
                                                echo "<td>{$nombre}</td>";
                                                echo "<td>{$empresa}</td>";
                                                echo "<td>{$fila['idReserva']}</td>";
                                                echo "<td>{$fila['idHabitacion']}</td>";
                                                echo "<td>
                                                        <form method='post'>
                                                            <div class=\"dropdown\">
                                                                <button class=\"btn btn-primary btn-sm dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                                                Acciones
                                                                </button>
                                                                <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                                                                    <input type='hidden' name='idReserva' value='{$fila['idReserva']}'>
                                                                    <input type='hidden' name='idHabitacion' value='{$fila['idHabitacion']}'>
                                                                    <input type=\"submit\" value=\"Ver Reserva\" class=\"dropdown-item\" formaction=\"verReserva.php\">
                                                                    <input type=\"submit\" value=\"Editar Reserva\" class=\"dropdown-item\" formaction=\"nuevaReserva.php\">
                                                                    <input type=\"submit\" value=\"Eliminar\" class=\"dropdown-item\" formaction=\"#\">
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
							<div class="tab-pane" id="checkout" role="tabpanel">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#hoy2" role="tab">Hoy</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#manana2" role="tab">Mañana</a>
									</li>
								</ul>
								<div class="spacer10"></div>
								<div class="tab-content">
									<div class="tab-pane active" id="hoy2" role="tabpanel">
										<table class="table text-center">
											<thead>
											<tr>
												<th class="text-center">Huésped</th>
                                                <th class="text-center">Empresa</th>
												<th class="text-center">ID Reserva</th>
												<th class="text-center">Habitación</th>
												<th class="text-center">Acciones</th>
											</tr>
											</thead>
                                            <tbody>
                                            <?php
                                            $date = date("Y-m-d");
                                            $result = mysqli_query($link,"SELECT * FROM Ocupantes WHERE (idReserva, idHabitacion) IN (SELECT idReserva, idHabitacion FROM HabitacionReservada WHERE fechaFin >= '{$date}' AND idEstado = '4' ORDER BY fechaInicio DESC)");
                                            while ($fila = mysqli_fetch_array($result)){
                                                $result1 = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped = '{$fila['idHuesped']}'");
                                                while ($fila1 = mysqli_fetch_array($result1)){
                                                    $result3 = mysqli_query($link,"SELECT * FROM Empresa WHERE idEmpresa = '{$fila1['idEmpresa']}'");
                                                    $numrows = mysqli_num_rows($result3);
                                                    if ($numrows == 0){
                                                        $empresa = "Sin Empresa";
                                                    }else{
                                                        while ($fila3 = mysqli_fetch_array($result3)){
                                                            $empresa = $fila3['razonSocial'];
                                                        }
                                                    }
                                                    $nombre = $fila1['nombreCompleto'];
                                                    $idHuesped = $fila1['idHuesped'];
                                                }
                                                echo "<tr>";
                                                echo "<td>{$nombre}</td>";
                                                echo "<td>{$empresa}</td>";
                                                echo "<td>{$fila['idReserva']}</td>";
                                                echo "<td>{$fila['idHabitacion']}</td>";
                                                echo "<td>
                                                        <form method='post'>
                                                            <div class=\"dropdown\">
                                                                <button class=\"btn btn-primary btn-sm dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                                                    Acciones
                                                                </button>
                                                                <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                                                                    <input type='hidden' name='idReserva' value='{$fila['idReserva']}'>
                                                                    <input type='hidden' name='idHabitacion' value='{$fila['idHabitacion']}'>
                                                                    <input type=\"submit\" value=\"Registrar Consumo\" class=\"dropdown-item\" formaction=\"nuevoConsumo.php\">
                                                                    <input type=\"submit\" value=\"Registrar Check-out\" class=\"dropdown-item\" formaction=\"registrarCheckout.php\">
                                                                    <input type=\"submit\" value=\"Ver Reserva\" class=\"dropdown-item\" formaction=\"verReserva.php\">
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
									<div class="tab-pane" id="manana2" role="tabpanel">
										<table class="table text-center">
											<thead>
											<tr>
                                                <th class="text-center">Huésped</th>
                                                <th class="text-center">Empresa</th>
                                                <th class="text-center">ID Reserva</th>
                                                <th class="text-center">Habitación</th>
                                                <th class="text-center">Acciones</th>
											</tr>
											</thead>
                                            <tbody>
                                            <?php
                                            $date = date("Y-m-d");
                                            $date = date('Y-m-d', strtotime($date . ' +1 day'));
                                            $result = mysqli_query($link,"SELECT * FROM Ocupantes WHERE (idReserva, idHabitacion) IN (SELECT idReserva, idHabitacion FROM HabitacionReservada WHERE fechaFin >= '{$date}' AND idEstado = '4' ORDER BY fechaInicio DESC)");
                                            while ($fila = mysqli_fetch_array($result)){
                                                $result1 = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped = '{$fila['idHuesped']}'");
                                                while ($fila1 = mysqli_fetch_array($result1)){
                                                    $result3 = mysqli_query($link,"SELECT * FROM Empresa WHERE idEmpresa = '{$fila1['idEmpresa']}'");
                                                    $numrows = mysqli_num_rows($result3);
                                                    if ($numrows == 0){
                                                        $empresa = "Sin Empresa";
                                                    }else{
                                                        while ($fila3 = mysqli_fetch_array($result3)){
                                                            $empresa = $fila3['razonSocial'];
                                                        }
                                                    }
                                                    $nombre = $fila1['nombreCompleto'];
                                                    $idHuesped = $fila1['idHuesped'];
                                                }
                                                echo "<tr>";
                                                echo "<td>{$nombre}</td>";
                                                echo "<td>{$empresa}</td>";
                                                echo "<td>{$fila['idReserva']}</td>";
                                                echo "<td>{$fila['idHabitacion']}</td>";
                                                echo "<td>
                                                        <form method='post'>
                                                            <div class=\"dropdown\">
                                                                <button class=\"btn btn-primary btn-sm dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                                                    Acciones
                                                                </button>
                                                                <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                                                                    <input type='hidden' name='idReserva' value='{$fila['idReserva']}'>
                                                                    <input type='hidden' name='idHabitacion' value='{$fila['idHabitacion']}'>
                                                                    <input type=\"submit\" value=\"Registrar Consumo\" class=\"dropdown-item\" formaction=\"nuevoConsumo.php\">
                                                                    <input type=\"submit\" value=\"Registrar Check-out\" class=\"dropdown-item\" formaction=\"registrarCheckout.php\">
                                                                    <input type=\"submit\" value=\"Ver Reserva\" class=\"dropdown-item\" formaction=\"verReserva.php\">
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
                            <div class="tab-pane" id="pendientes" role="tabpanel">
                                <div class="spacer10"></div>
                                <table class="table text-center">
                                    <thead>
                                    <tr>
                                        <th class="text-center">ID Reserva</th>
                                        <th class="text-center">Fecha de Reservación</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $date = date("Y-m-d");
                                    $result = mysqli_query($link,"SELECT * FROM Reserva WHERE idEstado = '9' ORDER BY fechaReserva DESC");
                                    while ($fila = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                        echo "<td>{$fila['idReserva']}</td>";
                                        echo "<td>{$fila['fechaReserva']}</td>";
                                        echo "<td>
                                                        <form method='post'>
                                                            <div class=\"dropdown\">
                                                                <button class=\"btn btn-primary btn-sm dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                                                    Acciones
                                                                </button>
                                                                <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                                                                    <input type='hidden' name='idReserva' value='{$fila['idReserva']}'>
                                                                    <input type=\"submit\" value=\"Confirmar Reserva\" class=\"dropdown-item\" formaction=\"nuevaReserva.php\" name='confirmaReserva'>
                                                                    <input type=\"submit\" value=\"Ver Reserva\" class=\"dropdown-item\" formaction=\"verReserva.php\">
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
			<div class="col-6">
				<div class="card mb-3">
					<div class="card-header main">
						<i class="fa fa-table"></i> Actividad del día</div>
					<div class="card-body">
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#checkin" role="tab">Check-In</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#checkout2" role="tab">Check-out</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#consumos" role="tab">Consumos</a>
							</li>
						</ul>
						<div class="spacer10"></div>
						<div class="tab-content" style="overflow-y: scroll; height: 250px">
							<div class="tab-pane active" id="checkin" role="tabpanel">
								<table class="table text-center">
									<thead>
									<tr>
										<th class="text-center">ID Reserva</th>
										<th class="text-center">Habitación</th>
										<th class="text-center">Hora</th>
									</tr>
									</thead>
                                    <tbody>
                                    <?php
                                    $date = date("Y-m-d");
                                    $result = mysqli_query($link,"SELECT * FROM HistorialReserva WHERE fechaHora LIKE '{$date} %' AND tipo = 'Check In' ORDER BY fechaHora DESC");
                                    while ($fila =  mysqli_fetch_array($result)){
                                        $hora = explode(" ",$fila['fechaHora']);
                                        echo "<tr>";
                                        echo "<td>{$fila['idReserva']}</td>";
                                        echo "<td>{$fila['idHabitacion']}</td>";
                                        echo "<td>{$hora[1]}</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
								</table>
							</div>
							<div class="tab-pane" id="checkout2" role="tabpanel">
								<table class="table text-center">
									<thead>
									<tr>
										<th class="text-center">ID Reserva</th>
										<th class="text-center">Habitación</th>
										<th class="text-center">Hora</th>
									</tr>
									</thead>
                                    <tbody>
                                    <?php
                                    $date = date("Y-m-d");
                                    $result = mysqli_query($link,"SELECT * FROM HistorialReserva WHERE fechaHora LIKE '{$date} %' AND tipo = 'Check Out' ORDER BY fechaHora DESC");
                                    while ($fila =  mysqli_fetch_array($result)){
                                        $hora = explode(" ",$fila['fechaHora']);
                                        echo "<tr>";
                                        echo "<td>{$fila['idReserva']}</td>";
                                        echo "<td>{$fila['idHabitacion']}</td>";
                                        echo "<td>{$hora[1]}</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
								</table>
							</div>
							<div class="tab-pane" id="consumos" role="tabpanel">
								<table class="table text-center">
									<thead>
									<tr>
										<th class="text-center">Huésped</th>
										<th class="text-center">ID Reserva</th>
										<th class="text-center">Habitación</th>
										<th class="text-center">Monto</th>
									</tr>
									</thead>
                                    <tbody>
                                    <?php
                                    $date = date("Y-m-d");
                                    $result = mysqli_query($link,"SELECT * FROM Transaccion WHERE fechaTransaccion = '{$date}' ORDER BY fechaTransaccion DESC");
                                    while ($fila =  mysqli_fetch_array($result)){
                                        $result1 = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped = '{$fila['idHuesped']}'");
                                        while ($fila1 = mysqli_fetch_array($result1)){
                                            $nombre = $fila1['nombreCompleto'];
                                            $idHuesped = $fila['idHuesped'];
                                        }
                                        echo "<tr>";
                                        echo "<td>{$nombre}</td>";
                                        echo "<td>{$fila['idReserva']}</td>";
                                        echo "<td>{$fila['idHabitacion']}</td>";
                                        echo "<td>S/. {$fila['monto']}</td>";
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

	<form method="post" action="nuevaReserva.php">
		<div class="modal fade" id="modalReserva" role="dialog" aria-labelledby="modalReserva" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Nueva Reserva</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="container-fluid">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label class="col-form-label" for="empresa">Empresa:</label>
                                    <select class="form-control" name="empresa" id="empresa" onchange="getNombreEmpresa(this.value);">
                                        <option selected disabled>Seleccionar</option>
                                        <?php
                                        $result = mysqli_query($link,"SELECT * FROM Empresa ORDER BY razonSocial ASC ");
                                        while ($fila = mysqli_fetch_array($result)){
                                            echo "<option value='{$fila['idEmpresa']}'>{$fila['razonSocial']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="idReserva" value="<?php $idReserva = idgen("R"); echo $idReserva?>">
							<div class="row">
								<div class="form-group col-6" id="divDni">
									<label class="col-form-label" for="dni">DNI Titular:</label>
                                    <input type="text" name="dni" required id="dni" class="form-control" onchange="getNombre(this.value);getTelf(this.value);getEmail(this.value);">
									<!--<input type="number" name="dni" required id="dni" class="form-control" onchange="getNombre(this.value);getTelf(this.value);getEmail(this.value);getEmpresa(this.value)" min="0">-->
								</div>
								<div class="form-group col-6" id="divNombre">
									<label class="col-form-label" for="nombres">Nombre Completo:</label>
                                    <input type="text" name="nombres" id="nombres" class="form-control">
									<!--<input type="text" name="nombres" id="nombres" class="form-control" onchange="getID(this.value);getTelf(this.value);getEmail(this.value);getEmpresa1(this.value)">-->
								</div>
							</div>
							<div class="row">
								<div class="form-group col-6" id="divTelf">
									<label class="col-form-label" for="telefono">Teléfono Celular:</label>
									<input type="text" name="telefono" id="telefono" class="form-control">
								</div>
								<div class="form-group col-6" id="divEmail">
									<label class="col-form-label" for="email">Correo Electrónico:</label>
									<input type="email" name="email" id="email" class="form-control" required>
								</div>
							</div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label class="col-form-label" for="tipoReserva">Tipo de Reserva:</label>
                                    <select class="form-control" name="tipoReserva" id="tipoReserva" onchange="getPaquete(this.value)">
                                        <option selected disabled>Seleccionar</option>
                                        <option value="3">Reserva Confirmada</option>
                                        <option value="9">Reserva Pendiente</option>
                                        <option value="10">Reserva de Paquete</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12" id="paquete">
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