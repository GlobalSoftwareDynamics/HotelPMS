<?php
include('session.php');
include('funciones.php');

if(!empty($_POST['idPais'])){
    echo "<option disabled selected>Seleccionar</option>";
    $result = mysqli_query($link,"SELECT * FROM EstadoPais WHERE idPais = '{$_POST['idPais']}' ORDER BY nombre ASC");
    while ($fila = mysqli_fetch_array($result)){
        echo "<option value='{$fila['idEstadoPais']}'>{$fila['nombre']}</option>";
    }
}

if(!empty($_POST['idEstado'])){
    echo "<option disabled selected>Seleccionar</option>";
    $result = mysqli_query($link,"SELECT * FROM Ciudad WHERE idEstadoPais = '{$_POST['idEstado']}' ORDER BY nombre ASC");
    while ($fila = mysqli_fetch_array($result)){
        echo "<option value='{$fila['idCiudad']}'>{$fila['nombre']}</option>";
    }
}

if(!empty($_POST['descuento'])&&!empty($_POST['montoTotalPago'])){
    $montoFinal = $_POST['montoTotalPago'] * (1-($_POST['descuento']/100));
    $montoFinal = round($montoFinal,2);
    echo "<input type='number' min='0' max='{$montoFinal}' class='form-control' step='0.01' name='montoCancelado' id='montoCancelado' value='{$montoFinal}'>";
}

if(!empty($_POST['descuentoB'])&&!empty($_POST['montoTotalPagoB'])){
    $montoFinal1 = $_POST['montoTotalPagoB'] * (1-($_POST['descuentoB']/100));
    $montoFinal1 = round($montoFinal1,2);
    echo "<input type=\"hidden\" name=\"montoHabitacionReserva\" value='{$montoFinal1}'>";
}

if(!empty($_POST['nombreHuesped'])){
	$flag = true;
	$result = mysqli_query($link,"SELECT * FROM Huesped WHERE nombreCompleto = '{$_POST['nombreHuesped']}' OR idHuesped = '{$_POST['nombreHuesped']}'");
	while($row = mysqli_fetch_array($result)){
		$flag = false;
		echo "<label class='col-form-label' for='dni'>DNI Titular:</label>
			<select class='form-control' name='dni' id='dni' onchange='getNombre(this.value);getTelf(this.value);getEmail(this.value)'>";
			$result2 = mysqli_query($link,"SELECT * FROM Huesped WHERE nombreCompleto = '{$_POST['nombreHuesped']}'");
			while($row2 = mysqli_fetch_array($result2)){
				echo "<option value='{$row2['idHuesped']}'>{$row2['idHuesped']}</option>";
			}
		echo "</select>";
		break;
	}
	if($flag){
		echo "<label class='col-form-label' for='dni'>DNI Titular:</label>
			<input type='number' name='dni' id='dni' class='form-control'>
			<input type='hidden' name='clienteNuevo' value='true'>";
	}
}

if(!empty($_POST['nombreHuespedReserva'])){
	$flag = true;
	$result = mysqli_query($link,"SELECT * FROM Huesped WHERE nombreCompleto = '{$_POST['nombreHuespedReserva']}' OR idHuesped = '{$_POST['nombreHuespedReserva']}'");
	while($row = mysqli_fetch_array($result)){
		$flag = false;
		echo "<select class='form-control' name='dni' id='dni' onchange='getNombre2(this.value);' form='formOcupante'>";
		$result2 = mysqli_query($link,"SELECT * FROM Huesped WHERE nombreCompleto = '{$_POST['nombreHuespedReserva']}'");
		while($row2 = mysqli_fetch_array($result2)){
			echo "<option value='{$row2['idHuesped']}'>{$row2['idHuesped']}</option>";
		}
		echo "</select>";
		break;
	}
	if($flag){
		echo "<input type='number' name='dni' id='dni' class='form-control' placeholder='DNI' form='formOcupante'>
			<input type='hidden' name='clienteNuevo2' value='true' form='formOcupante'>";
	}
}



if(!empty($_POST['nombreHuesped2'])){
	$flag = true;
	$result = mysqli_query($link,"SELECT * FROM Huesped WHERE nombreCompleto = '{$_POST['nombreHuesped2']}' OR idHuesped = '{$_POST['nombreHuesped2']}'");
	while($row = mysqli_fetch_array($result)){
		$flag = false;
		echo "<label class='col-form-label' for='telefono'>Teléfono Celular:</label>
			<input type='text' name='telefono' id='telefono' class='form-control' value='{$row['telefonoCelular']}'>
			<input type='hidden' name='antiguoCliente' value='true'>";
		break;
	}
	if($flag){
		echo "<label class='col-form-label' for='telefono'>Teléfono Celular:</label>
			<input type='text' name='telefono' id='telefono' class='form-control'>
			<input type='hidden' name='clienteNuevo' value='true'>";
	}
}

if(!empty($_POST['nombreHuesped3'])){
	$flag = true;
	$result = mysqli_query($link,"SELECT * FROM Huesped WHERE nombreCompleto = '{$_POST['nombreHuesped3']}' OR idHuesped = '{$_POST['nombreHuesped3']}'");
	while($row = mysqli_fetch_array($result)){
		$flag = false;
		echo "<label class='col-form-label' for='email'>Correo Electrónico:</label>
			<input type='email' name='email' id='email' class='form-control' value='{$row['correoElectronico']}'>
			<input type='hidden' name='antiguoCliente' value='true'>";
		break;
	}
	if($flag){
		echo "<label class='col-form-label' for='email'>Correo Electrónico:</label>
			<input type='email' name='email' id='email' class='form-control'>
			<input type='hidden' name='clienteNuevo' value='true'>";
	}
}

if(!empty($_POST['nombreHuesped4'])){
	$flag = true;
	$result = mysqli_query($link,"SELECT * FROM Huesped WHERE nombreCompleto = '{$_POST['nombreHuesped4']}' OR idHuesped = '{$_POST['nombreHuesped4']}'");
	while($row = mysqli_fetch_array($result)){
		$flag = false;
		echo "<label class='col-form-label' for='nombres'>Nombre Completo:</label>
			<input type='text' name='nombres' id='nombres' class='form-control' value='{$row['nombreCompleto']}'>
			<input type='hidden' name='antiguoCliente' value='true'>";
		break;
	}
	if($flag){
		echo "<label class='col-form-label' for='nombres'>Nombre Completo:</label>
			<input type='text' name='nombres' id='nombres' class='form-control'>
			<input type='hidden' name='clienteNuevo' value='true'>";
	}
}

if(!empty($_POST['nombreHuespedReserva2'])){
	$flag = true;
	$result = mysqli_query($link,"SELECT * FROM Huesped WHERE nombreCompleto = '{$_POST['nombreHuespedReserva2']}' OR idHuesped = '{$_POST['nombreHuespedReserva2']}'");
	while($row = mysqli_fetch_array($result)){
		$flag = false;
		echo "<input type='text' name='nombres' id='nombres' class='form-control' value='{$row['nombreCompleto']}' form='formOcupante'>
			<input type='hidden' name='antiguoCliente' value='true' form='formOcupante'>";
		break;
	}
	if($flag){
		echo "<input type='text' name='nombres' id='nombres' class='form-control' placeholder='Nombre Completo' form='formOcupante'>
			<input type='hidden' name='clienteNuevo2' value='true' form='formOcupante'>";
	}
}

if(!empty($_POST['tipoHabitacion'])&&!empty($_POST['fechaInicioCheckIn'])&&!empty($_POST['fechaFinCheckOut'])){

    echo "<option disabled selected>Seleccionar</option>";
    $interval = timeInterval($_POST['fechaInicioCheckIn'],$_POST['fechaFinCheckOut']);
    $date1 = date('Y-m-d', strtotime($_POST['fechaInicioCheckIn'] . ' -1 day'));
    for($j = 0; $j <= $interval; $j++){
        $date1 = date('Y-m-d', strtotime($date1 . ' +1 day'));
        $arrayFechas[$j] = $date1;
    }

    $result = mysqli_query($link,"SELECT * FROM Habitacion WHERE idTipoHabitacion = '{$_POST['tipoHabitacion']}'");
    while ($row = mysqli_fetch_array($result)){
        $result1 = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE idHabitacion = '{$row['idHabitacion']}' AND idEstado IN (3,4)");
        $numrow = mysqli_num_rows($result1);
        if($numrow == 0){
            echo "<option value='{$row['idHabitacion']}'>{$row['idHabitacion']}</option>";
        }else{
            while($row1 = mysqli_fetch_array($result1)){
                $arrayFechasOcupadas = array();
                $fechaInicio = explode(" ",$row1['fechaInicio']);
                $fechaFin = explode(" ",$row1['fechaFin']);
                $intervala = timeInterval($fechaInicio[0],$fechaFin[0]);
                $date2 = date('Y-m-d', strtotime($fechaInicio[0] . ' -1 day'));

                switch($row1['modificadorCheckIO']){
                    case 0:
                        $intervala -= 1;
                        break;
                    case 1:
                        $intervala -= 1;
                        $date2 = date('Y-m-d', strtotime($date2 . ' -1 day'));
                        break;
                    case 2:
                        break;
                    case 3:
                        $date2 = date('Y-m-d', strtotime($date2 . ' -1 day'));
                        break;
                }

                for($j = 0; $j <= $intervala; $j++){
                    $date2 = date('Y-m-d', strtotime($date2 . ' +1 day'));
                    $arrayFechasOcupadas[$j] = $date2;
                }

                $coincidencia = array_intersect($arrayFechas,$arrayFechasOcupadas);

                if(!empty($coincidencia[0])){

                }else{
                    echo "<option value='{$row['idHabitacion']}'>{$row['idHabitacion']}</option>";
                }
            }
        }
    }
}

if(!empty($_POST['tipoHabitacion2'])){
	$result = mysqli_query($link,"SELECT * FROM Tarifa WHERE idTipoHabitacion = '{$_POST['tipoHabitacion2']}'");
	while($row = mysqli_fetch_array($result)){
		echo "<option value='{$row['idTarifa']}'>{$row['descripcion']} - {$row['valor']}</option>";
	}
}

if(!empty($_POST['razonSocial'])){
    $result = mysqli_query($link,"SELECT * FROM Empresa WHERE idEmpresa IN (SELECT idEmpresa FROM Huesped WHERE idHuesped = '{$_POST['razonSocial']}')");
    $numrow = mysqli_num_rows($result);
    if ($numrow > 0){
        while($row = mysqli_fetch_array($result)){
            echo "<option value='{$row['idEmpresa']}' selected>{$row['razonSocial']}</option>";
        }
    }
    echo "<option>Seleccionar</option>";
    $result = mysqli_query($link,"SELECT * FROM Empresa ORDER BY razonSocial ASC");
    while ($fila = mysqli_fetch_array($result)){
        echo "<option value='{$fila['idEmpresa']}'>{$fila['razonSocial']}</option>";
    }
}

if(!empty($_POST['razonSocialB'])){
    $result = mysqli_query($link,"SELECT * FROM Empresa WHERE idEmpresa IN (SELECT idEmpresa FROM Huesped WHERE nombreCompleto = '{$_POST['razonSocialB']}')");
    $numrow = mysqli_num_rows($result);
    if ($numrow > 0){
        while($row = mysqli_fetch_array($result)){
            echo "<option value='{$row['idEmpresa']}' selected>{$row['razonSocial']}</option>";
        }
    }
    echo "<option>Seleccionar</option>";
    $result = mysqli_query($link,"SELECT * FROM Empresa ORDER BY razonSocial ASC");
    while ($fila = mysqli_fetch_array($result)){
        echo "<option value='{$fila['idEmpresa']}'>{$fila['razonSocial']}</option>";
    }
}

if(!empty($_POST['datosOcupante'])){
    $result = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped = '{$_POST['datosOcupante']}'");
    $numrow = mysqli_num_rows($result);
    if($numrow == 0){
        echo "
        <div class=\"form-group col-6\">
            <label class=\"col-form-label\" for=\"nombres\">Nombre Completo:</label>
            <input type=\"text\" name=\"nombres\" id=\"nombres\" class=\"form-control\">
        </div>
        <div class=\"form-group col-6\">
            <label class=\"col-form-label\" for=\"genero\">Género:</label>
            <select name=\"genero\" id=\"genero\" class=\"form-control\">
                <option disabled selected>Seleccionar</option>";
        $result1 = mysqli_query($link,"SELECT * FROM Genero");
        while ($fila1 = mysqli_fetch_array($result1)){
            echo "<option value='{$fila1['idGenero']}'>{$fila1['idGenero']}</option>";
        }
        echo "
            </select>
        </div>
        <div class=\"form-group col-6\">
            <label class=\"col-form-label\" for=\"celular\">Teléfono Celular:</label>
            <input type=\"number\" min=\"0\" name=\"celular\" id=\"celular\" class=\"form-control\">
        </div>
        <div class=\"form-group col-6\">
            <label class=\"col-form-label\" for=\"fijo\">Teléfono Fijo:</label>
            <input type=\"number\" min=\"0\" name=\"fijo\" id=\"fijo\" class=\"form-control\">
        </div>
        <div class=\"form-group col-6\">
            <label class=\"col-form-label\" for=\"fechaNacimiento\">Fecha de Nacimiento:</label>
            <input type=\"date\" name=\"fechaNacimiento\" id=\"fechaNacimiento\" class=\"form-control\">
        </div>
        <div class=\"form-group col-6\">
            <label class=\"col-form-label\" for=\"email\">Correo Electrónico:</label>
            <input type=\"email\" name=\"email\" id=\"email\" class=\"form-control\">
        </div>
        <div class=\"form-group col-6\">
            <label class=\"col-form-label\" for=\"direccion\">Dirección:</label>
            <input type=\"text\" name=\"direccion\" id=\"direccion\" class=\"form-control\">
        </div>
        <div class=\"form-group col-6\">
            <label class=\"col-form-label\" for=\"direccion\">País:</label>
            <select class=\"form-control\" name=\"pais\" id=\"pais\" onchange=\"getEstado(this.value)\">
                <option selected disabled>Seleccionar</option>";
        $result = mysqli_query($link,"SELECT * FROM Pais ORDER BY nombre ASC");
        while ($fila = mysqli_fetch_array($result)){
            echo "<option value='{$fila['idPais']}'>{$fila['nombre']}</option>";
        }
        echo "
            </select>
        </div>
        <div class=\"form-group col-6\">
            <label class=\"col-form-label\" for=\"direccion\">Estado:</label>
            <select class=\"form-control\" name=\"estado\" id=\"estado\" onchange=\"getCiudad(this.value)\">
               <option selected disabled>Seleccionar</option>
        ";
        $result = mysqli_query($link,"SELECT * FROM EstadoPais ORDER BY nombre ASC");
        while ($fila = mysqli_fetch_array($result)){
            echo "<option value='{$fila['idEstadoPais']}'>{$fila['nombre']}</option>";
        }
        echo "
            </select>
        </div>
        <div class=\"form-group col-6\">
            <label class=\"col-form-label\" for=\"direccion\">Ciudad:</label>
            <select class=\"form-control\" name=\"ciudad\" id=\"ciudad\">
                <option selected disabled value=\"Seleccionar\">Seleccionar</option>
        ";
        $result = mysqli_query($link,"SELECT * FROM Ciudad ORDER BY nombre ASC");
        while ($fila = mysqli_fetch_array($result)){
            echo "<option value='{$fila['idCiudad']}'>{$fila['nombre']}</option>";
        }
        echo "
            </select>
        </div>
        ";
    }else{
        while ($fila = mysqli_fetch_array($result)){
            $nombreCompleto = $fila['nombreCompleto'];
            echo "
                  <div class=\"form-group col-12\">
                       <label class=\"col-form-label\" for=\"nombres\">Nombre Completo:</label>
                       <input type=\"text\" name=\"nombres\" id=\"nombres\" class=\"form-control\" value='{$nombreCompleto}'>
                  </div>
            ";
        }
    }
}

if(isset($_POST['tipoReserva'])){
    if($_POST['tipoReserva'] == 10){
        echo "<select class='form-control' name='paqueteSeleccionado'>";
            echo "<option selected disabled>Seleeccionar</option>";
            $query = mysqli_query($link,"SELECT * FROM Paquete");
            while($row = mysqli_fetch_array($query)){
                echo "<option value='{$row['idPaquete']}'>{$row['nombre']}</option>";
            }
        echo "</select>";
    }
}

if(!empty($_POST['fechaGuia'])){

    ?>
    <table class="bordered-calendar text-center">
        <thead>
        <tr>
            <th class="habitacion">Habitación</th>
            <?php
            $date1 = date("Y-m-d", strtotime($_POST['fechaGuia'] . ' -9 days'));
            $dateIni = date("Y-m-d", strtotime($_POST['fechaGuia'] . ' -8 days'));
            $dateFin = date("Y-m-d", strtotime($_POST['fechaGuia'] . ' +11 days'));
            $arrayFechas = array();
            for($i = 0; $i < 20; $i++){
                $date1 = date('Y-m-d', strtotime($date1 . ' +1 day'));
                $arrayFechas[$i] = $date1;
                $hoy = "";
                if($date1 == $_POST['fechaGuia']){
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
            echo "
                <script>
                   $(function () {
                       $('[data-toggle=\"popover\"]').popover()
                   });
                </script>
            ";
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
                for($i = 0; $i < 20; $i = $i+$interval){
                    $result2 = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE fechaInicio <= '{$arrayFechas[$i]} 23:59:59' AND fechaFin > '{$arrayFechas[$i]}' AND idHabitacion = '{$fila1['idHabitacion']}' AND idEstado IN (3,4,5,8)");
                    $numrow = mysqli_num_rows($result2);
                    if($arrayFechas[$i] == $dateIni){
                        while ($fila2 = mysqli_fetch_array($result2)){
                            $fechaInicio = explode("-",$dateIni);
                            $date1 = date_create("{$fechaInicio[0]}-{$fechaInicio[1]}-{$fechaInicio[2]}");
                            $fechaFin = explode(" ",$fila2['fechaFin']);
                            $fechaFin = explode("-",$fechaFin[0]);
                            $date2 = date_create("{$fechaFin[0]}-{$fechaFin[1]}-{$fechaFin[2]}");
                            $interval = date_diff($date1,$date2);
                            $interval = $interval->d;
                            if($date1 == $date2){
                                $interval = $interval +1;
                            }
                            if($idReserva == $fila2['idReserva']){
                                $flag = true;
                            }
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
                            $fechaInicio = explode(" ",$fila2['fechaInicio']);
                            $fechaInicio = explode("-",$fechaInicio[0]);
                            $date1 = date_create("{$fechaInicio[0]}-{$fechaInicio[1]}-{$fechaInicio[2]}");
                            $fechaFin = explode("-",$dateFin);
                            $date2 = date_create("{$fechaFin[0]}-{$fechaFin[1]}-{$fechaFin[2]}");
                            $interval = date_diff($date1,$date2);
                            $interval = $interval->d;
                            if($date1 == $date2){
                                $interval = $interval +1;
                            }
                            if($idReserva == $fila2['idReserva']){
                                $flag = true;
                            }
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
                            $fechaInicio = explode(" ",$fila2['fechaInicio']);
                            $fechaInicio = explode("-",$fechaInicio[0]);
                            $date1 = date_create("{$fechaInicio[0]}-{$fechaInicio[1]}-{$fechaInicio[2]}");
                            $fechaFin = explode(" ",$fila2['fechaFin']);
                            $fechaFin = explode("-",$fechaFin[0]);
                            $date2 = date_create("{$fechaFin[0]}-{$fechaFin[1]}-{$fechaFin[2]}");
                            $interval = date_diff($date1,$date2);
                            $interval = $interval->d;
                            if($date1 == $date2){
                                $interval = $interval +1;
                            }
                            if($idReserva == $fila2['idReserva']){
                                $flag = true;
                            }
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
    <?php
}
