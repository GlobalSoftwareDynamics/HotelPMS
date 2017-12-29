<?php
include('session.php');
include('declaracionFechas.php');
include('funciones.php');
if(isset($_SESSION['login'])){
    include('header.php');
    include('navbarRecepcion.php');

    $result = mysqli_query($link,"SELECT * FROM Paquete WHERE idPaquete = '{$_POST['idPaquete']}'");
    while($row = mysqli_fetch_array($result)) {
        $nombre = $row['nombre'];
        $descripcion = explode("Incluye: ",$row['descripcion']);
        $duracion = $row['duracion'];
        $valorAdicionales = $row['valor'];
        $simboloMoneda = $row['moneda']
        ?>

        <section class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header card-inverse card-info">
                            <form method="post" action="gestionPaquetes.php" id="form">
                                <div class="float-left">
                                    <i class="fa fa-shopping-bag"></i>
                                    Detalle de Paquete
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
                                    <div class="col-3"><p><b>Nombre:</b></p></div>
                                    <div class="col-9"><p><?php echo $nombre;?></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-3"><p><b>Nro. de Noches:</b></p></div>
                                    <div class="col-9"><p><?php echo $duracion;?></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-3"><p><b>Adicionales:</b></p></div>
                                    <div class="col-9"><p><?php echo $descripcion[1];?></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-3"><p><b>Costo Adicionales:</b></p></div>
                                    <div class="col-9"><p><?php echo $simboloMoneda." ".$valorAdicionales;?></p></div>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header card-inverse card-info">
                            <div class="float-left">
                                <i class="fa fa-bed"></i>
                                Habitaciones
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="col-12">
                                <table class="table text-center">
                                    <thead>
                                    <tr>
                                        <th>Habitación</th>
                                        <th>Cantidad</th>
                                        <th>Tarifa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $result1 = mysqli_query($link,"SELECT * FROM TipoHabitacionPaquete WHERE idPaquete = '{$row['idPaquete']}'");
                                    while ($fila = mysqli_fetch_array($result1)){
                                        $result2 = mysqli_query($link,"SELECT * FROM TipoHabitacion WHERE idTipoHabitacion = '{$fila['idTipoHabitacion']}'");
                                        while ($fila1 = mysqli_fetch_array($result2)){
                                            $tipoHabitacion = $fila1['descripcion'];
                                        }
                                        $result2 = mysqli_query($link,"SELECT * FROM Tarifa WHERE idTarifa = '{$fila['idTarifa']}'");
                                        while ($fila1 = mysqli_fetch_array($result2)){
                                            $valorTarifa = $fila1['valor'];
                                            $simboloMoneda = $fila1['moneda'];
                                        }
                                        echo "<tr>";
                                        echo "<td>{$tipoHabitacion}</td>";
                                        echo "<td>{$fila['nroHabitaciones']}</td>";
                                        echo "<td>{$simboloMoneda} {$valorTarifa}</td>";
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
