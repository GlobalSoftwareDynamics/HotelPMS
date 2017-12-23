<?php
include('session.php');
include('declaracionFechas.php');
include('funciones.php');
if(isset($_SESSION['login'])){
    include('header.php');
    include('navbarRecepcion.php');

    if(isset($_POST['addPaquete'])){

        $descripcion = "";
        $result = mysqli_query($link,"SELECT * FROM Paquete WHERE idPaquete = '{$_POST['idPaquete']}'");
        while ($fila = mysqli_fetch_array($result)){
            $duracion = $fila['duracion'];
            $stringDuracion = "Duración: ".$duracion." Noches; ";
            $stringHabitaciones = "Habitaciones: ";
            $result1 = mysqli_query($link,"SELECT * FROM TipoHabitacionPaquete WHERE idPaquete = '{$fila['idPaquete']}'");
            while ($fila1 = mysqli_fetch_array($result1)){
                $result2 = mysqli_query($link,"SELECT * FROM TipoHabitacion WHERE idTipoHabitacion = '{$fila1['idTipoHabitacion']}'");
                while ($fila2 = mysqli_fetch_array($result2)){
                    $tipoHabitacion = $fila2['descripcion'];
                }
                $stringHabitaciones .= $tipoHabitacion.": ".$fila1['nroHabitaciones'].",";
            }
            $stringHabitaciones .= "; ";
        }

        $descripcion = $stringDuracion.$stringHabitaciones.$_POST['descripcionAdicionales'];

        $query = mysqli_query($link,"UPDATE Paquete SET descripcion = '{$descripcion}', valor = '{$_POST['valorAdicionales']}' WHERE idPaquete = '{$_POST['idPaquete']}'");

        $queryPerformed = "UPDATE Paquete SET descripcion = {$descripcion}, valor = {$_POST['valorAdicionales']} WHERE idPaquete = {$_POST['idPaquete']}";

        $databaseLog = mysqli_query($link, "INSERT INTO DatabaseLog (idColaborador,fechaHora,evento,tipo,consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','Paquete','{$queryPerformed}')");

    }

    ?>

    <script>
        function myFunction() {
            // Declare variables
            var input, input2, input3, filter, filter2, filter3, table, tr, td, td2, td3, i;
            input = document.getElementById("nombre");
            input2 = document.getElementById("descripcion");
            filter = input.value.toUpperCase();
            filter2 = input2.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                td2 = tr[i].getElementsByTagName("td")[1];
                if ((td)&&(td2)) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        if(td2.innerHTML.toUpperCase().indexOf(filter2) > -1){
                            tr[i].style.display = "";
                        }else{
                            tr[i].style.display = "none";
                        }
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

    <section class="container">
        <div class="card">
            <div class="card-header card-inverse card-info">
                <i class="fa fa-list"></i>
                Gestión de Paquetes
                <div class="float-right">
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <form method="post">
                                <a class="dropdown-item" href="nuevoPaquete_DatosGenerales.php" style="font-size: 14px;">Registrar Nuevo Paquete</a>
                            </form>
                        </div>
                    </div>
                </div>
                <span class="float-right">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <span class="float-right">
                    <button href="#collapsed" class="btn btn-light btn-sm" data-toggle="collapse">Mostrar Filtros</button>
                </span>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-12">
                        <div id="collapsed" class="collapse">
                            <form class="form-inline justify-content-center" method="post" action="#">
                                <label class="sr-only" for="nombre">Nombre</label>
                                <input type="text" class="form-control mt-2 mb-2 mr-2" id="nombre" placeholder="Nombre" onkeyup="myFunction()">
                                <label class="sr-only" for="descripcion">Descripción</label>
                                <input type="text" class="form-control mt-2 mb-2 mr-2" id="descripcion" placeholder="Descripción" onkeyup="myFunction()">
                                <input type="submit" class="btn btn-primary" value="Limpiar" style="padding-left:28px; padding-right: 28px;">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="spacer10"></div>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered text-center" id="myTable">
                            <thead class="thead-default">
                            <tr>
                                <th class="text-center" style="width: 30%">Nombre</th>
                                <th class="text-center" style="width: 50%">Descripción</th>
                                <th class="text-center" style="width: 10%">Valor</th>
                                <th class="text-center" style="width: 10%">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $totalpaquete = 0;
                            $result = mysqli_query($link,"SELECT * FROM Paquete");
                            while ($fila = mysqli_fetch_array($result)){
                                $totalhabitaciones = 0;
                                $result1 = mysqli_query($link,"SELECT * FROM TipoHabitacionPaquete WHERE idPaquete = '{$fila['idPaquete']}'");
                                $numFilas = mysqli_num_rows($result1);
                                if($numFilas == 0){
                                    $totalhabitaciones = 0;
                                }else{
                                    while ($fila1 = mysqli_fetch_array($result1)){
                                        $result2 = mysqli_query($link,"SELECT * FROM Tarifa WHERE idTarifa = '{$fila1['idTarifa']}'");
                                        while ($fila2 = mysqli_fetch_array($result2)){
                                            $valorTarifa = $fila2['valor'];
                                        }

                                        $valorHabitacion  = $fila1['nroHabitaciones'] * $valorTarifa;
                                        $totalhabitaciones = $totalhabitaciones + $valorHabitacion;

                                    }
                                }

                                $totalpaquete = ($totalhabitaciones * $fila['duracion']) + $fila['valor'];

                                echo "<tr>";
                                echo "<td>{$fila['nombre']}</td>";
                                echo "<td>{$fila['descripcion']}</td>";
                                echo "<td>{$totalpaquete}</td>";
                                echo "
                                    <td>
                                        <form method='post'>
                                            <div class='dropdown'>
                                                <button class='btn btn-outline-primary btn-sm dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    Acciones
                                                </button>
                                                <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                                    <input type='hidden' value='{$fila['idPaquete']}' name='idPaquete'>
                                                    <button name='detalle' class='dropdown-item' type='submit' formaction='detallePaquete.php'>Ver Detalle</button>
                                                    <button name='editar' class='dropdown-item' type='submit' formaction='editarTarifa.php'>Editar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                ";
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    include('footer.php');
}
?>
