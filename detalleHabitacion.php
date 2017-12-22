<?php
include('declaracionFechas.php');
include('funciones.php');
/*if(isset($_SESSION['login'])){*/
    include('header.php');
    include('navbarRecepcion.php');

    /*$result = mysqli_query($link,"SELECT * FROM Proveedor WHERE idProveedor = '{$_POST['idProveedor']}'");
    while($row = mysqli_fetch_array($result)) {
        $result1 = mysqli_query($link,"SELECT * FROM Direccion WHERE idDireccion = '{$row['idDireccion']}'");
        while ($fila = mysqli_fetch_array($result1)){
            $direccion = $fila['direccion'];
            $result2 = mysqli_query($link,"SELECT * FROM Ciudad WHERE idCiudad = '{$fila['idCiudad']}'");
            while ($fila1 = mysqli_fetch_array($result2)){
                $ciudad = $fila1['nombre'];
                $result3 = mysqli_query($link,"SELECT * FROM Pais WHERE idPais = '{$fila1['idPais']}'");
                while ($fila2 = mysqli_fetch_array($result3)){
                    $pais = $fila2['pais'];
                }
            }
        }*/
        ?>

        <section class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header card-inverse card-info">
                            <form method="post" action="gestionHabitaciones.php" id="form">
                                <div class="float-left">
                                    <i class="fa fa-bed"></i>
                                    Detalle de Habitación
                                </div>
                                <div class="float-right">
                                    <div class="dropdown">
                                        <input type='submit' value='Regresar' name='regresar' class='btn btn-light btn-sm'>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-block">
                            <div class="col-12">
                                <div class="spacer15"></div>
                                <div class="row">
                                    <div class="col-3"><p><b>Nro Habitación:</b></p></div>
                                    <div class="col-9"><p>303</p></div>
                                </div>
                                <div class="row">
                                    <div class="col-3"><p><b>Tipo:</b></p></div>
                                    <div class="col-9"><p>Matrimonial</p></div>
                                </div>
                                <div class="row">
                                    <div class="col-3"><p><b>Vista:</b></p></div>
                                    <div class="col-9"><p>Jardines</p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="spacer15"></div>
        <section class="container">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header card-inverse card-info">
                            <div class="float-left">
                                <i class="fa fa-info-circle"></i>
                                Características
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="col-12">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th>Capacidad:</th>
                                        <td>4</td>
                                    </tr>
                                    <tr>
                                        <th>Nro. Camas:</th>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <th>Tipo de Cama:</th>
                                        <td>King Size</td>
                                    </tr>
                                    <tr>
                                        <th>Jacuzzi:</th>
                                        <td>Si</td>
                                    </tr>
                                    <tr>
                                        <th>Sala:</th>
                                        <td>Si</td>
                                    </tr>
                                    <tr>
                                        <th>Balcón:</th>
                                        <td>Si</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header card-inverse card-info">
                            <div class="float-left">
                                <i class="fa fa-money"></i>
                                Tarifas
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="col-12">
                                <table class="table text-center">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Descripción</th>
                                        <th class="text-center">Costo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Regular</td>
                                        <td>$ 120.00</td>
                                    </tr>
                                    <tr>
                                        <td>Temp. Alta</td>
                                        <td>$ 180.00</td>
                                    </tr>
                                    <tr>
                                        <td>Temp. Baja</td>
                                        <td>$ 100.00</td>
                                    </tr>
                                    <tr>
                                        <td>Noche de Bodas</td>
                                        <td>$ 80.00</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    /*}*/
    include('footer.php');
/*}*/
?>
