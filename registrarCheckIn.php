<?php
include('session.php');
include('funciones.php');
include('declaracionFechas.php');
if(isset($_SESSION['login'])){
    include('header.php');
    include('navbarRecepcion.php');

    $result = mysqli_query($link,"SELECT * FROM Reserva WHERE idReserva = '{$_POST['idReserva']}'");
    while ($fila = mysqli_fetch_array($result)){
        $fechaReserva = $fila['fechaReserva'];
    }
    ?>
    <form method="post" id="formCheckIn">
    <section class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-inverse card-info">
                        <div class="float-left mt-1">
                            <i class="fa fa-money"></i>
                            &nbsp;&nbsp;Check In
                        </div>
                        <div class="float-right">
                            <div class="dropdown">
                                <input name="checkIn" type="submit" form="formCheckIn" class="btn btn-light btn-sm" formaction="detalleReserva.php" value="Finalizar Check In">
                                <input name="regresar" type="submit" form="formCheckIn" class="btn btn-light btn-sm" formaction="mainRecepcion.php" value="Regresar">
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="col-12">
                            <div class="spacer20"></div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <div class="col-4"><p><b>Reserva:</b></p></div>
                                    <div class="col-8"><p><?php echo $_POST['idReserva']?></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4"><p><b>Habitación:</b></p></div>
                                    <div class="col-8"><p><?php echo $_POST['idHabitacion']?></p></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4"><p><b>Fecha de Reserva:</b></p></div>
                                    <div class="col-8"><p><?php echo $fechaReserva?></p></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4"><p><b>Preferencias:</b></p></div>
                                    <div class="col-8"><p><?php echo $empresa?></p></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4"><p><b>Nro. Camas Adicionales:</b></p></div>
                                    <div class="col-8"><p><?php echo $fila['correoElectronico']?></p></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <div class="col-3"><p><b>Nombre del Titular:</b></p></div>
                                    <div class="col-9"><p><?php echo $fila['telefonoCelular']?></p></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-3"><p><b>Correo Eléctronico:</b></p></div>
                                    <div class="col-9"><p><?php echo $fila['telefonoFijo']?></p></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-3"><p><b>Teléfono Celular:</b></p></div>
                                    <div class="col-9"><p><?php echo $fila['telefonoFijo']?></p></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-3"><p><b>Teléfono Fijo:</b></p></div>
                                    <div class="col-9"><p><?php echo $fila['telefonoFijo']?></p></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-3"><p><b>Dirección:</b></p></div>
                                    <div class="col-9"><p><?php echo $fila['direccion']?></p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    include('footer.php');
}
?>