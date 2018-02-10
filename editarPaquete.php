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

    if(isset($_POST['editar'])){

        $descripcion = "";
        $result = mysqli_query($link,"SELECT * FROM Paquete WHERE idPaquete = '{$_POST['idPaquete']}'");
        while ($fila = mysqli_fetch_array($result)){
            $duracion = $_POST['noches'];
            $stringDuracion = "Duración: ".$duracion." Noches; ";
            $stringHabitaciones = "Habitaciones: ";
            $result1 = mysqli_query($link,"SELECT * FROM TipoHabitacionPaquete WHERE idPaquete = '{$fila['idPaquete']}'");
            while ($fila1 = mysqli_fetch_array($result1)){
                $result2 = mysqli_query($link,"SELECT * FROM TipoHabitacion WHERE idTipoHabitacion = '{$fila1['idTipoHabitacion']}'");
                while ($fila2 = mysqli_fetch_array($result2)){
                    $tipoHabitacion = $fila2['descripcion'];
                }
                $stringHabitaciones .= $tipoHabitacion.": ".$fila1['nroHabitaciones'].", ";
            }
            $stringHabitaciones .= "; ";
        }

        $descripcion = $stringDuracion.$stringHabitaciones."Incluye: ".$_POST['descripcionAdicionales'];

        $query = mysqli_query($link,"UPDATE Paquete SET nombre = '{$_POST['nombre']}', descripcion = '{$descripcion}', valor = '{$_POST['valorAdicionales']}', duracion = '{$_POST['noches']}', moneda = '{$_POST['moneda']}' WHERE idPaquete = '{$_POST['idPaquete']}'");

        $queryPerformed = "UPDATE Paquete SET nombre = {$_POST['nombre']}, descripcion = {$descripcion}, valor = {$_POST['valorAdicionales']}, duracion = {$_POST['noches']}, moneda = {$_POST['moneda']} WHERE idPaquete = {$_POST['idPaquete']}";

        $databaseLog = mysqli_query($link, "INSERT INTO DatabaseLog (idColaborador,fechaHora,evento,tipo,consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','Paquete','{$queryPerformed}')");

    }

    $result = mysqli_query($link,"SELECT * FROM Paquete WHERE idPaquete = '{$_POST['idPaquete']}'");
    while($row = mysqli_fetch_array($result)) {
        $nombre = $row['nombre'];
        $descripcion = explode("Incluye: ",$row['descripcion']);
        $duracion = $row['duracion'];
        $valorAdicionales = $row['valor'];

        ?>

        <section class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header formularios card-inverse card-info">
                            <div class="float-left">
                                <i class="fa fa-shopping-bag"></i>
                                Editar Paquete
                            </div>
                            <div class="float-right">
                                <div class="dropdown">
                                    <input type='submit' value='Guardar' name='editar' class='btn btn-light btn-sm' form="form">
                                    <input type='submit' value='Regresar' name='regresar' class='btn btn-light btn-sm' form="form" formaction="gestionPaquetes.php">
                                </div>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="col-12">
                                <div class="spacer15"></div>
                                <form method="post" action="editarPaquete.php" id="form">
                                    <input type="hidden" name="idPaquete" value="<?php echo $_POST['idPaquete'];?>">
                                    <div class="form-group row">
                                        <label for="nombre" class="col-2 col-form-label">Nombre:</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" id="nombre" name="nombre" value="<?php echo $nombre;?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="noches" class="col-2 col-form-label">Nro. de Noches:</label>
                                        <div class="col-1">
                                            <input class="form-control" type="number" min="0" id="noches" name="noches" value="<?php echo $duracion;?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="descripcionAdicionales" class="col-2 col-form-label">Adicionales:</label>
                                        <div class="col-10">
                                            <textarea class="form-control" id="descripcionAdicionales" name="descripcionAdicionales" rows="3"><?php echo $descripcion[1];?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="valorAdicionales" class="col-2 col-form-label">Valor Adicionales:</label>
                                        <div class="col-2">
                                            <input class="form-control" type="number" id="valorAdicionales" name="valorAdicionales" value="<?php echo $valorAdicionales;?>" min="0">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="moneda" class="col-2 col-form-label">Moneda:</label>
                                        <div class="col-10">
                                            <select name="moneda" id="moneda" class="form-control">
                                                <option selected disabled>Seleccionar</option>
                                                <option value="$">Dólares</option>
                                                <option value="S/.">Soles</option>
                                                <option value="€">Euros</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
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
                                <i class="fa fa-info-circle"></i>
                                Habitaciones
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="col-12">
                                <form method="post">
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
                                            echo "
                                                    <td>
                                                        <form method='post'>
                                                            <input type='hidden' value='{$row['idPaquete']}' name='idPaquete'>
                                                            <input type='hidden' value='{$fila['idTipoHabitacion']}' name='idTipoHabitacion'>
                                                            <button name='eliminar' class='btn btn-sm btn-outline-primary' type='submit' formaction='editarPaquete.php'>Eliminar</button>
                                                        </form>
                                                    </td>
                                            ";
                                            echo "</tr>";
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-sm btn-primary col-4 offset-4 mb-3" data-toggle="modal" data-target="#modalHabitaciones">Agregar Habitaciones</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="modalHabitaciones" tabindex="-1" role="dialog" aria-labelledby="modalHabitaciones" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Habitación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form id="formHabitacion" method="post" action="#">
                                <input type="hidden" name="idPaquete" value="<?php echo $_POST['idPaquete']?>">
                                <div class="form-group row">
                                    <label class="col-form-label" for="habitacion">Habitación:</label>
                                    <select name="habitacion" class="form-control" id="habitacion">
                                        <option>Seleccionar</option>
                                        <?php
                                        $result1 = mysqli_query($link,"SELECT * FROM TipoHabitacion");
                                        while ($fila1 = mysqli_fetch_array($result1)){
                                            echo "<option value='{$fila1['idTipoHabitacion']}'>{$fila1['descripcion']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label" for="cantidad">Cantidad:</label>
                                    <input type="number" class="form-control" min="0" name="cantidadHabitacion" id="cantidad">
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label" for="tarifaHabitacion">Tarifa:</label>
                                    <select name="tarifaHabitacion" class="form-control" id="tarifaHabitacion">
                                        <option>Seleccionar</option>
                                        <?php
                                        $result1 = mysqli_query($link,"SELECT * FROM Tarifa");
                                        while ($fila1 = mysqli_fetch_array($result1)){
                                            echo "<option value='{$fila1['idTarifa']}'>{$fila1['descripcion']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button form="formHabitacion" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button class="btn btn-primary" form="formHabitacion" value="Submit" name="addHabitacion">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
    include('footer.php');
}
?>
