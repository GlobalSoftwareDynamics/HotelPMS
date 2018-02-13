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

    <section class="container">
        <div class="card">
            <div class="card-header reportes card-inverse card-info">
                <i class="fa fa-line-chart"></i>
                Reporte Anual
                <div class="float-right">
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <form method="post">
                                <input class="dropdown-item" type="submit" name="pdf" formaction="" value="Descargar PDF">
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
                                <label class="sr-only" for="idEmpresa">Año</label>
                                <input type="number" class="form-control mt-2 mb-2 mr-2" id="anio" name="anio" placeholder="YYYY" min="2000" max="9999">
                                <input type="submit" class="btn btn-primary" value="Generar" style="padding-left:28px; padding-right: 28px;" name="generarReporte">
                            </form>
                        </div>
                        <div class="spacer10"></div>
                        <div style="width: 100%; border-top: 1px solid lightgrey;"></div>
                    </div>
                </div>
                <div class="spacer20"></div>
                <?php
                if(isset($_POST['generarReporte']) && !($_POST['anio'])){
                    echo "
                        <div class='row'>
                            <div class='col-12'>
                                <p class='text-center'>La Fecha de Inicio de Reporte ingresada es mayor a la Fecha de Fin de Reporte. Por favor seleccione las fechas correctamente e intente de nuevo.</p>
                            </div>
                        </div>
                    ";
                }else{
                    if (isset($_POST['generarReporte'])&&isset($_POST['anio'])){
                        ?>
                        <div class="row">
                            <div class="col-7">
                                <div class="row">
                                    <div class="col-2">
                                        <p><b>Año:</b></p>
                                    </div>
                                    <div class="col-8">
                                        <p><?php echo $_POST['anio'];?></p>
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
                            <div class="col-12" style="height: 1000px; overflow-y: auto;">
                                <table class="table text-center">
                                    <thead>
                                    <?php
                                    echo "<tr>";
                                    echo "<th>Información</th>";
                                    for ($i = 1; $i < 13; $i++) {
                                        switch ($i) {
                                            case 1:
                                                $mes="Enero";
                                                break;
                                            case 2:
                                                $mes="Febrero";
                                                break;
                                            case 3:
                                                $mes="Marzo";
                                                break;
                                            case 4:
                                                $mes="Abril";
                                                break;
                                            case 5:
                                                $mes="Mayo";
                                                break;
                                            case 6:
                                                $mes="Junio";
                                                break;
                                            case 7:
                                                $mes="Julio";
                                                break;
                                            case 8:
                                                $mes="Agosto";
                                                break;
                                            case 9:
                                                $mes="Septiembre";
                                                break;
                                            case 10:
                                                $mes="Octubre";
                                                break;
                                            case 11:
                                                $mes="Noviembre";
                                                break;
                                            case 12:
                                                $mes="Diciembre";
                                                break;
                                        }
                                        echo "<th>{$mes}</th>";
                                    }
                                    echo "<th>Anual</th>";
                                    echo "</tr>";
                                    ?>
                                    </thead>
                                    <tbody>
                                    <?php
                                    echo "<tr>";
                                    echo "<th># de Habitaciones</th>";
                                    $totalAnio = 0;
                                    for ($i = 1; $i < 13; $i++) {
                                        $aux1 = switchMesRepAnual($i);
                                        $result=mysqli_query($link, "SELECT COUNT(*) AS cantidad FROM HabitacionReservada WHERE fechaInicio LIKE '{$_POST['anio']}-{$aux1}%' OR fechaFin LIKE '{$_POST['anio']}-{$aux1}%' AND idHabitacion IN (SELECT idHabitacion FROM Habitacion WHERE idTipoHabitacion != 5)");
                                        while ($fila=mysqli_fetch_array($result)){
                                            echo "<td>{$fila['cantidad']}</td>";
                                            $totalAnio += $fila['cantidad'];
                                        }
                                    }
                                    echo "<td>{$totalAnio}</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<th>% de Ocupabilidad</th>";
                                    $totalAnio = 0;
                                    for ($i = 1; $i < 13; $i++) {
                                        $ocupabilidad = 0;
                                        $aux1 = switchMesRepAnual($i);
                                        $numDias = days_in_month($aux1,$_POST['anio']);
                                        $result = mysqli_query($link,"SELECT COUNT(idHabitacion) AS cantidad FROM Habitacion WHERE idTipoHabitacion != 5");
                                        while ($fila = mysqli_fetch_array($result)){
                                            $cantidadHabitaciones = $fila['cantidad'];
                                        }
                                        $result=mysqli_query($link, "SELECT COUNT(*) AS cantidad FROM HabitacionReservada WHERE fechaInicio LIKE '{$_POST['anio']}-{$aux1}%' OR fechaFin LIKE '{$_POST['anio']}-{$aux1}%' AND idHabitacion IN (SELECT idHabitacion FROM Habitacion WHERE idTipoHabitacion != 5)");
                                        while ($fila=mysqli_fetch_array($result)){
                                            $cantidadOcupadas = $fila['cantidad'];
                                        }
                                        $ocupabilidad = round(($cantidadOcupadas/$cantidadHabitaciones)*100,2);
                                        echo "<td>{$ocupabilidad} %</td>";

                                        $totalAnio += $ocupabilidad;
                                    }
                                    $totalAnio = round($totalAnio / 12,2);
                                    echo "<td>{$totalAnio} %</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<th>Habitaciones Diarias</th>";
                                    $totalAnio = 0;
                                    for ($i = 1; $i < 13; $i++) {
                                        $aux1 = switchMesRepAnual($i);
                                        $numDias = days_in_month($aux1,$_POST['anio']);
                                        $result=mysqli_query($link, "SELECT COUNT(*) AS cantidad FROM HabitacionReservada WHERE fechaInicio LIKE '{$_POST['anio']}-{$aux1}%' OR fechaFin LIKE '{$_POST['anio']}-{$aux1}%' AND idHabitacion IN (SELECT idHabitacion FROM Habitacion WHERE idTipoHabitacion != 5)");
                                        while ($fila=mysqli_fetch_array($result)){
                                            $diarias = round($fila['cantidad'] / $numDias,2);
                                        }
                                        echo "<td>{$diarias}</td>";
                                        $totalAnio += $diarias;
                                    }
                                    $totalAnio = round($totalAnio / 12,2);
                                    echo "<td>{$totalAnio}</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<th>Salas de Reunión</th>";
                                    $totalAnio = 0;
                                    for ($i = 1; $i < 13; $i++) {
                                        $aux1 = switchMesRepAnual($i);
                                        $result=mysqli_query($link, "SELECT COUNT(*) AS cantidad FROM HabitacionReservada WHERE (fechaInicio LIKE '{$_POST['anio']}-{$aux1}%' OR fechaFin LIKE '{$_POST['anio']}-{$aux1}%') AND idHabitacion IN (SELECT idHabitacion FROM Habitacion WHERE idTipoHabitacion = 5)");
                                        while ($fila=mysqli_fetch_array($result)){
                                            echo "<td>{$fila['cantidad']}</td>";
                                            $totalAnio += $fila['cantidad'];
                                        }
                                    }
                                    echo "<td>{$totalAnio}</td>";
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
