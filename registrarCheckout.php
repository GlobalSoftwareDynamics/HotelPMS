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

    if (isset($_POST['addConsumo'])){

        $query = mysqli_query($link,"INSERT INTO Transaccion(idTransaccion,idColaborador,idReserva,idHuesped,idHabitacion,monto,detalle,fechaTransaccion,tipo) VALUES 
        ('{$_POST['idTransaccion']}','{$_SESSION['user']}','{$_POST['idReserva']}','{$_POST['idHuesped']}','{$_POST['idHabitacion']}','{$_POST['monto']}','{$_POST['descripcion']}','{$dateTime}','{$_POST['servicio']}')");

        $queryPerformed = "INSERT INTO Transaccion(idTransaccion,idColaborador,idReserva,idHuesped,idHabitacion,monto,detalle,fechaTransaccion,tipo) VALUES 
        ({$_POST['idTransaccion']},{$_SESSION['user']},{$_POST['idReserva']},{$_POST['idHuesped']},{$_POST['idHabitacion']},{$_POST['monto']},{$_POST['descripcion']},{$dateTime},{$_POST['servicio']})";

        $databaseLog = mysqli_query($link, "INSERT INTO DatabaseLog (idColaborador,fechaHora,evento,tipo,consulta) VALUES ('{$_SESSION['user']}','{$date}','INSERT','Transaccion','{$queryPerformed}')");

    }

    if (isset($_GET['idReserva'])) {
        $ids = explode("_", $_GET['idReserva']);
        $_POST['idReserva'] = $ids[0];
        $_POST['idHabitacion'] = $ids[1];
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
        $numrow1 = mysqli_num_rows($result1);
        if($numrow1 > 0){
            while ($fila1 = mysqli_fetch_array($result1)){
                $result2 = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped = '{$fila1['idHuesped']}'");
                $numrow = mysqli_num_rows($result2);
                if ($numrow > 0){
                    while ($fila2 = mysqli_fetch_array($result2)) {
                        if ($fila2['vip'] == 0) {
                            $vip = "<b>(VIP)</b>";
                        }
                        $nombreHuesped = $fila2['nombreCompleto'];
                        $idHuesped = $fila2['idHuesped'];
                        if ($fila2['idEmpresa'] != null) {
                            $result3 = mysqli_query($link, "SELECT * FROM Empresa WHERE idEmpresa = '{$fila2['idEmpresa']}'");
                            while ($fila3 = mysqli_fetch_array($result3)) {
                                $empresa = $fila3['razonSocial'];
                            }
                        } else {
                            $empresa = "Sin Empresa";
                        }
                    }
                }else{
                    $nombreHuesped = "No Definido";
                    $idHuesped = "No Definido";
                    $empresa = "Sin Empresa";
                }
            }
        }else{
            $vip = "";
            $nombreHuesped = "No Definido";
            $idHuesped = "No Definido";
            $empresa = "Sin Empresa";
        }
    }
    ?>
    <script>
        function myFunction() {
            // Declare variables
            var input, input2, input3, filter, filter2, filter3, table, tr, td, td2, td3, i;
            input = document.getElementById("tipo");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[4];
                if ((td)) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

    <section class="container">
        <div class="row">
            <div class="col-8">
                <div class="card mb-3">
                    <div class="card-header checkout">
                        <i class="fa fa-table"></i> Listado de Consumos
                        <div class="float-right">
                            <form method="post">
                                <input type="hidden" name="idReserva" value="<?php echo $_POST['idReserva']?>">
                                <input type="hidden" name="idHabitacion" value="<?php echo $_POST['idHabitacion']?>">
                                <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#modalConsumo">Nuevo Consumo</button>
                                <input type="submit" class="btn btn-sm btn-light" formaction="registroCheckoutPDF.php" value="Descargar PDF">
                                <input type="submit" class="btn btn-sm btn-light" formaction="mainRecepcion.php" value="Regresar">
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <div class="row">
                                    <div class="col-4"><p><b>Reserva:</b></p></div>
                                    <div class="col-8"><p><?php echo $_POST['idReserva'];?></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-4"><p><b>Habitación:</b></p></div>
                                    <div class="col-8"><p><?php echo $_POST['idHabitacion'];?></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-4"><p><b>Huesped Titular:</b></p></div>
                                    <div class="col-8"><p><?php echo $nombreHuesped." ".$vip;?></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-4"><p><b>Empresa:</b></p></div>
                                    <div class="col-8"><p><?php echo $empresa?></p></div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="row">
                                    <div class="col-4"><p><b>Check In:</b></p></div>
                                    <div class="col-8"><p><?php echo $fechaCheckIn;?></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-4"><p><b>Check Out:</b></p></div>
                                    <div class="col-8"><p><?php echo $fechaCheckOut?></p></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <form class="form-inline justify-content-center" method="post" action="#">
                                    <label class="sr-only" for="tipo">Tipo Consumo</label>
                                    <input type="text" class="form-control mt-2 mb-2 mr-2" id="tipo" placeholder="Tipo Consumo" onkeyup="myFunction()">
                                    <input type="submit" class="btn btn-primary" value="Limpiar" style="padding-left:28px; padding-right: 28px;">
                                </form>
                            </div>
                            <div class="col-12">
                                <table class="table text-center" id="myTable">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Transacción</th>
                                        <th class="text-center">Fecha y Hora</th>
                                        <th class="text-center">Huesped</th>
                                        <th class="text-center">Descripción</th>
                                        <th class="text-center">Tipo</th>
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
                                        echo "<td>{$fila['tipo']}</td>";
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
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header checkout">
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
                                    $cargoExtra = 0;
                                    $result = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");
                                    while ($fila = mysqli_fetch_array($result)){
                                        $fechaInicio = explode(" ",$fila['fechaInicio']);
                                        $fechaInicio = explode("-",$fechaInicio[0]);
                                        $date1 = date_create("{$fechaInicio[0]}-{$fechaInicio[1]}-{$fechaInicio[2]}");
                                        $fechaFin = explode(" ",date("Y-m-d H:m:s"));
                                        $fechaFinHora = $fechaFin[1];
                                        $fechaFin = explode("-",$fechaFin[0]);
                                        $date2 = date_create("{$fechaFin[0]}-{$fechaFin[1]}-{$fechaFin[2]}");
                                        $interval = date_diff($date1,$date2);
                                        $interval = $interval->d;
                                        if($date1 == $date2){
                                            $interval = $interval +1;
                                        }
                                        $result1 = mysqli_query($link,"SELECT * FROM Tarifa WHERE idTarifa = '{$fila['idTarifa']}'");
                                        while ($fila1 = mysqli_fetch_array($result1)){
                                            $valorTarifa = $fila1['valor'];
                                        }
                                        $lateCheckOutTime = date("12:00:00");
                                        if ($fechaFinHora > $lateCheckOutTime || $fila['modificadorCheckIO'] == 2 || $fila['modificadorCheckIO'] == 1){
                                            $cargoExtra = $valorTarifa / 2;
                                        }elseif ($fila['modificadorCheckIO'] == 3){
                                            $cargoExtra = $valorTarifa;
                                        }
                                        $totalhabitaciones = $valorTarifa * $interval;
                                    }
                                    $totalHabitacionesPaquete = $totalhabitaciones + $valorPaquete;
                                    $subtotal = $totalHabitacionesPaquete + $totalConsumo + $cargoExtra;
                                    $impestos = ($subtotal / 1.18) * 0.18;
                                    $subtotalSinImpuestos = $subtotal - $impestos;
                                    $totalEstadia = $subtotalSinImpuestos + $impestos;
                                    ?>
                                    <tr>
                                        <th>Total Habitación:</th>
                                        <td>S/. <?php echo round($totalhabitaciones,2);?></td>
                                    </tr>
                                    <tr>
                                        <th>Total Paquete:</th>
                                        <td>S/. <?php echo round($valorPaquete,2);?></td>
                                    </tr>
                                    <tr>
                                        <th>Total Consumos:</th>
                                        <td>S/. <?php echo round($totalConsumo,2);?></td>
                                    </tr>
                                    <tr>
                                        <th>Impuestos:</th>
                                        <td>S/. <?php echo round($impestos,2);?></td>
                                    </tr>
                                    <tr>
                                        <th>Cargos:</th>
                                        <td>S/. <?php echo round($cargoExtra,2);?></td>
                                    </tr>
                                    <tr>
                                        <th>Total a Pagar:</th>
                                        <td id="totalPago">S/. <?php echo round($totalEstadia,2);?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header checkout">
                        <i class="fa fa-table"></i> Check Out
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
                                    <div class="form-group row">
                                        <label class="col-form-label col-6" for="montoCancelado">Monto Cancelado:</label>
                                        <div class="col-6" id="montoPorCancelar">
                                            <input type="number" min="0" max="<?php echo round($totalEstadia,2);?>" class="form-control" step="0.01" name="montoCancelado" id="montoCancelado" value="<?php echo round($totalEstadia,2);?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-6" for="liberarHabitacion">Liberar Habitación:</label>
                                        <div class="col-6">
                                            <input type="checkbox" name="liberarHabitacion" id="liberarHabitacion" style="margin-top: 8%;">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-6" for="emailSpam">Enviar Correo:</label>
                                        <div class="col-6">
                                            <input type="checkbox" name="emailSpam" id="emailSpam" style="margin-top: 8%;">
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
        <div class="modal fade" id="modalConsumo" tabindex="-1" role="dialog" aria-labelledby="modalConsumo" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header checkoutConsumos">
                        <h5 class="modal-title">Nuevo Consumo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <input type="hidden" name="idReserva" value="<?php echo $_POST['idReserva'];?>">
                            <input type="hidden" name="idHabitacion" value="<?php echo $_POST['idHabitacion'];?>">
                            <div class="form-group row">
                                <label class="col-form-label" for="idTransaccion">Transacción:</label>
                                <input required type="text" class="form-control" name="idTransaccion" id="idTransaccion" value="<?php $idTransaccion = idgen("TRS"); echo $idTransaccion;?>">
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label" for="idHuesped">Huesped:</label>
                                <select class="form-control" name="idHuesped" id="idHuesped" required>
                                    <option disabled selected>Seleccionar</option>
                                    <?php
                                    $result1 = mysqli_query($link,"SELECT * FROM Ocupantes WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");
                                    while ($fila1 = mysqli_fetch_array($result1)){
                                        $result2 = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped = '{$fila1['idHuesped']}'");
                                        while ($fila2 = mysqli_fetch_array($result2)){
                                            echo "<option value='{$fila2['idHuesped']}'>{$fila2['nombreCompleto']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label" for="servicio">Servicio:</label>
                                <select class="form-control" name="servicio" id="servicio" required>
                                    <option disabled selected>Seleccionar</option>
                                    <option>Lavandería</option>
                                    <option>Cafetería</option>
                                    <option>Telefax</option>
                                    <option>Otros</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label" for="descripcion">Descripcion:</label>
                                <input type="text" class="form-control" name="descripcion" id="descripcion" required>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label" for="monto">Monto:</label>
                                <input type="number" step="0.01" min="0" class="form-control" name="monto" id="monto" required>
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