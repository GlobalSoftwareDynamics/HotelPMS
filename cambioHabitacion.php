<?php
include('session.php');
if(isset($_SESSION['login'])){
    include('funciones.php');
    include('header.php');
    if($_SESSION['userType'] == 1){
        include('navbarRecepcion.php');
    }else{
        include('navbarAdmin.php');
    }
    include('declaracionFechas.php');

    ?>

    <section class="container">
        <div class="card">
            <div class="card-header">
                Cambio de Habitación
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h6 class="text-center">Habitación a desocupar</h6>
                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th>Check-In</th>
                                <th>Check-Out</th>
                                <th>Tipo de Habitación</th>
                                <th>Habitación</th>
                                <th>Cama Adicional</th>
                                <th>Tarifa</th>
                                <th>Preferencias</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE idHabitacionReservada = '{$_POST['idHabitacionReservada']}' AND idReserva = '{$_POST['idReserva']}'");
                            while($row = mysqli_fetch_array($query)){
                                $habitacionAnterior = $row['idHabitacion'];
                                echo "<tr>";
                                    $fechaInicial = substr($row['fechaInicio'],0,10);
                                    echo "<td>{$fechaInicial}</td>";
                                    $fechaFinal = date('Y-m-d');
                                    echo "<td>{$fechaFinal}</td>";
                                    $query2 = mysqli_query($link,"SELECT * FROM Habitacion WHERE idHabitacion = '{$row['idHabitacion']}'");
                                    while($row2 = mysqli_fetch_array($query2)){
                                        $query3 = mysqli_query($link,"SELECT * FROM TipoHabitacion WHERE idTipoHabitacion = '{$row2['idTipoHabitacion']}'");
                                        while($row3 = mysqli_fetch_array($query3)){
                                            echo "<td>{$row3['descripcion']}</td>";
                                        }
                                    }
                                    echo "<td>{$row['idHabitacion']}</td>";
                                    echo "<td>";
                                        if($row['camaAdicional'] == 1){ echo "Sí";}else{ echo "No";}
                                    echo "</td>";
                                    $query2 = mysqli_query($link,"SELECT * FROM Tarifa WHERE idTarifa = '{$row['idTarifa']}'");
                                    while($row2 = mysqli_fetch_array($query2)){
                                        echo "<td>{$row2['descripcion']} - {$row2['valor']}</td>";
                                    }
                                    echo "<td>";
                                        if($row['preferencias']==null){
                                            echo "-";
                                        }else{
                                            echo $row['preferencias'];
                                        }
                                    echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Check-In</th>
                                <th>Check-Out</th>
                                <th>Tipo de Habitación</th>
                                <th>Habitación</th>
                                <th>Cama Adicional</th>
                                <th>Tarifa</th>
                                <th>Preferencias</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <form method="post" action="nuevaReserva.php">
                                <input type="hidden" name="idReserva" value="<?php echo $_POST['idReserva']; ?>">
                                <input type='hidden' name='idHabitacionReservadaAnterior' value='<?php echo $_POST['idHabitacionReservada']?>'>
                                <input type='hidden' name='idHabitacionAnterior' value='<?php echo $habitacionAnterior?>'>
                                <tr>
                                    <td>
                                        <input type="date" name="fechaInicio" class="form-control" id="inicioCheckIn" value="<?php echo $fechaFinal;?>" readonly>
                                    </td>
                                    <td>
                                        <input type="date" name="fechaFin" class="form-control" id="finCheckOut">
                                    </td>
                                    <td>
                                        <select class="form-control" name="tipoHabitacion" onchange="getHabitacion(this.value);getTarifa(this.value)">
                                            <option selected disabled>Seleccionar</option>
                                            <?php
                                            $query = mysqli_query($link, "SELECT * FROM TipoHabitacion");
                                            while ($row = mysqli_fetch_array($query)) {
                                                echo "<option value='{$row['idTipoHabitacion']}'>{$row['descripcion']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="nroHabitacion"
                                                id="nroHabitacion">
                                            <option selected disabled>Seleccionar</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="camaAdicional"
                                               value="true">
                                    </td>
                                    <td>
                                        <select class="form-control" name="tarifa" id="tarifa">
                                            <option selected disabled>Seleccionar</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="preferencias" class="form-control">
                                    </td>
                                    <td>
                                        <input disabled readonly class="form-control">
                                    </td>
                                    <td>
                                        <input type="submit" name="cambioHabitacion" class="btn btn-primary btn" value="Agregar">
                                    </td>
                                </tr>
                            </form>
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