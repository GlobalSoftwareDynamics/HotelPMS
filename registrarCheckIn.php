<?php
include('session.php');
include('funciones.php');
include('declaracionFechas.php');
if(isset($_SESSION['login'])){
    include('header.php');
    include('navbarRecepcion.php');

    if (isset($_POST['addOcupante'])){

    }

    $result = mysqli_query($link,"SELECT * FROM Reserva WHERE idReserva = '{$_POST['idReserva']}'");
    while ($fila = mysqli_fetch_array($result)){
        $fechaReserva = explode(" ",$fila['fechaReserva']);
        if($fila['idEstado'] == 9){
            ?>
            <form method="post" id="formCheckIn">
            <section class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header card-inverse card-info">
                                <div class="float-left mt-1">
                                    <i class="fa fa-money"></i>
                                    &nbsp;&nbsp;Check In
                                </div>
                                <div class="float-right">
                                    <div class="dropdown">
                                        <input name="checkIn" type="submit" form="formCheckIn" class="btn btn-light btn-sm" formaction="detalleReserva.php" value="Confirmar Reserva">
                                        <input name="regresar" type="submit" form="formCheckIn" class="btn btn-light btn-sm" formaction="mainRecepcion.php" value="Regresar">
                                    </div>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="col-12">
                                    <div class="spacer20"></div>
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label for="idReserva" class="col-2 col-form-label">Reserva:</label>
                                            <div class="col-10">
                                                <input class="form-control" type="text" id="idReserva" name="idReserva" value="<?php echo $_POST['idReserva'];?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="idHabitacion" class="col-2 col-form-label">Habitación:</label>
                                            <div class="col-10">
                                                <input class="form-control" type="text" id="idHabitacion" name="idHabitacion" value="<?php echo $_POST['idHabitacion'];?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="fechaReserva" class="col-2 col-form-label">Fecha de Reserva:</label>
                                            <div class="col-10">
                                                <input class="form-control" type="text" id="fechaReserva" name="fechaReserva" value="<?php echo $fechaReserva;?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="fechaReserva" class="col-2 col-form-label">Preferencias:</label>
                                            <div class="col-10">
                                                <input class="form-control" type="text" id="fechaReserva" name="fechaReserva" value="<?php echo $fechaReserva;?>">
                                            </div>
                                            <div class="col-4"><p><b>Preferencias:</b></p></div>
                                            <div class="col-8"><p><?php echo $empresa?></p></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-4"><p><b>Cama Adicional:</b></p></div>
                                            <div class="col-8"><p><?php echo $fila['correoElectronico']?></p></div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <div class="col-3"><p><b>Nombre del Titular:</b></p></div>
                                            <div class="col-9"><p><?php echo $fila['telefonoCelular']?></p></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-3"><p><b>Correo Eléctronico:</b></p></div>
                                            <div class="col-9"><p><?php echo $fila['telefonoFijo']?></p></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-3"><p><b>Teléfono Celular:</b></p></div>
                                            <div class="col-9"><p><?php echo $fila['telefonoFijo']?></p></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-3"><p><b>Teléfono Fijo:</b></p></div>
                                            <div class="col-9"><p><?php echo $fila['telefonoFijo']?></p></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-3"><p><b>Dirección:</b></p></div>
                                            <div class="col-9"><p><?php echo $fila['direccion']?></p></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <?php
        }elseif ($fila['idEstado'] == 3){
            $result1 = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");
            while ($fila1 = mysqli_fetch_array($result1)){
                $preferencias = $fila1['preferencias'];
                $camaAdicional = $fila1['camaAdicional'];
                $result2 = mysqli_query($link,"SELECT * FROM Ocupantes WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}' AND cargos = '1'");
                while ($fila2 = mysqli_fetch_array($result2)){
                    $result3 = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped = '{$fila2['idHuesped']}'");
                    $numrows = mysqli_num_rows($result3);
                    if ($numrows == 0){
                        $nombreCompleto = "";
                        $idHuesped = "";
                        $correo = "";
                        $celular = "";
                        $fijo = "";
                        $direccion = "";
                        $pais = "Seleccionar";
                        $ciudad = "Seleccionar";
                        $estado = "Seleccionar";
                        $idPais = "Seleccionar";
                        $idCiudad = "Seleccionar";
                        $idEstadoPais = "Seleccionar";
                    }else{
                        while ($fila3 = mysqli_fetch_array($result3)){
                            $nombreCompleto = $fila3['nombreCompleto'];
                            $idHuesped = $fila3['idHuesped'];
                            $correo = $fila3['correoElectronico'];
                            $celular = $fila3['telefonoCelular'];
                            $fijo = $fila3['telefonoFijo'];
                            $direccion = $fila3['direccion'];
                            $result4 = mysqli_query($link,"SELECT * FROM Pais WHERE idPais = '{$fila3['nacionalidad_idPais']}'");
                            while ($fila4 = mysqli_fetch_array($result4)){
                                $pais = $fila4['nombre'];
                                $idPais = $fila4['idPais'];
                            }
                            $result4 = mysqli_query($link,"SELECT * FROM Ciudad WHERE idCiudad = '{$fila3['idCiudad']}'");
                            while ($fila4 = mysqli_fetch_array($result4)){
                                $ciudad = $fila4['nombre'];
                                $idCiudad = $fila4['idCiudad'];
                                $result5 = mysqli_query($link,"SELECT * FROM EstadoPais WHERE idEstadoPais = '{$fila4['idEstadoPais']}'");
                                while ($fila5 = mysqli_fetch_array($result5)){
                                    $estado = $fila5['nombre'];
                                    $idEstadoPais = $fila5['idEstadoPais'];
                                }
                            }
                        }
                    }
                }
            }
            ?>
                <section class="container">
                    <form method="post" id="formCheckIn">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header card-inverse card-info">
                                        <div class="float-left mt-1">
                                            <i class="fa fa-list"></i>
                                            &nbsp;&nbsp;Check In
                                        </div>
                                        <div class="float-right">
                                            <div class="dropdown">
                                                <input name="checkIn" type="submit" form="formCheckIn" class="btn btn-light btn-sm" formaction="detalleReserva.php" value="Finalizar Check In">
                                                <input name="regresar" type="submit" form="formCheckIn" class="btn btn-light btn-sm" formaction="mainRecepcion.php" value="Regresar">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="spacer20"></div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label for="idReserva" class="col-4 col-form-label">Reserva:</label>
                                                    <div class="col-8">
                                                        <input class="form-control" type="text" id="idReserva" name="idReserva" value="<?php echo $_POST['idReserva'];?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="idHabitacion" class="col-4 col-form-label">Habitación:</label>
                                                    <div class="col-3">
                                                        <input class="form-control" type="number" min="0" id="idHabitacion" name="idHabitacion" value="<?php echo $_POST['idHabitacion'];?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="fechaReserva" class="col-4 col-form-label">Fecha de Reserva:</label>
                                                    <div class="col-8">
                                                        <input class="form-control" type="text" id="fechaReserva" name="fechaReserva" value="<?php echo $fechaReserva[0];?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="preferencias" class="col-4 col-form-label">Preferencias:</label>
                                                    <div class="col-8">
                                                        <textarea class="form-control" rows="3" id="preferencias" name="preferencias"><?php echo $preferencias;?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="camaAdicional" class="col-4 col-form-label">Cama Adicional:</label>
                                                    <div class="col-2">
                                                        <input class="form-control" type="number" min="0" max="1" id="camaAdicional" name="camaAdicional" value="<?php echo $camaAdicional;?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label for="dni" class="col-4 col-form-label">DNI:</label>
                                                    <div class="col-8">
                                                        <input class="form-control" type="number" min="0" id="dni" name="dni" value="<?php echo $idHuesped;?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="nombreCompleto" class="col-4 col-form-label">Nombre del Titular:</label>
                                                    <div class="col-8">
                                                        <input class="form-control" type="text" id="nombreCompleto" name="nombreCompleto" value="<?php echo $nombreCompleto;?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="email" class="col-4 col-form-label">Correo Electrónico:</label>
                                                    <div class="col-8">
                                                        <input class="form-control" type="email" id="email" name="email" value="<?php echo $correo;?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="celular" class="col-4 col-form-label">Teléfono Celular:</label>
                                                    <div class="col-8">
                                                        <input class="form-control" type="number" min="0" id="celular" name="celular" value="<?php echo $celular;?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="fijo" class="col-4 col-form-label">Teléfono Fijo:</label>
                                                    <div class="col-8">
                                                        <input class="form-control" type="number" min="0" id="fijo" name="fijo" value="<?php echo $fijo;?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="direccion" class="col-4 col-form-label">Dirección:</label>
                                                    <div class="col-8">
                                                        <input class="form-control" type="text" id="direccion" name="direccion" value="<?php echo $direccion;?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="pais" class="col-4 col-form-label">Pais:</label>
                                                    <div class="col-8">
                                                        <select class="form-control" name="pais" id="pais" onchange="getEstado(this.value)">
                                                            <option selected disabled value="<?php echo $idPais;?>"><?php echo $pais;?></option>
                                                            <?php
                                                            $result = mysqli_query($link,"SELECT * FROM Pais ORDER BY nombre ASC");
                                                            while ($fila = mysqli_fetch_array($result)){
                                                                echo "<option value='{$fila['idPais']}'>{$fila['nombre']}</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="estado" class="col-4 col-form-label">Estado:</label>
                                                    <div class="col-8">
                                                        <select class="form-control" name="estado" id="estado" onchange="getCiudad(this.value)">
                                                            <option selected disabled value="<?php echo $idEstadoPais;?>"><?php echo $estado;?></option>
                                                            <?php
                                                            $result = mysqli_query($link,"SELECT * FROM EstadoPais ORDER BY nombre ASC");
                                                            while ($fila = mysqli_fetch_array($result)){
                                                                echo "<option value='{$fila['idEstadoPais']}'>{$fila['nombre']}</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="ciudad" class="col-4 col-form-label">Ciudad:</label>
                                                    <div class="col-8">
                                                        <select class="form-control" name="ciudad" id="ciudad">
                                                            <option selected disabled value="<?php echo $idCiudad;?>"><?php echo $ciudad;?></option>
                                                            <?php
                                                            $result = mysqli_query($link,"SELECT * FROM Ciudad ORDER BY nombre ASC");
                                                            while ($fila = mysqli_fetch_array($result)){
                                                                echo "<option value='{$fila['idCiudad']}'>{$fila['nombre']}</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
                <div class="spacer10"></div>
                <section class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header card-inverse card-info">
                                    <div class="float-left mt-1">
                                        <i class="fa fa-users"></i>
                                        &nbsp;&nbsp;Registro de Ocupantes
                                    </div>
                                    <div class="float-right">
                                        <div class="dropdown">
                                            <input name="checkIn" type="submit" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modalOcupante" value="Agregar Ocupante">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="spacer20"></div>
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table text-center">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">DNI</th>
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center">Edad</th>
                                                    <th class="text-center">Email</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $result1 = mysqli_query($link,"SELECT * FROM Ocupantes WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}' AND cargos <> '1'");
                                                while ($fila1 = mysqli_fetch_array($result1)){
                                                    $result3 = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped = '{$fila1['idHuesped']}'");
                                                    while ($fila3 = mysqli_fetch_array($result3)){
                                                        $nombreCompleto = $fila3['nombreCompleto'];
                                                        $idHuesped = $fila3['idHuesped'];
                                                        $correo = $fila3['correoElectronico'];
                                                        $today = explode("-",date("Y-m-d"));
                                                        $fechaCumpleano = explode("-",$fila1['fechaNacimiento']);
                                                        $anios = $today[0] - $fechaCumpleano[0];
                                                        echo "<tr>";
                                                        echo "<td>{$idHuesped}</td>";
                                                        echo "<td>{$nombreCompleto}</td>";
                                                        echo "<td>{$correo}</td>";
                                                        echo "<td>{$anios}</td>";
                                                        echo "<td>
                                                                <form method='post'>
                                                                    <div class=\"dropdown\">
                                                                        <button class=\"btn btn-primary btn-sm dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                                                        Acciones
                                                                        </button>
                                                                        <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                                                                            <input type='hidden' name='idReserva' value='{$fila['idReserva']}'>
                                                                            <input type='hidden' name='idHabitacion' value='{$fila['idHabitacion']}'>
                                                                            <input type='hidden' name='idHuesped' value='{$idHuesped}'>
                                                                            <input type=\"submit\" value=\"Eliminar\" class=\"dropdown-item\" formaction=\"#\">
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                              </td>
                                                        ";
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
                        </div>
                    </div>
                </section>
                <form method="post" action="#">
                    <div class="modal fade" id="modalOcupante" tabindex="-1" role="dialog" aria-labelledby="modalOcupante" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Registro de Ocupante</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <input type="hidden" name="idReserva" value="<?php echo $_POST['idReserva'];?>">
                                        <input type="hidden" name="idHabitacion" value="<?php echo $_POST['idHabitacion'];?>">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label class="col-form-label" for="dni">DNI:</label>
                                                <input type="number" min="0" name="dni" id="dni" class="form-control">
                                            </div>
                                            <div class="form-group col-6">
                                                <label class="col-form-label" for="nombres">Nombre Completo:</label>
                                                <input type="text" name="nombres" id="nombres" class="form-control">
                                            </div>
                                            <div class="form-group col-6">
                                                <label class="col-form-label" for="celular">Teléfono Celular:</label>
                                                <input type="number" min="0" name="celular" id="celular" class="form-control">
                                            </div>
                                            <div class="form-group col-6">
                                                <label class="col-form-label" for="fijo">Teléfono Fijo:</label>
                                                <input type="number" min="0" name="fijo" id="fijo" class="form-control">
                                            </div>
                                            <div class="form-group col-6">
                                                <label class="col-form-label" for="fechaNacimiento">Fecha de Nacimiento:</label>
                                                <input type="date" name="fechaNacimiento" id="fechaNacimiento" class="form-control">
                                            </div>
                                            <div class="form-group col-6">
                                                <label class="col-form-label" for="email">Correo Electrónico:</label>
                                                <input type="email" name="email" id="email" class="form-control">
                                            </div>
                                            <div class="form-group col-6">
                                                <label class="col-form-label" for="direccion">Dirección:</label>
                                                <input type="text" name="direccion" id="direccion" class="form-control">
                                            </div>
                                            <div class="form-group col-6">
                                                <label class="col-form-label" for="direccion">País:</label>
                                                <select class="form-control" name="pais" id="pais" onchange="getEstado(this.value)">
                                                    <option selected disabled>Seleccionar</option>
                                                    <?php
                                                    $result = mysqli_query($link,"SELECT * FROM Pais ORDER BY nombre ASC");
                                                    while ($fila = mysqli_fetch_array($result)){
                                                        echo "<option value='{$fila['idPais']}'>{$fila['nombre']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <label class="col-form-label" for="direccion">Estado:</label>
                                                <select class="form-control" name="estado" id="estado" onchange="getCiudad(this.value)">
                                                    <option selected disabled>Seleccionar</option>
                                                    <?php
                                                    $result = mysqli_query($link,"SELECT * FROM EstadoPais ORDER BY nombre ASC");
                                                    while ($fila = mysqli_fetch_array($result)){
                                                        echo "<option value='{$fila['idEstadoPais']}'>{$fila['nombre']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <label class="col-form-label" for="direccion">Ciudad:</label>
                                                <select class="form-control" name="ciudad" id="ciudad">
                                                    <option selected disabled value="Seleccionar">Seleccionar</option>
                                                    <?php
                                                    $result = mysqli_query($link,"SELECT * FROM Ciudad ORDER BY nombre ASC");
                                                    while ($fila = mysqli_fetch_array($result)){
                                                        echo "<option value='{$fila['idCiudad']}'>{$fila['nombre']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cerrar">
                                    <input type="submit" class="btn btn-primary" name="addOcupante" value="Guardar Cambios">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php
        }
    }
    include('footer.php');
}
?>