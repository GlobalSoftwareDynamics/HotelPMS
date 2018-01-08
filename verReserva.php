<?php
include('session.php');
include('declaracionFechas.php');
include('funciones.php');
if(isset($_SESSION['login'])){
    include('header.php');
    include('navbarRecepcion.php');
    ?>

    <?php
    $result = mysqli_query($link,"SELECT * FROM Reserva WHERE idReserva = '{$_POST['idReserva']}'");
    while ($fila = mysqli_fetch_array($result)){
        $result1 = mysqli_query($link,"SELECT * FROM Estado WHERE idEstado = '{$fila['idEstado']}'");
        while ($fila1 = mysqli_fetch_array($result1)){
            $estado = $fila1['descripcion'];
        }
        if ($fila['idEstado'] == 9){
            ?>
            <section class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table"></i> Detalles de la Reserva
                                <div class="float-right">
                                    <form method="post" id="confirmar">
                                        <input type="hidden" name="idReserva" value="<?php echo $_POST['idReserva'];?>">
                                        <input form="confirmar" type="submit" class="btn btn-sm btn-light" formaction="nuevaReserva.php" value="Confirmar Reserva" name="confirmaReserva">
                                        <input type="submit" class="btn btn-sm btn-light" formaction="mainRecepcion.php" value="Regresar">
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-2"><p><b>Reserva:</b></p></div>
                                            <div class="col-7"><p><?php echo $_POST['idReserva'];?></p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2"><p><b>Fecha:</b></p></div>
                                            <div class="col-7"><p><?php echo $fila['fechaReserva'];?></p></div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-2"><p><b>Estado:</b></p></div>
                                            <div class="col-7"><p><?php echo $estado;?></p></div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <h6><strong>Habitaciones Reservadas</strong></h6>
                                    </div>
                                    <div class="spacer10"></div>
                                    <div class="col-12 text-center">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Tipo de Habitación</th>
                                                <th>Nro. de Habitaciones</th>
                                                <th>Fecha Inicio</th>
                                                <th>Fecha Fin</th>
                                                <th>Preferencias</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $result1 = mysqli_query($link,"SELECT * FROM ReservaPendiente WHERE idReserva = '{$_POST['idReserva']}'");
                                            while ($fila1 = mysqli_fetch_array($result1)){
                                                $result2 = mysqli_query($link,"SELECT * FROM TipoHabitacion WHERE idTipoHabitacion = '{$fila1['idTipoHabitacion']}'");
                                                while ($fila2 = mysqli_fetch_array($result2)){
                                                    $tipoHabitacion = $fila2['descripcion'];
                                                }
                                                $result2 = mysqli_query($link,"SELECT * FROM Tarifa WHERE idTarifa = '{$fila1['idTarifa']}'");
                                                while ($fila2 = mysqli_fetch_array($result2)){
                                                    $tarifa = $fila2['descripcion']."-".$fila2['valor'];
                                                }
                                                echo "<tr>";
                                                echo "<td>{$tipoHabitacion}</td>";
                                                echo "<td>{$fila1['numeroHabitaciones']}</td>";
                                                echo "<td>{$fila1['fechaInicio']}</td>";
                                                echo "<td>{$fila1['fechaFin']}</td>";
                                                echo "<td>{$fila1['preferencias']}</td>";
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
        }else{
            $queryHuesped = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped = {$_POST['idHuesped']}");
            while($rowHuesped = mysqli_fetch_array($queryHuesped)){
                $idHuesped = $rowHuesped['idHuesped'];
                $nombreHuesped = $rowHuesped['nombreCompleto'];
                $telefonoHuesped = $rowHuesped['telefonoCelular'];
                $emailHuesped = $rowHuesped['correoElectronico'];
            }
            ?>
            <section class="container">
                <div class="row">
                    <div class="col-7">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table"></i> Detalle de la Reserva
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="row">
                                            <div class="col-5"><p><b>Reserva:</b></p></div>
                                            <div class="col-7"><p><?php echo $_POST['idReserva'];?></p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5"><p><b>Fecha:</b></p></div>
                                            <div class="col-7"><p><?php echo $fila['fechaReserva'];?></p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5"><p><b>Estado:</b></p></div>
                                            <div class="col-7"><p><?php echo $estado;?></p></div>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="row">
                                            <div class="col-5"><p><b>DNI:</b></p></div>
                                            <div class="col-7"><p><?php echo $idHuesped;?></p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5"><p><b>Nombre:</b></p></div>
                                            <div class="col-7"><p><?php echo $nombreHuesped;?></p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5"><p><b>Correo Electrónico:</b></p></div>
                                            <div class="col-7"><p><?php echo $emailHuesped;?></p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5"><p><b>Teléfono:</b></p></div>
                                            <div class="col-7"><p><?php echo $telefonoHuesped;?></p></div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="text-center"><strong>Paquetes Escogidos</strong></p>
                                        <table class="table text-center">
                                            <thead>
                                            <tr>
                                                <th>Paquete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $result1 = mysqli_query($link,"SELECT * FROM ReservaPaquete WHERE idReserva = '{$_POST['idReserva']}'");
                                            while ($fila1 = mysqli_fetch_array($result1)){
                                                $result2 = mysqli_query($link,"SELECT * FROM Paquete WHERE idPaquete = '{$fila1['idPaquete']}'");
                                                while ($fila2 = mysqli_fetch_array($result2)){
                                                    echo "<tr>";
                                                    echo "<td>{$fila2['nombre']}</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-6">
                                        <p class="text-center"><strong>Balance de la Reserva</strong></p>
                                        <table class="table text-center">
                                            <tbody>
                                            <?php
                                            $valorPaquete = 0;
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
                                            $totalConsumo = 0;
                                            $result1 = mysqli_query($link,"SELECT * FROM Transaccion WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");
                                            while ($fila1 = mysqli_fetch_array($result1)){
                                                $totalConsumo = $totalConsumo + $fila1['monto'];
                                            }
                                            $totalhabitaciones = 0;
                                            $subtotal = 0;
                                            $impestos = 0;
                                            $totalEstadia = 0;
                                            $totalHabitacion = 0;
                                            $result1 = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE idReserva = '{$_POST['idReserva']}'");
                                            while ($fila1 = mysqli_fetch_array($result1)){
                                                $fechaInicio = explode(" ",$fila1['fechaInicio']);
                                                $fechaInicio = explode("-",$fechaInicio[0]);
                                                $date1 = date_create("{$fechaInicio[0]}-{$fechaInicio[1]}-{$fechaInicio[2]}");
                                                $fechaFin = explode(" ",$fila1['fechaFin']);
                                                $fechaFin = explode("-",$fechaFin[0]);
                                                $date2 = date_create("{$fechaFin[0]}-{$fechaFin[1]}-{$fechaFin[2]}");
                                                $interval = date_diff($date1,$date2);
                                                $interval = $interval->d;
                                                $result2 = mysqli_query($link,"SELECT * FROM Tarifa WHERE idTarifa = '{$fila1['idTarifa']}'");
                                                while ($fila2 = mysqli_fetch_array($result2)){
                                                    $valorTarifa = $fila2['valor'];
                                                }
                                                $totalHabitacion = $totalHabitacion + ($valorTarifa * $interval);
                                            }
                                            $totalhabitaciones = $totalHabitacion + $valorPaquete;
                                            $subtotal = $totalhabitaciones + $totalConsumo;
                                            $impestos = $subtotal * 0.18;
                                            $totalEstadia = $subtotal + $impestos;
                                            ?>
                                            <tr>
                                                <th>Total Habitación:</th>
                                                <td>S/. <?php echo $totalhabitaciones;?></td>
                                            </tr>
                                            <tr>
                                                <th>Total Consumos:</th>
                                                <td>S/. <?php echo $totalConsumo;?></td>
                                            </tr>
                                            <tr>
                                                <th>SubTotal:</th>
                                                <td>S/. <?php echo $subtotal;?></td>
                                            </tr>
                                            <tr>
                                                <th>Impuestos:</th>
                                                <td>S/. <?php echo $impestos;?></td>
                                            </tr>
                                            <tr>
                                                <th>Total a Pagar:</th>
                                                <td>S/. <?php echo $totalEstadia;?></td>
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
                                <i class="fa fa-table"></i> Detalle de Recojo</div>
                            <div class="card-body">
                                <?php
                                $result1 = mysqli_query($link,"SELECT * FROM Recojo WHERE idReserva = '{$_POST['idReserva']}'");
                                $numrow = mysqli_num_rows($result1);
                                if ($numrow == 0){
                                    echo "<div class='col-12'><p class='text-center'>No se ha especificado información de recojo de huespedes.</p></div>";
                                }else{
                                ?>
                                <ul class="nav nav-tabs" role="tablist">
                                    <?php
                                    for($i = 0; $i < $numrow; $i++){
                                        if($i == 0){
                                            $estadoActivo = "active";
                                        }else{
                                            $estadoActivo = "";
                                        }
                                        ?>
                                        <li class="nav-item">
                                            <a class="nav-link <?php echo $estadoActivo;?>" data-toggle="tab" href="#recojo<?php echo $i;?>" role="tab"><?php echo $i?></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                <div class="spacer10"></div>
                                <div class="tab-content">
                                    <?php
                                    $aux1 = 0;
                                    while ($fila2 = mysqli_fetch_array($result1)){
                                        if($aux1 == 0){
                                            $estadoActivo = "active";
                                        }else{
                                            $estadoActivo = "";
                                        }
                                        ?>
                                        <div class="tab-pane <?php echo $estadoActivo;?>" id="recojo<?php echo $aux1;?>" role="tabpanel">
                                            <div class="row">
                                                <div class="col-4"><p><b>Fecha y Hora:</b></p></div>
                                                <div class="col-8"><p><?php echo $fila2['fechaHora'];?></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4"><p><b>Lugar:</b></p></div>
                                                <div class="col-8"><p><?php echo $fila2['lugarRecojo'];?></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4"><p><b>Nro. Personas:</b></p></div>
                                                <div class="col-8"><p><?php echo $fila2['numPersonas'];?></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4"><p><b>Referente:</b></p></div>
                                                <div class="col-8"><p><?php echo $fila2['personaPrincipal'];?></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4"><p><b>Nro. Ticket:</b></p></div>
                                                <div class="col-8"><p><?php echo $fila2['nroTicket'];?></p></div>
                                            </div>
                                        </div>
                                        <?php
                                        $aux1++;
                                    }
                                    }
                                    ?>
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
                                <i class="fa fa-table"></i> Detalle de Habitaciones</div>
                            <div class="card-body">
                                <?php
                                $result1 = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE idReserva = '{$_POST['idReserva']}'");
                                $result2 = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE idReserva = '{$_POST['idReserva']}'");
                                $numrow = mysqli_num_rows($result1);
                                if ($numrow == 0){
                                    echo "<div class='col-12'><p class='text-center'>No se han seleccionado habitaciones para esta reserva.</p></div>";
                                }else{
                                    ?>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <?php
                                        while ($fila1 = mysqli_fetch_array($result1)){
                                            if($_POST['idHabitacion'] == $fila1['idHabitacion']){
                                                $estadoActivo = "active";
                                            }else{
                                                $estadoActivo = "";
                                            }
                                            ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?php echo $estadoActivo;?>" data-toggle="tab" href="#<?php echo $fila1['idHabitacion'];?>" role="tab"><?php echo $fila1['idHabitacion']?></a>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                    <div class="spacer10"></div>
                                    <div class="tab-content">
                                        <?php
                                        while ($fila2 = mysqli_fetch_array($result2)){
                                            if($_POST['idHabitacion'] == $fila2['idHabitacion']){
                                                $estadoActivo = "active";
                                            }else{
                                                $estadoActivo = "";
                                            }
                                            ?>
                                                <div class="tab-pane <?php echo $estadoActivo;?>" id="<?php echo $fila2['idHabitacion'];?>" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-5">
                                                            <p class="text-center"><strong>Detalles de la Estadía</strong></p>
                                                            <div class="row">
                                                                <div class="col-3"><p><b>Check In:</b></p></div>
                                                                <div class="col-9"><p><?php echo $fila2['fechaInicio'];?></p></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-3"><p><b>Nro. Noches:</b></p></div>
                                                                <div class="col-9"><p><?php echo $interval;?></p></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-3"><p><b>Check Out:</b></p></div>
                                                                <div class="col-9"><p><?php echo $fila2['fechaFin'];?></p></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-3"><p><b>Preferencias:</b></p></div>
                                                                <div class="col-9"><p><?php echo $fila2['preferencias'];?></p></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-7">
                                                            <p class="text-center"><strong>Ocupantes de la Habitación</strong></p>
                                                            <table class="table text-center">
                                                                <thead>
                                                                <tr>
                                                                    <th class="text-center">DNI</th>
                                                                    <th class="text-center">Nombre</th>
                                                                    <th class="text-center">Fecha Nacimiento</th>
                                                                    <th class="text-center">Email</th>
                                                                    <th class="text-center">Cargos</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                $result3 = mysqli_query($link,"SELECT * FROM Ocupantes WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$fila2['idHabitacion']}'");
                                                                while ($fila3 = mysqli_fetch_array($result3)){
                                                                    switch ($fila3['cargos']){
                                                                        case 0:
                                                                            $cargos = "Si";
                                                                            break;
                                                                        case 1:
                                                                            $cargos = "No";
                                                                            break;
                                                                    }
                                                                    $result4 = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped = '{$fila3['idHuesped']}'");
                                                                    while ($fila4 = mysqli_fetch_array($result4)){
                                                                        echo "<tr>";
                                                                        echo "<td>{$fila3['idHuesped']}</td>";
                                                                        echo "<td>{$fila4['nombreCompleto']}</td>";
                                                                        echo "<td>{$fila4['fechaNacimiento']}</td>";
                                                                        echo "<td>{$fila4['correoElectronico']}</td>";
                                                                        echo "<td>{$cargos}</td>";
                                                                        echo "</tr>";
                                                                    }
                                                                }
                                                                ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
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