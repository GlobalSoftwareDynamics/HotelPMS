<?php
include('session.php');

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

if(!empty($_POST['tipoHabitacion'])){
	$result = mysqli_query($link,"SELECT * FROM Habitacion WHERE idTipoHabitacion = '{$_POST['tipoHabitacion']}'");
	while($row = mysqli_fetch_array($result)){
		echo "<option value='{$row['idHabitacion']}'>{$row['idHabitacion']}</option>";
	}
}

if(!empty($_POST['tipoHabitacion2'])){
	$result = mysqli_query($link,"SELECT * FROM Tarifa WHERE idTipoHabitacion = '{$_POST['tipoHabitacion2']}'");
	while($row = mysqli_fetch_array($result)){
		echo "<option value='{$row['idTarifa']}'>{$row['descripcion']} - {$row['valor']}</option>";
	}
}
