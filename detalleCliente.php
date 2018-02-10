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

    $result = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped = '{$_POST['idHuesped']}'");
    while ($fila = mysqli_fetch_array($result)){
        if($fila['idCiudad'] == ''){
            $ciudad = "";
            $estado = "";
            $pais = "";
        }else{
            $result1 = mysqli_query($link,"SELECT * FROM Ciudad WHERE idCiudad = '{$fila['idCiudad']}'");
            while ($fila1 = mysqli_fetch_array($result1)){
                $ciudad = $fila1['nombre'];
                $idCiudad = $fila1['idCiudad'];
                $result2 = mysqli_query($link,"SELECT * FROM EstadoPais WHERE idEstadoPais = '{$fila1['idEstadoPais']}'");
                while ($fila2 =  mysqli_fetch_array($result2)){
                    $estado = $fila2['nombre'];
                    $idEstado = $fila2['idEstadoPais'];
                    $result3 = mysqli_query($link,"SELECT * FROM Pais WHERE idPais = '{$fila2['idPais']}'");
                    while ($fila3 =  mysqli_fetch_array($result3)){
                        $pais = $fila3['nombre'];
                        $idPais = $fila3['idPais'];
                    }
                }
            }
        }
        $result1 = mysqli_query($link,"SELECT * FROM Empresa WHERE idEmpresa = '{$fila['idEmpresa']}'");
        $numrows = mysqli_num_rows($result1);
        if($numrows == 0){
            $empresa = "Sin Empresa";
            $idEmpresa = "Sin Empresa";
        }else{
            while ($fila1 = mysqli_fetch_array($result1)){
                $empresa = $fila1['razonSocial'];
                $idEmpresa = $fila['idEmpresa'];
            }
        }
        ?>

        <section class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header formularios card-inverse card-info">
                            <form method="post" action="gestionClientes.php" id="form">
                                <div class="float-left">
                                    <i class="fa fa-user"></i>
                                    Detalle de Cliente
                                </div>
                                <div class="float-right">
                                    <div class="dropdown">
                                        <input type='submit' value='Regresar' name='regresar' class='btn btn-light btn-sm'>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="spacer15"></div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-4"><p><b>DNI:</b></p></div>
                                        <div class="col-8"><p><?php echo $_POST['idHuesped']?></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4"><p><b>Nombre Completo:</b></p></div>
                                        <div class="col-8"><p><?php echo $fila['nombreCompleto']?></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4"><p><b>Género:</b></p></div>
                                        <div class="col-8"><p><?php echo $fila['idGenero']?></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4"><p><b>Fecha de Nacimiento:</b></p></div>
                                        <div class="col-8"><p><?php echo $fila['fechaNacimiento']?></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4"><p><b>Empresa:</b></p></div>
                                        <div class="col-8"><p><?php echo $empresa?></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4"><p><b>Email:</b></p></div>
                                        <div class="col-8"><p><?php echo $fila['correoElectronico']?></p></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-3"><p><b>Teléfono Celular:</b></p></div>
                                        <div class="col-9"><p><?php echo $fila['telefonoCelular']?></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3"><p><b>Teléfono Fijo:</b></p></div>
                                        <div class="col-9"><p><?php echo $fila['telefonoFijo']?></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3"><p><b>Dirección:</b></p></div>
                                        <div class="col-9"><p><?php echo $fila['direccion']?></p></div>
                                        <div class="col-9 offset-3"><p><?php echo $ciudad.", ".$pais?></p></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-left"><p><b>Preferencias:</b></p></div>
                                    <div style="border: 1px solid lightgrey; height: 100px"><p style="padding-left: 10px"><?php echo $fila['preferencias']?></p></div>
                                </div>
                                <div class="spacer10"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="spacer15"></div>
        <section class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header formularios card-inverse card-info">
                            <div class="float-left">
                                <i class="fa fa-bed"></i>
                                Historial de Reservas
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="col-12">
                                <table class="table text-center">
                                    <thead>
                                    <tr>
                                        <th>IDReserva</th>
                                        <th>Fecha</th>
                                        <th>Habitación</th>
                                        <th>Nro de Noches</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $result1 = mysqli_query($link,"SELECT * FROM Ocupantes WHERE idReserva IN (SELECT idReserva FROM Reserva ORDER BY fechaReserva DESC) AND idHuesped = '{$_POST['idHuesped']}'");
                                    while ($fila1 = mysqli_fetch_array($result1)){
                                        $result2 = mysqli_query($link,"SELECT * FROM Reserva WHERE idReserva = '{$fila1['idReserva']}'");
                                        while ($fila2 = mysqli_fetch_array($result2)){
                                            $fecha = $fila2['fechaReserva'];
                                        }
                                        $result2 = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE idReserva = '{$fila1['idReserva']}' AND idHabitacion = '{$fila1['idHabitacion']}'");
                                        while ($fila2 = mysqli_fetch_array($result2)){
                                            $estadia = $fila2['fechaFin']-$fila2['fechaInicio'];
                                        }
                                        echo "<tr>";
                                        echo "<td>{$fila1['idReserva']}</td>";
                                        echo "<td>{$fecha}</td>";
                                        echo "<td>{$fila1['idHabitacion']}</td>";
                                        echo "<td>{$estadia}</td>";
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
        </section>

        <?php
    }
    include('footer.php');
}
?>
