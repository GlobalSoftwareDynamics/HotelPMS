<?php
include('session.php');
include('funciones.php');
include('declaracionFechas.php');
if(isset($_SESSION['login'])){
    include('header.php');
    include('navbarRecepcion.php');

    if(isset($_POST['addPaquete'])){

        $query = mysqli_query($link,"INSERT INTO Paquete(idPaquete,nombre,duracion) VALUES ('{$_POST['idPaquete']}','{$_POST['nombre']}','{$_POST['noches']}')");

        $queryPerformed = "INSERT INTO Paquete(idPaquete,nombre,duracion) VALUES ({$_POST['idPaquete']},{$_POST['nombre']},{$_POST['noches']})";

        $databaseLog = mysqli_query($link, "INSERT INTO DatabaseLog (idColaborador,fechaHora,evento,tipo,consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','Paquete','{$queryPerformed}')");

    }

    if(isset($_POST['addHabitacion'])){

        $query = mysqli_query($link,"INSERT INTO TipoHabitacionPaquete(idPaquete,idTipoHabitacion,idTarifa,nroHabitaciones) VALUES ('{$_POST['idPaquete']}','{$_POST['habitacion']}','{$_POST['tarifaHabitacion']}','{$_POST['cantidadHabitacion']}')");

        $queryPerformed = "INSERT INTO TipoHabitacionPaquete(idPaquete,idTipoHabitacion,idTarifa,nroHabitaciones) VALUES ({$_POST['idPaquete']},{$_POST['habitacion']},{$_POST['tarifaHabitacion']},{$_POST['cantidadHabitacion']})";

        $databaseLog = mysqli_query($link, "INSERT INTO DatabaseLog (idColaborador,fechaHora,evento,tipo,consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','TipoHabitacionPaquete','{$queryPerformed}')");

    }

    if(isset($_POST['eliminar'])){

        $query = mysqli_query($link,"DELETE FROM TipoHabitacionPaquete WHERE idPaquete = '{$_POST['idPaquete']}' AND idTipoHabitacion = '{$_POST['idTipoHabitacion']}'");

        $queryPerformed = "DELETE FROM TipoHabitacionPaquete WHERE idPaquete = {$_POST['idPaquete']} AND idTipoHabitacion = {$_POST['idTipoHabitacion']}";

        $databaseLog = mysqli_query($link, "INSERT INTO DatabaseLog (idColaborador,fechaHora,evento,tipo,consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','DELETE','TipoHabitacionPaquete','{$queryPerformed}')");

    }

    ?>
    <section class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-inverse card-info">
                        <div class="float-left mt-1">
                            <i class="fa fa-shopping-bag"></i>
                            &nbsp;&nbsp;Nuevo Paquete
                        </div>
                        <div class="float-right">
                            <div class="dropdown">
                                <input name="addPaquete" type="submit" form="formAdicionales" class="btn btn-light btn-sm" formaction="gestionPaquetes.php" value="Finalizar">
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="col-12">
                            <div class="spacer20"></div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#Habitaciones" role="tab">Habitaciones</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#Adicionales" role="tab">Adicionales</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="Habitaciones" role="tabpanel">
                                    <div class="spacer20"></div>
                                    <form method="post" id="formHabitaciones">
                                        <input type="hidden" value="<?php echo $_POST['idPaquete']?>" name="idPaquete">
                                        <table class="table table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Habitación</th>
                                                <th class="text-center">Cantidad</th>
                                                <th class="text-center">Tarifa</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <select name="habitacion" class="form-control">
                                                        <option>Seleccionar</option>
                                                        <?php
                                                        $result = mysqli_query($link,"SELECT * FROM TipoHabitacion");
                                                        while ($fila = mysqli_fetch_array($result)){
                                                            echo "<option value='{$fila['idTipoHabitacion']}'>{$fila['descripcion']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td><input type="number" class="form-control" min="0" name="cantidadHabitacion"></td>
                                                <td>
                                                    <select name="tarifaHabitacion" class="form-control">
                                                        <option>Seleccionar</option>
                                                        <?php
                                                        $result = mysqli_query($link,"SELECT * FROM Tarifa");
                                                        while ($fila = mysqli_fetch_array($result)){
                                                            echo "<option value='{$fila['idTarifa']}'>{$fila['descripcion']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td><input type="submit" name="addHabitacion" value="Agregar" class="btn btn-outline-primary" form="formHabitaciones"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="spacer10"></div>
                                        <table class="table text-center">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Habitación</th>
                                                <th class="text-center">Cantidad</th>
                                                <th class="text-center">Tarifa</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $result = mysqli_query($link,"SELECT * FROM TipoHabitacionPaquete WHERE idPaquete = '{$_POST['idPaquete']}'");
                                            $numFilas = mysqli_num_rows($result);
                                            if($numFilas == 0){

                                            }else{
                                                while ($fila = mysqli_fetch_array($result)){
                                                    $result1 = mysqli_query($link,"SELECT * FROM Tarifa WHERE idTarifa = '{$fila['idTarifa']}'");
                                                    while ($fila1 = mysqli_fetch_array($result1)){
                                                        $tarifa = $fila1['descripcion'];
                                                    }
                                                    $result1 = mysqli_query($link,"SELECT * FROM TipoHabitacion WHERE idTipoHabitacion = '{$fila['idTipoHabitacion']}'");
                                                    while ($fila1 = mysqli_fetch_array($result1)){
                                                        $habitacion = $fila1['descripcion'];
                                                    }
                                                    echo "<tr>";
                                                    echo "<td>{$habitacion}</td>";
                                                    echo "<td>{$fila['nroHabitaciones']}</td>";
                                                    echo "<td>{$tarifa}</td>";
                                                    echo "
                                                    <td>
                                                        <form method='post'>
                                                            <input type='hidden' value='{$fila['idPaquete']}' name='idPaquete'>
                                                            <input type='hidden' value='{$fila['idTipoHabitacion']}' name='idTipoHabitacion'>
                                                            <button name='eliminar' class='btn btn-sm btn-outline-primary' type='submit' formaction='nuevoPaquete_Caracteristicas.php'>Eliminar</button>
                                                        </form>
                                                    </td>
                                                    ";
                                                    echo "</tr>";
                                                }
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                <div class="tab-pane" id="Adicionales" role="tabpanel">
                                    <div class="spacer20"></div>
                                    <form method="post" id="formAdicionales">
                                        <input type="hidden" value="<?php echo $_POST['idPaquete']?>" name="idPaquete">
                                        <div class="form-group row">
                                            <label for="descripcionAdicionales" class="col-2 col-form-label">Descripción:</label>
                                            <div class="col-10">
                                                <textarea class="form-control" id="descripcionAdicionales" name="descripcionAdicionales" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="valorAdicionales" class="col-2 col-form-label">Valor Adicionales:</label>
                                            <div class="col-2">
                                                <input class="form-control" type="number" id="valorAdicionales" name="valorAdicionales">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="moneda" class="col-2 col-form-label">Moneda:</label>
                                            <div class="col-10">
                                                <select name="moneda" id="moneda" class="form-control">
                                                    <option>Seleccionar</option>
                                                    <option value="1">Dólares</option>
                                                    <option value="2">Soles</option>
                                                    <option value="3">Euros</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
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