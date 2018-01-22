<?php
include('session.php');
include('declaracionFechas.php');
include('funciones.php');
if(isset($_SESSION['login'])){
    include('header.php');
    include('navbarRecepcion.php');

    $result = mysqli_query($link,"SELECT * FROM Habitacion");
    $numHabitaciones = mysqli_num_rows($result);
    ?>

    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
    </script>

    <section class="container">
        <div class="card">
            <div class="card-header card-inverse card-info">
                <i class="fa fa-line-chart"></i>
                Reporte de Gestión
                <div class="float-right">
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <form method="post">
                                <?php
                                if(isset($_POST['idEmpresa'])){
                                    echo "<input type='hidden' name='idEmpresa' value='{$_POST['idEmpresa']}'>";
                                    echo "<input type='hidden' name='fechaInicio' value='{$_POST['fechaInicio']}'>";
                                    echo "<input type='hidden' name='fechaFin' value='{$_POST['fechaFin']}'>";
                                }else{
                                    echo "<input type='hidden' name='fechaInicio' value='{$_POST['fechaInicio']}'>";
                                    echo "<input type='hidden' name='fechaFin' value='{$_POST['fechaFin']}'>";
                                }
                                ?>
                                <input class="dropdown-item" type="submit" name="pdf" formaction="reporteMaquinaPDF.php" value="Descargar PDF">
                            </form>
                        </div>
                    </div>
                </div>
                <span class="float-right">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <span class="float-right">
                    <button href="#collapsed" class="btn btn-light btn-sm" data-toggle="collapse">Mostrar Opciones</button>
                </span>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-12">
                        <div id="collapsed" class="collapse">
                            <form class="form-inline justify-content-center" method="post" action="#">
                                <label class="sr-only" for="idEmpresa">Empresa</label>
                                <input type="text" class="form-control mt-2 mb-2 mr-2" id="idEmpresa" name="idEmpresa" placeholder="Empresa">
                                <label class="sr-only" for="fechaInicio">Fecha Inicio</label>
                                <input type="date" class="form-control mt-2 mb-2 mr-2" id="fechaInicio" name="fechaInicio" data-toggle="popover" data-trigger="focus" title="Fecha de Inicio de Reporte" data-content="Seleccione la fecha inicial para el reporte generado." data-placement="top" required>
                                <label class="sr-only" for="fechaFin">Fecha Fin</label>
                                <input type="date" class="form-control mt-2 mb-2 mr-2" id="fechaFin" name="fechaFin" data-toggle="popover" data-trigger="focus" title="Fecha de Fin de Reporte" data-content="Seleccione la fecha límite para el reporte generado." data-placement="top" required>
                                <input type="submit" class="btn btn-primary" value="Generar" style="padding-left:28px; padding-right: 28px;" name="generarReporte">
                            </form>
                        </div>
                        <div class="spacer10"></div>
                        <div style="width: 100%; border-top: 1px solid lightgrey;"></div>
                    </div>
                </div>
                <div class="spacer20"></div>
                <?php
                if(isset($_POST['generarReporte'])&&$_POST['fechaInicio']>$_POST['fechaFin']){
                    echo "
                        <div class='row'>
                            <div class='col-12'>
                                <p class='text-center'>La Fecha de Inicio de Reporte ingresada es mayor a la Fecha de Fin de Reporte. Por favor seleccione las fechas correctamente e intente de nuevo.</p>
                            </div>
                        </div>
                    ";
                }else{
                    if (isset($_POST['generarReporte'])&&isset($_POST['idEmpresa'])&&$_POST['idEmpresa']!=""){
                        $result = mysqli_query($link,"SELECT * FROM Empresa WHERE razonSocial = '{$_POST['idEmpresa']}'");
                        while ($fila = mysqli_fetch_array($result)){
                            $empresa = $fila['razonSocial'];
                            $idEmpresa = $fila['idEmpresa'];
                        }
                        ?>
                        <div class="row">
                            <div class="col-7">
                                <div class="row">
                                    <div class="col-2">
                                        <p><b>Empresa:</b></p>
                                    </div>
                                    <div class="col-8">
                                        <p><?php echo $empresa;?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="row">
                                    <div class="col-4">
                                        <p><b>Fecha Inicio:</b></p>
                                    </div>
                                    <div class="col-8">
                                        <p><?php echo $_POST['fechaInicio'];?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <p><b>Fecha Fin:</b></p>
                                    </div>
                                    <div class="col-8">
                                        <p><?php echo $_POST['fechaFin'];?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="spacer10"></div>
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-left"><b>Reporte de Ocupación:</b></h6>
                            </div>
                            <div class="spacer10"></div>
                            <div class="col-12" style="height: 400px; overflow-y: auto;">
                                <table class="table text-center">
                                    <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Nro. Huespedes</th>
                                        <th>% Ocupación</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $result = mysqli_query($link,"SELECT * FROM Ocupantes WHERE idHabitacion IN (SELECT idHabitacion FROM HabitacionReservada WHERE fechaInicio >= '{$_POST['fechaInicio']}' AND fechaInicio <= '{$_POST['fechaFin']}') AND idHuesped IN (SELECT idHuesped FROM Huesped WHERE idEmpresa = '{$idEmpresa}')");
                                    while ($fila = mysqli_fetch_array($result)){

                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                    }elseif(isset($_POST['generarReporte'])&&isset($_POST['idEmpresa'])){
                        ?>
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-left"><b>Reporte de Ocupación:</b></h6>
                            </div>
                            <div class="spacer10"></div>
                            <div class="col-12" style="height: 400px; overflow-y: auto;">
                                <table class="table text-center">
                                    <thead>
                                    <tr>
                                        <th>Empresa</th>
                                        <th>Nro. Huespedes</th>
                                        <th>% Ocupación</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $aux = 0;
                                    $totalOcupacion = 0;
                                    $result = mysqli_query($link,"SELECT * FROM Empresa");
                                    while ($fila = mysqli_fetch_array($result)){
                                        $ocupacion = 0;
                                        $result1 = mysqli_query($link,"SELECT COUNT(*) AS cantidad FROM Ocupantes WHERE idHabitacion IN (SELECT idHabitacion FROM HabitacionReservada WHERE fechaInicio >= '{$_POST['fechaInicio']} 00:00:00' AND fechaInicio <= '{$_POST['fechaFin']} 23:59:59') AND idHuesped IN (SELECT idHuesped FROM Huesped WHERE idEmpresa = '{$fila['idEmpresa']}')");
                                        while ($fila1 = mysqli_fetch_array($result1)){
                                            $ocupacion = round(($fila1['cantidad']/$numHabitaciones)*100,2);
                                            $numHuespedes = $fila1['cantidad'];
                                        }
                                        $totalOcupacion += $ocupacion;
                                        $aux++;
                                        echo "<tr>";
                                        echo "<td>{$fila['razonSocial']}</td>";
                                        echo "<td>{$numHuespedes}</td>";
                                        echo "<td>% {$ocupacion}</td>";
                                        echo "</tr>";
                                    }

                                    $totalOcupacion = round($totalOcupacion / $aux,2);

                                    echo "<tr>";
                                    echo "<th colspan='2' class='text-right'>Total</th>";
                                    echo "<td>% {$totalOcupacion}</td>";
                                    echo "</tr>";
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <?php
    include('footer.php');
}
?>
