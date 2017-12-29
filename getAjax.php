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
