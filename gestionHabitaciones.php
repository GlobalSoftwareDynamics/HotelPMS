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
            input = document.getElementById("numero");
            input2 = document.getElementById("tipo");
            input3 = document.getElementById("vista");
            filter = input.value.toUpperCase();
            filter2 = input2.value.toUpperCase();
            filter3 = input3.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                td2 = tr[i].getElementsByTagName("td")[1];
                td3 = tr[i].getElementsByTagName("td")[2];
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
                Gestión de Habitaciones
                <div class="float-right">
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <form method="post">
                                <a class="dropdown-item" href="nuevaHabitacion.php" style="font-size: 14px;">Registrar Nueva Habitación</a>
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
                                <label class="sr-only" for="numero">Nro. Habitacion</label>
                                <input type="number" class="form-control mt-2 mb-2 mr-2" id="numero" placeholder="Número" onkeyup="myFunction()">
                                <label class="sr-only" for="tipo">Tipo</label>
                                <input type="text" class="form-control mt-2 mb-2 mr-2" id="tipo" placeholder="Tipo" onkeyup="myFunction()">
                                <label class="sr-only" for="vista">Vista</label>
                                <input type="text" class="form-control mt-2 mb-2 mr-2" id="vista" placeholder="Vista" onkeyup="myFunction()">
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
                                <th class="text-center">Nro. Habitación</th>
                                <th class="text-center">Tipo</th>
                                <th class="text-center">Vista</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = mysqli_query($link,"SELECT * FROM Habitacion");
                            while($row = mysqli_fetch_array($query)){
                                echo "<tr>";
                                    echo "<td>{$row['idHabitacion']}</td>";
                                    $query2 = mysqli_query($link,"SELECT * FROM TipoHabitacion WHERE idTipoHabitacion = '{$row['idTipoHabitacion']}'");
                                    while($row2 = mysqli_fetch_array($query2)){
                                        echo "<td>{$row2['descripcion']}</td>";
                                    }
                                    $query2 = mysqli_query($link,"SELECT * FROM TipoVista WHERE idTipoVista = '{$row['idTipoVista']}'");
                                    while($row2 = mysqli_fetch_array($query2)){
                                        echo "<td>{$row2['descripcion']}</td>";
                                    }
                                    echo "<td>
                                        <form method='post'>
                                            <input type='hidden' name='idHabitacionSeleccionada' value='{$row['idHabitacion']}'>
                                            <div class='dropdown'>
                                                <button class='btn btn-outline-primary btn-sm dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    Acciones
                                                </button>
                                                <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                                    <button name='editar' class='dropdown-item' type='submit' formaction='detalleHabitacion.php'>Ver Detalle</button>
                                                    <button name='desactivar' class='dropdown-item' type='submit' formaction='editarHabitacion.php'>Editar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>";
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
