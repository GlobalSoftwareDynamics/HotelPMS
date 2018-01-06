<?php
include('session.php');
include('declaracionFechas.php');
include('funciones.php');
if(isset($_SESSION['login'])){
	include('header.php');
	include('navbarRecepcion.php');

	if (isset($_POST['addConsumo'])){

	    $query = mysqli_query($link,"INSERT INTO Transaccion(idTransaccion,idColaborador,idReserva,idHuesped,idHabitacion,monto,detalle,fechaTransaccion,descuento) VALUES 
        ('{$_POST['idTransaccion']}','{$_SESSION['user']}','{$_POST['idReserva']}','{$_POST['idHuesped']}','{$_POST['idHabitacion']}','{$_POST['monto']}','{$_POST['descripcion']}','{$dateTime}','{$_POST['descuento']}')");

	    $queryPerformed = "INSERT INTO Transaccion(idTransaccion,idColaborador,idReserva,idHuesped,idHabitacion,monto,detalle,fechaTransaccion,descuento) VALUES 
        ({$_POST['idTransaccion']},{$_SESSION['user']},{$_POST['idReserva']},{$_POST['idHuesped']},{$_POST['idHabitacion']},{$_POST['monto']},{$_POST['descripcion']},{$dateTime},{$_POST['descuento']})";

        $databaseLog = mysqli_query($link, "INSERT INTO DatabaseLog (idColaborador,fechaHora,evento,tipo,consulta) VALUES ('{$_SESSION['user']}','{$date}','INSERT','Transaccion','{$queryPerformed}')");

    }
	?>

    <?php
    $result = mysqli_query($link,"SELECT * FROM Reserva WHERE idReserva = '{$_POST['idReserva']}'");
    while ($fila = mysqli_fetch_array($result)){
        $result1 = mysqli_query($link,"SELECT * FROM Ocupantes WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}' AND cargos = 1");
        while ($fila1 = mysqli_fetch_array($result1)){
            $result2 = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped = '{$fila1['idHuesped']}'");
            while ($fila2 = mysqli_fetch_array($result2)){
                $nombreCompleto = $fila2['nombreCompleto'];
                $idHuespedCargos = $fila2['idHuesped'];
            }
        }
    }
    ?>
	<section class="container">
		<div class="row">
			<div class="col-12">
				<div class="card mb-3">
					<div class="card-header">
						<i class="fa fa-table"></i> Listado de Consumos
						<div class="float-right">
							<form method="post">
								<button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#modalConsumo">Nuevo Consumo</button>
                                <input type="submit" class="btn btn-sm btn-light" formaction="mainRecepcion.php" value="Regresar">
                            </form>
						</div>
					</div>
					<div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-2"><p><b>Reserva:</b></p></div>
                                    <div class="col-7"><p><?php echo $_POST['idReserva'];?></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-2"><p><b>Habitación:</b></p></div>
                                    <div class="col-7"><p><?php echo $_POST['idHabitacion'];?></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-2"><p><b>Huesped Titular:</b></p></div>
                                    <div class="col-7"><p><?php echo $nombreCompleto?></p></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table text-center">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Transacción</th>
                                        <th class="text-center">Fecha y Hora</th>
                                        <th class="text-center">Huesped</th>
                                        <th class="text-center">Descripción</th>
                                        <th class="text-center">Monto (Incl. tax)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $totalConsumo = 0;
                                    $result = mysqli_query($link,"SELECT * FROM Transaccion WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");
                                    while ($fila = mysqli_fetch_array($result)){
                                        $result1 = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped = '{$fila['idHuesped']}'");
                                        while ($fila1 = mysqli_fetch_array($result1)){
                                            $nombreCompleto = $fila1['nombreCompleto'];
                                        }
                                        echo "<tr>";
                                        echo "<td>{$fila['idTransaccion']}</td>";
                                        echo "<td>{$fila['fechaTransaccion']}</td>";
                                        echo "<td>{$nombreCompleto}</td>";
                                        echo "<td>{$fila['detalle']}</td>";
                                        echo "<td>S/. {$fila['monto']}</td>";
                                        echo "</tr>";

                                        $totalConsumo = $totalConsumo + $fila['monto'];
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>Total</strong></td>
                                        <td>S/. <?php echo $totalConsumo;?></td>
                                    </tr>
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
		<div class="modal fade" id="modalConsumo" tabindex="-1" role="dialog" aria-labelledby="modalConsumo" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Nuevo Consumo</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="container-fluid">
                            <input type="hidden" name="idReserva" value="<?php echo $_POST['idReserva'];?>">
                            <input type="hidden" name="idHabitacion" value="<?php echo $_POST['idHabitacion'];?>">
                            <input type="hidden" name="idHuesped" value="<?php echo $_POST['idHuesped'];?>">
							<div class="form-group row">
								<label class="col-form-label" for="idTransaccion">Transacción:</label>
								<input type="text" class="form-control" name="idTransaccion" id="idTransaccion" value="<?php $idTransaccion = idgen("TRS"); echo $idTransaccion;?>">
							</div>
							<div class="form-group row">
								<label class="col-form-label" for="descripcion">Descripcion:</label>
								<input type="text" class="form-control" name="descripcion" id="descripcion">
							</div>
							<div class="form-group row">
								<label class="col-form-label" for="descuento">Descuento:</label>
								<input type="number" step="0.01" min="0" max="100" class="form-control" name="descuento" id="descuento">
							</div>
							<div class="form-group row">
								<label class="col-form-label" for="monto">Monto:</label>
								<input type="number" step="0.01" min="0" class="form-control" name="monto" id="monto">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cerrar">
						<input type="submit" class="btn btn-primary" name="addConsumo" value="Guardar Cambios">
					</div>
				</div>
			</div>
		</div>
	</form>

	<?php
	include('footer.php');
}
?>