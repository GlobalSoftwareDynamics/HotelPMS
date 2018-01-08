<?php
include('session.php');
include('declaracionFechas.php');
include('funciones.php');
if(isset($_SESSION['login'])){
    include('header.php');
    include('navbarRecepcion.php');

    if (isset($_POST['addFechaFin'])){

        $query = mysqli_query($link,"UPDATE HabitacionReservada SET fechaFin = '{$_POST['fechaFin']}' WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");

        $queryPerformed = "UPDATE HabitacionReservada SET fechaFin = {$_POST['fechaFin']} WHERE idReserva = {$_POST['idReserva']} AND idHabitacion = {$_POST['idHabitacion']}";

        $databaseLog = mysqli_query($link, "INSERT INTO DatabaseLog (idColaborador,fechaHora,evento,tipo,consulta) VALUES ('{$_SESSION['user']}','{$date}','UPDATE','HabitacionReservada','{$queryPerformed}')");

    }
    ?>

    <?php
    $duracionPaquete = 0;
    $valorPaquete = 0;
    $result = mysqli_query($link,"SELECT * FROM Reserva WHERE idReserva = '{$_POST['idReserva']}'");
    while ($fila = mysqli_fetch_array($result)){
        $result1 = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");
        while ($fila1 = mysqli_fetch_array($result1)){
            $fechaCheckIn = $fila1['fechaInicio'];
            $fechaCheckOut = $fila1['fechaFin'];
        }
        $result1 =  mysqli_query($link,"SELECT * FROM ReservaPaquete WHERE idReserva = '{$_POST['idReserva']}'");
        $numrow = mysqli_num_rows($result1);
        if ($numrow == 0){

        }else{
            while ($fila1 =  mysqli_fetch_array($result1)){
                $result2 = mysqli_query($link,"SELECT * FROM Paquete WHERE idPaquete = '{$fila1['idPaquete']}'");
                while ($fila2 = mysqli_fetch_array($result2)){
                    $duracionPaquete = $fila2['duracion'];
                    $valorPaquete = $fila2['valor'];
                    $totalhabitaciones = 0;
                    $result3 = mysqli_query($link,"SELECT * FROM TipoHabitacionPaquete WHERE idPaquete = '{$fila2['idPaquete']}'");
                    $numFilas = mysqli_num_rows($result3);
                    if($numFilas == 0){
                        $totalhabitaciones = 0;
                    }else{
                        while ($fila3 = mysqli_fetch_array($result1)){
                            $result4 = mysqli_query($link,"SELECT * FROM Tarifa WHERE idTarifa = '{$fila3['idTarifa']}'");
                            while ($fila4 = mysqli_fetch_array($result4)){
                                $valorTarifa = $fila4['valor'];
                            }

                            $valorHabitacion  = $fila3['nroHabitaciones'] * $valorTarifa;
                            $totalhabitaciones = $totalhabitaciones + $valorHabitacion;

                        }
                    }

                    $totalpaquete = ($totalhabitaciones * $fila2['duracion']) + $fila2['valor'];
                }
            }
        }
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
            <div class="col-7">
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
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-5"><p><b>Reserva:</b></p></div>
                                    <div class="col-7"><p><?php echo $_POST['idReserva'];?></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-5"><p><b>Habitación:</b></p></div>
                                    <div class="col-7"><p><?php echo $_POST['idHabitacion'];?></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-5"><p><b>Huesped Titular:</b></p></div>
                                    <div class="col-7"><p><?php echo $nombreCompleto?></p></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-5"><p><b>Check In:</b></p></div>
                                    <div class="col-7"><p><?php echo $fechaCheckIn;?></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-5"><p><b>Check Out:</b></p></div>
                                    <div class="col-7"><p><?php echo $fechaCheckOut?></p></div>
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
            <div class="col-5">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i> Balance de la Reserva
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table text-center">
                                    <tbody>
                                    <?php
                                    $totalhabitaciones = 0;
                                    $subtotal = 0;
                                    $impestos = 0;
                                    $totalEstadia = 0;
                                    $result = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");
                                    while ($fila = mysqli_fetch_array($result)){
                                        $fechaInicio = explode(" ",$fila['fechaInicio']);
                                        $fechaInicio = explode("-",$fechaInicio[0]);
                                        $date1 = date_create("{$fechaInicio[0]}-{$fechaInicio[1]}-{$fechaInicio[2]}");
                                        $fechaFin = date("Y-m-d");
                                        $fechaFin = explode("-",$fechaFin);
                                        $date2 = date_create("{$fechaFin[0]}-{$fechaFin[1]}-{$fechaFin[2]}");
                                        $interval = date_diff($date1,$date2);
                                        $interval = $interval->d;
                                        $result1 = mysqli_query($link,"SELECT * FROM Tarifa WHERE idTarifa = '{$fila['idTarifa']}'");
                                        while ($fila1 = mysqli_fetch_array($result1)){
                                            $valorTarifa = $fila1['valor'];
                                        }
                                        $totalhabitaciones = $valorTarifa * $interval;
                                    }
                                    $totalhabitaciones = $totalhabitaciones + $valorPaquete;
                                    $subtotal = $totalhabitaciones + $totalConsumo;
                                    $impestos = $subtotal * 0.18;
                                    $totalEstadia = $subtotal + $impestos;
                                    ?>
                                    <tr>
                                        <th>Total Habitación:</th>
                                        <td>S/. <?php echo round($totalhabitaciones,2);?></td>
                                    </tr>
                                    <tr>
                                        <th>Total Consumos:</th>
                                        <td>S/. <?php echo round($totalConsumo,2);?></td>
                                    </tr>
                                    <tr>
                                        <th>SubTotal:</th>
                                        <td>S/. <?php echo round($subtotal,2);?></td>
                                    </tr>
                                    <tr>
                                        <th>Impuestos:</th>
                                        <td>S/. <?php echo round($impestos,2);?></td>
                                    </tr>
                                    <tr>
                                        <th>Total a Pagar:</th>
                                        <td>S/. <?php echo round($totalEstadia,2);?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i> Registro de Check Out
                        <div class="float-right">
                            <input type="submit" class="btn btn-sm btn-light" form="formCheckOut" formaction="agenda.php" name="checkOut" value="Registrar Check Out">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form method="post" id="formCheckOut">
                                    <input type="hidden" name="idReserva" value="<?php echo $_POST['idReserva'];?>">
                                    <input type="hidden" name="idHabitacion" value="<?php echo $_POST['idHabitacion'];?>">
                                    <input type="hidden" name="idHuesped" value="<?php echo $_POST['idHuesped'];?>">
                                    <input type="hidden" name="montoHabitacionReserva" value="<?php echo round($totalEstadia,2);?>">
                                    <div class="form-group row">
                                        <label class="col-form-label col-4" for="montoCancelado">Monto Cancelado:</label>
                                        <div class="col-8">
                                            <input type="number" min="0" max="<?php echo round($totalEstadia,2);?>" class="form-control" step="0.01" name="montoCancelado" id="montoCancelado" value="<?php echo round($totalEstadia,2);?>">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <form method="post" action="#">
        <div class="modal fade" id="modalFechaNueva" tabindex="-1" role="dialog" aria-labelledby="modalFechaNueva" aria-hidden="true">
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
                                <label class="col-form-label" for="fechaFin">Fecha Check Out:</label>
                                <input type="date" class="form-control" name="fechaFin" id="fechaFin">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cerrar">
                        <input type="submit" class="btn btn-primary" name="addFechaFin" value="Guardar Cambios">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php
    include('footer.php');
}
?>