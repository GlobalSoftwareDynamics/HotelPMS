<?php
include('session.php');
include ('funciones.php');
if(isset($_SESSION['login'])){
    include('header.php');
    include('navbarRecepcion.php');
    include('declaracionFechas.php');

    if (isset($_POST['checkOut'])){

        $result = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");
        while ($fila = mysqli_fetch_array($result)){

            if($fila['modificadorCheckIO'] == 2 && $_POST['liberarHabitacion'] == "on"){

                $update = mysqli_query($link,"UPDATE HabitacionReservada SET modificadorCheckIO = '4' WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");

                $queryPerformed = "UPDATE HabitacionReservada SET modificadorCheckIO = 4 WHERE idReserva = {$_POST['idReserva']} AND idHabitacion = {$_POST['idHabitacion']}";

                $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','Late CheckOut Con Liberación','{$queryPerformed}')");

            }elseif ($fila['modificadorCheckIO'] == 3 && $_POST['liberarHabitacion'] == "on"){

                $update = mysqli_query($link,"UPDATE HabitacionReservada SET modificadorCheckIO = '5' WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");

                $queryPerformed = "UPDATE HabitacionReservada SET modificadorCheckIO = 5 WHERE idReserva = {$_POST['idReserva']} AND idHabitacion = {$_POST['idHabitacion']}";

                $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','Late CheckOut Con Liberación','{$queryPerformed}')");

            }
        }

        $query = mysqli_query($link,"UPDATE HabitacionReservada SET idEstado = 5 WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");

        $queryPerformed = "UPDATE HabitacionReservada SET idEstado = 5 WHERE idReserva = {$_POST['idReserva']} AND idHabitacion = {$_POST['idHabitacion']}";

        $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','HabitacionReservada-CheckOut','{$queryPerformed}')");

        $result = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE idReserva = '{$_POST['idReserva']}' AND idEstado = 4");
        $numrow = mysqli_num_rows($result);

        if ($numrow == 0){

            $query = mysqli_query($link,"UPDATE Reserva SET idEstado = 5 WHERE idReserva = '{$_POST['idReserva']}'");

            $queryPerformed = "UPDATE Reserva SET idEstado = 5 WHERE idReserva = {$_POST['idReserva']}";

            $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','Reserva-CheckOut Completo','{$queryPerformed}')");

        }

        $result = mysqli_query($link,"SELECT * FROM Reserva WHERE idReserva = '{$_POST['idReserva']}'");
        while ($fila = mysqli_fetch_array($result)){
            $montoTotal = $fila['montoTotal'] + $_POST['montoHabitacionReserva'];
        }

        $query = mysqli_query($link,"UPDATE Reserva SET montoTotal = '{$montoTotal}', montoPendiente = '{$_POST['montoCancelado']}', descuento = '{$_POST['descuento']}' WHERE idReserva = '{$_POST['idReserva']}'");

        $queryPerformed = "UPDATE Reserva SET montoTotal = '{$montoTotal}', montoPendiente = '{$_POST['montoCancelado']}', descuento = {$_POST['descuento']} WHERE idReserva = {$_POST['idReserva']}";

        $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','Reserva-Montos','{$queryPerformed}')");


        $query = mysqli_query($link,"INSERT INTO HistorialReserva(idHabitacion,idReserva,idColaborador,idEstado,fechaHora,descripcion,tipo) VALUES ('{$_POST['idHabitacion']}','{$_POST['idReserva']}','{$_SESSION['user']}',5,'{$dateTime}','Retiro normal de habitación {$_POST['idHabitacion']} para reserva {$_POST['idReserva']}','Check Out')");

        $queryPerformed = "INSERT INTO HistorialReserva(idHabitacion,idReserva,idColaborador,idEstado,fechaHora,descripcion,tipo) VALUES ({$_POST['idHabitacion']},{$_POST['idReserva']},{$_SESSION['user']},5,{$dateTime},Retiro normal de habitación {$_POST['idHabitacion']} para reserva {$_POST['idReserva']},Check Out)";

        $databaseLog = mysqli_query($link,"INSERT INTO DatabaseLog (idColaborador, fechaHora, evento, tipo, consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','HistorialReserva','{$queryPerformed}')");

    }
    ?>

    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
        });
    </script>

    <section class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8"><i class="fa fa-calendar"></i> Agenda de Eventos</div>
                            <div class="col-1 no-padding-lg text-center"><label class="sr-only" for="fechaGuia">Fecha</label><input type="date" class="form-control input-thin" name="fechaGuia" id="fechaGuia" onchange="getCalendar(this.value)" value="<?php echo $date;?>"></div>
                            <div class="col-1 no-padding text-center"><button type="button" class="btn btn-sm btn-light ml-3" data-toggle="modal" data-target="#modalReserva">Nueva Reserva</button></div>
                        </div>
                    </div>
                    <div class="card-body" id="calendario" style="overflow-y: scroll; height: 550px">
                        <table class="bordered-calendar text-center">
                            <thead>
                            <tr>
                                <th class="habitacion">Habitación</th>
                                <?php
                                $date1 = date("Y-m-d", strtotime($date . ' -9 days'));
                                $dateIni = date("Y-m-d", strtotime($date . ' -8 days'));
                                $dateFin = date("Y-m-d", strtotime($date . ' +11 days'));
                                $arrayFechas = array();
                                for($i = 0; $i < 20; $i++){
                                    $date1 = date('Y-m-d', strtotime($date1 . ' +1 day'));
                                    $arrayFechas[$i] = $date1;
                                    $hoy = "";
                                    if($date1 == $date){
                                        $hoy = "background-color: lightblue";
                                    }
                                    echo "<th class=\"fecha\" style='{$hoy}'>$date1</th>";
                                }
                                ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $result = mysqli_query($link,"SELECT * FROM TipoHabitacion ORDER BY idTipoHabitacion");
                            while ($fila = mysqli_fetch_array($result)){
                                echo "<tr>";
                                echo "<th>{$fila['descripcion']}</th>";
                                echo "<td colspan='20'></td>";
                                echo "</tr>";
                                $result1 = mysqli_query($link,"SELECT * FROM Habitacion WHERE idTipoHabitacion = '{$fila['idTipoHabitacion']}' ORDER BY idHabitacion");
                                while ($fila1 = mysqli_fetch_array($result1)){
                                    echo "<tr>";
                                    echo "<td class=\"habitacion\">{$fila1['idHabitacion']}</td>";
                                    $flag = false;
                                    $idReserva = 0;
                                    $interval = 1;
                                    $recojo = "";
                                    $preferencias = "";
                                    $lateCheck = "";
                                    for($i = 0; $i < 20; $i = $i+$interval){
                                        $result2 = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE fechaInicio <= '{$arrayFechas[$i]} 23:59:59' AND fechaFin > '{$arrayFechas[$i]}' AND idHabitacion = '{$fila1['idHabitacion']}' AND idEstado IN (3,4,5,8)");
                                        $numrow = mysqli_num_rows($result2);
                                        if($arrayFechas[$i] == $dateIni){
                                            while ($fila2 = mysqli_fetch_array($result2)){
                                                $interval = timeInterval($dateIni,$fila2['fechaFin']);
                                                if($idReserva == $fila2['idReserva']){
                                                    $flag = true;
                                                }
                                                switch ($fila2['idEstado']){
                                                    case 3:
                                                        $clase = "reserva";
                                                        break;
                                                    case 4:
                                                        $clase = "estadia";
                                                        break;
                                                    case 5:
                                                        $clase = "finalizada";
                                                        break;
                                                }
                                                switch($fila2['modificadorCheckIO']){
                                                    case 0:
                                                        break;
                                                    case 1:
                                                        $lateCheck = "Nota: Se ha solicitado Early CheckIn.";
                                                        break;
                                                    case 2:
                                                        $interval += 1;
                                                        $lateCheck = "Nota: Se ha solicitado Late CheckOut.";
                                                        break;
                                                    case 3:
                                                        $interval += 1;
                                                        $lateCheck = "Nota: Se ha solicitado Early CheckIn y Late CheckOut.";
                                                        break;
                                                    case 4:
                                                    case 5:
                                                        $lateCheck = "Nota: Se ha liberado la habitación luego del Late CheckOut.";
                                                        break;
                                                }
                                                $idReserva = $fila2['idReserva'];
                                                $idHabitacion = $fila2['idHabitacion'];
                                                $preferencias = "<strong>Preferencias:</strong> ".$fila2['preferencias'];
                                                $result3 = mysqli_query($link,"SELECT * FROM Recojo WHERE idReserva = '{$fila2['idReserva']}'");
                                                $numrow1 = mysqli_num_rows($result3);
                                                if($numrow1 > 0){
                                                    $recojo = "<strong>Recojo:</strong> Si, por favor revisar información de Reserva. ";
                                                }
                                            }
                                        }elseif ($arrayFechas[$i] == $dateFin){
                                            while ($fila2 = mysqli_fetch_array($result2)){
                                                $interval = timeInterval($fila2['fechaInicio'],$dateFin);
                                                if($idReserva == $fila2['idReserva']){
                                                    $flag = true;
                                                }
                                                switch ($fila2['idEstado']){
                                                    case 3:
                                                        $clase = "reserva";
                                                        break;
                                                    case 4:
                                                        $clase = "estadia";
                                                        break;
                                                    case 5:
                                                        $clase = "finalizada";
                                                        break;
                                                }
                                                switch($fila2['modificadorCheckIO']){
                                                    case 0:
                                                        break;
                                                    case 1:
                                                        $lateCheck = "Nota: Se ha solicitado Early CheckIn.";
                                                        break;
                                                    case 2:
                                                        $interval += 1;
                                                        $lateCheck = "Nota: Se ha solicitado Late CheckOut.";
                                                        break;
                                                    case 3:
                                                        $interval += 1;
                                                        $lateCheck = "Nota: Se ha solicitado Early CheckIn y Late CheckOut.";
                                                        break;
                                                    case 4:
                                                    case 5:
                                                        $lateCheck = "Nota: Se ha liberado la habitación luego del Late CheckOut.";
                                                        break;
                                                }
                                                $idReserva = $fila2['idReserva'];
                                                $idHabitacion = $fila2['idHabitacion'];
                                                $preferencias = "<strong>Preferencias:</strong> ".$fila2['preferencias'];
                                                $result3 = mysqli_query($link,"SELECT * FROM Recojo WHERE idReserva = '{$fila2['idReserva']}'");
                                                $numrow1 = mysqli_num_rows($result3);
                                                if($numrow1 > 0){
                                                    $recojo = "<strong>Recojo:</strong> Si, por favor revisar información de Reserva. ";
                                                }
                                            }
                                        }else{
                                            while ($fila2 = mysqli_fetch_array($result2)){
                                                $interval = timeInterval($fila2['fechaInicio'],$fila2['fechaFin']);
                                                if($idReserva == $fila2['idReserva']){
                                                    $flag = true;
                                                }
                                                switch ($fila2['idEstado']){
                                                    case 3:
                                                        $clase = "reserva";
                                                        break;
                                                    case 4:
                                                        $clase = "estadia";
                                                        break;
                                                    case 5:
                                                        $clase = "finalizada";
                                                        break;
                                                }
                                                switch($fila2['modificadorCheckIO']){
                                                    case 0:
                                                        break;
                                                    case 1:
                                                        $lateCheck = "Nota: Se ha solicitado Early CheckIn.";
                                                        break;
                                                    case 2:
                                                        $interval += 1;
                                                        $lateCheck = "Nota: Se ha solicitado Late CheckOut.";
                                                        break;
                                                    case 3:
                                                        $interval += 1;
                                                        $lateCheck = "Nota: Se ha solicitado Early CheckIn y Late CheckOut.";
                                                        break;
                                                    case 4:
                                                    case 5:
                                                        $lateCheck = "Nota: Se ha liberado la habitación luego del Late CheckOut.";
                                                        break;
                                                }
                                                $idReserva = $fila2['idReserva'];
                                                $idHabitacion = $fila2['idHabitacion'];
                                                $preferencias = "<strong>Preferencias:</strong> ".$fila2['preferencias'];
                                                $result3 = mysqli_query($link,"SELECT * FROM Recojo WHERE idReserva = '{$fila2['idReserva']}'");
                                                $numrow1 = mysqli_num_rows($result3);
                                                if($numrow1 > 0){
                                                    $recojo = "<strong>Recojo:</strong> Si, por favor revisar información de Reserva. ";
                                                }
                                            }
                                        }
                                        if ($numrow == 0 && $idReserva == 0){
                                            echo "<td></td>";
                                            $idReserva = 0;
                                            $interval = 1;
                                        }elseif($numrow > 0){
                                            echo "<td class='{$clase}' colspan='{$interval}' data-id='{$idReserva}' data-habitacion='{$idHabitacion}'><div class=\"float-right mr-2\"><i class=\"fa fa-info\" data-toggle=\"popover\" data-trigger='hover' data-html=\"true\" title='Información de Reserva' data-content='<strong>Reserva:</strong> {$idReserva}<br>{$preferencias}<br>{$recojo}<br>{$lateCheck}' data-placement=\"top\"></i></div></td>";
                                        }
                                    }
                                    echo "</tr>";
                                }
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

    <nav id="context-menu" class="context-menu">
        <ul class="context-menu__items">
            <li class="context-menu__item">
                <a href="#" class="context-menu__link" data-action="Checkin" id="checkin" data-id=""><i class="fa fa-sign-in"></i> Registrar Check-In</a>
            </li>
            <li class="context-menu__item">
                <a href="#" class="context-menu__link" data-action="View" id="ver" data-id=""><i class="fa fa-eye"></i> Ver Reserva</a>
            </li>
            <li class="context-menu__item">
                <a href="#" class="context-menu__link" data-action="Edit" id="editar" data-id=""><i class="fa fa-edit"></i> Editar Reserva</a>
            </li>
            <li class="context-menu__item">
                <a href="#" class="context-menu__link" data-action="Delete" id="eliminar" data-id=""><i class="fa fa-times"></i> Eliminar Reserva</a>
            </li>
        </ul>
    </nav>

    <nav id="context-menu1" class="context-menu">
        <ul class="context-menu__items">
            <li class="context-menu__item">
                <a href="#" class="context-menu__link1" data-action="Consumo" id="consumo" data-id=""><i class="fa fa-edit"></i> Registrar Consumo</a>
            </li>
            <li class="context-menu__item">
                <a href="#" class="context-menu__link1" data-action="Checkout" id="checkout" data-id=""><i class="fa fa-sign-out"></i> Registrar Check-Out</a>
            </li>
            <li class="context-menu__item">
                <a href="#" class="context-menu__link1" data-action="Edit" id="editar1" data-id=""><i class="fa fa-eye"></i> Editar Reserva</a>
            </li>
            <li class="context-menu__item">
                <a href="#" class="context-menu__link1" data-action="View" id="ver1" data-id=""><i class="fa fa-eye"></i> Ver Reserva</a>
            </li>
        </ul>
    </nav>

    <nav id="context-menu2" class="context-menu">
        <ul class="context-menu__items">
            <li class="context-menu__item">
                <a href="#" class="context-menu__link2" data-action="View" id="ver2" data-id=""><i class="fa fa-eye"></i> Ver Reserva</a>
            </li>
        </ul>
    </nav>

<?php
    include('footer.php');
}
?>