<?php
include('session.php');
include('declaracionFechas.php');
include('funciones.php');
if(isset($_SESSION['login'])){
    include('header.php');
    include('navbarRecepcion.php');

    ?>

    <script>
        function myFunction() {
            // Declare variables
            var input, input2, input3, filter, filter2, filter3, table, tr, td, td2, td3, i;
            input = document.getElementById("nombre");
            input2 = document.getElementById("empresa");
            input3 = document.getElementById("habitacion");
            filter = input.value.toUpperCase();
            filter2 = input2.value.toUpperCase();
            filter3 = input3.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                td2 = tr[i].getElementsByTagName("td")[1];
                td3 = tr[i].getElementsByTagName("td")[3];
                if ((td)&&(td2)) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        if(td2.innerHTML.toUpperCase().indexOf(filter2) > -1){
                            if(td3.innerHTML.toUpperCase().indexOf(filter3) > -1){
                                tr[i].style.display = "";
                            }else{
                                tr[i].style.display = "none";
                            }
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
                Gestión de Clientes
                <div class="float-right">
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <form method="post">
                                <a class="dropdown-item" href="nuevoCliente.php" style="font-size: 14px;">Registrar Nuevo Cliente</a>
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
                                <label class="sr-only" for="empresa">Empresa</label>
                                <input type="text" class="form-control mt-2 mb-2 mr-2" id="empresa" placeholder="Empresa" onkeyup="myFunction()">
                                <label class="sr-only" for="habitacion">Habitación</label>
                                <input type="number" min="0" class="form-control mt-2 mb-2 mr-2" id="habitacion" placeholder="Habitación" onkeyup="myFunction()">
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
                                <th class="text-center">Nombre Completo</th>
                                <th class="text-center">Empresa</th>
                                <th class="text-center">Reserva</th>
                                <th class="text-center">Habitación</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $date = date("Y-m-d");
                            $result = mysqli_query($link,"SELECT * FROM Ocupantes WHERE (idReserva, idHabitacion) IN (SELECT idReserva, idHabitacion FROM HabitacionReservada WHERE fechaFin >= '{$date}' AND idEstado = '4' ORDER BY fechaInicio DESC)");
                            while ($fila = mysqli_fetch_array($result)){
                                $result1 = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped = '{$fila['idHuesped']}'");
                                while ($fila1 = mysqli_fetch_array($result1)){
                                    $result3 = mysqli_query($link,"SELECT * FROM Empresa WHERE idEmpresa = '{$fila1['idEmpresa']}'");
                                    $numrows = mysqli_num_rows($result3);
                                    if ($numrows == 0){
                                        $empresa = "Sin Empresa";
                                    }else{
                                        while ($fila3 = mysqli_fetch_array($result3)){
                                            $empresa = $fila3['razonSocial'];
                                        }
                                    }
                                    $nombre = $fila1['nombreCompleto'];
                                    $idHuesped = $fila1['idHuesped'];
                                }
                                echo "<tr>";
                                echo "<td>{$nombre}</td>";
                                echo "<td>{$empresa}</td>";
                                echo "<td>{$fila['idReserva']}</td>";
                                echo "<td>{$fila['idHabitacion']}</td>";
                                echo "<td>
                                                        <form method='post'>
                                                            <div class=\"dropdown\">
                                                                <button class=\"btn btn-primary btn-sm dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                                                    Acciones
                                                                </button>
                                                                <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                                                                    <input type='hidden' name='idReserva' value='{$fila['idReserva']}'>
                                                                    <input type='hidden' name='idHabitacion' value='{$fila['idHabitacion']}'>
                                                                    <input type=\"submit\" value=\"Registrar Consumo\" class=\"dropdown-item\" formaction=\"nuevoConsumo.php\">
                                                                    <input type=\"submit\" value=\"Registrar Check-out\" class=\"dropdown-item\" formaction=\"registrarCheckout.php\">
                                                                    <input type=\"submit\" value=\"Ver Reserva\" class=\"dropdown-item\" formaction=\"verReserva.php\">
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
