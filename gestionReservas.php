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
            input = document.getElementById("fecha");
            input2 = document.getElementById("estado");
            filter = input.value.toUpperCase();
            filter2 = input2.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                td2 = tr[i].getElementsByTagName("td")[2];
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
                Gestión de Reservas
                <div class="float-right">
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <form method="post">
                                <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#modalReserva">Nueva Reserva</button>
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
                                <label class="sr-only" for="fecha">Fecha</label>
                                <input type="number" class="form-control mt-2 mb-2 mr-2" id="fecha" placeholder="yyyy-mm-dd" onkeyup="myFunction()">
                                <label class="sr-only" for="estado">Estado</label>
                                <input type="text" class="form-control mt-2 mb-2 mr-2" id="estado" placeholder="Estado" onkeyup="myFunction()">
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
                                <th class="text-center">idReserva</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $result = mysqli_query($link,"SELECT * FROM Reserva ORDER BY fechaReserva DESC");
                            while ($fila =  mysqli_fetch_array($result)){
                                $result1 = mysqli_query($link,"SELECT * FROM Estado WHERE idEstado = '{$fila['idEstado']}'");
                                while ($fila1 = mysqli_fetch_array($result1)){
                                    $estado = $fila1['descripcion'];
                                }
                                echo "<tr>";
                                echo "<td>{$fila['idReserva']}</td>";
                                echo "<td>{$fila['fechaReserva']}</td>";
                                echo "<td>{$estado}</td>";
                                echo "
                                    <td>
                                        <form method='post'>
                                            <div class='dropdown'>
                                                <button class='btn btn-outline-primary btn-sm dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    Acciones
                                                </button>
                                                <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                                    <input type='hidden' value='{$fila['idReserva']}' name='idReserva'>
                                                    <button name='editar' class='dropdown-item' type='submit' formaction='nuevaReserva.php'>Editar</button>
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

    <form method="post" action="nuevaReserva.php">
        <div class="modal fade" id="modalReserva" tabindex="-1" role="dialog" aria-labelledby="modalReserva" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nueva Reserva</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <input type="hidden" name="idReserva" value="<?php $idReserva = idgen("R"); echo $idReserva?>">
                            <div class="row">
                                <div class="form-group col-6" id="divDni">
                                    <label class="col-form-label" for="dni">DNI Titular:</label>
                                    <input type="number" name="dni" required id="dni" class="form-control" onchange="getNombre(this.value);getTelf(this.value);getEmail(this.value);getEmpresa(this.value)" min="0">
                                </div>
                                <div class="form-group col-6" id="divNombre">
                                    <label class="col-form-label" for="nombres">Nombre Completo:</label>
                                    <input type="text" name="nombres" id="nombres" class="form-control" onchange="getID(this.value);getTelf(this.value);getEmail(this.value);getEmpresa1(this.value)">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6" id="divTelf">
                                    <label class="col-form-label" for="telefono">Teléfono Celular:</label>
                                    <input type="text" name="telefono" id="telefono" class="form-control">
                                </div>
                                <div class="form-group col-6" id="divEmail">
                                    <label class="col-form-label" for="email">Correo Electrónico:</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label class="col-form-label" for="empresa">Empresa:</label>
                                    <select class="form-control" name="empresa" id="empresa">
                                        <option selected disabled>Seleccionar</option>
                                        <?php
                                        $result = mysqli_query($link,"SELECT * FROM Empresa ORDER BY razonSocial ASC ");
                                        while ($fila = mysqli_fetch_array($result)){
                                            echo "<option value='{$fila['idEmpresa']}'>{$fila['razonSocial']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label class="col-form-label" for="tipoReserva">Tipo de Reserva:</label>
                                    <select class="form-control" name="tipoReserva" id="tipoReserva" onchange="getPaquete(this.value)">
                                        <option selected disabled>Seleccionar</option>
                                        <option value="3">Reserva Confirmada</option>
                                        <option value="9">Reserva Pendiente</option>
                                        <option value="10">Reserva de Paquete</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12" id="paquete">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cerrar">
                        <input type="submit" class="btn btn-primary" name="addReserva" value="Guardar Cambios">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php
    include('footer.php');
}
?>
