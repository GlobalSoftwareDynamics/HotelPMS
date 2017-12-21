<?php
include('declaracionFechas.php');
include('funciones.php');
/*if(isset($_SESSION['login'])){*/
include('header.php');
include('navbarRecepcion.php');

/*$result = mysqli_query($link,"SELECT * FROM Proveedor WHERE idProveedor = '{$_POST['idProveedor']}'");
while($row = mysqli_fetch_array($result)) {
    $result1 = mysqli_query($link,"SELECT * FROM Direccion WHERE idDireccion = '{$row['idDireccion']}'");
    while ($fila = mysqli_fetch_array($result1)){
        $direccion = $fila['direccion'];
        $result2 = mysqli_query($link,"SELECT * FROM Ciudad WHERE idCiudad = '{$fila['idCiudad']}'");
        while ($fila1 = mysqli_fetch_array($result2)){
            $ciudad = $fila1['nombre'];
            $result3 = mysqli_query($link,"SELECT * FROM Pais WHERE idPais = '{$fila1['idPais']}'");
            while ($fila2 = mysqli_fetch_array($result3)){
                $pais = $fila2['pais'];
            }
        }
    }*/
?>

<section class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-inverse card-info">
                    <div class="float-left">
                        <i class="fa fa-bed"></i>
                        Editar Habitación
                    </div>
                    <div class="float-right">
                        <div class="dropdown">
                            <input type='submit' value='Guardar' name='guardar' class='btn btn-light btn-sm' form="form">
                            <input type='submit' value='Regresar' name='regresar' class='btn btn-light btn-sm' form="form">
                        </div>
                    </div>
                </div>
                <div class="card-block">
                    <div class="col-12">
                        <div class="spacer15"></div>
                        <form method="post" action="gestionHabitaciones.php" id="form">
                            <div class="form-group row">
                                <label for="numero" class="col-2 col-form-label">Nro. Habitación:</label>
                                <div class="col-1">
                                    <input class="form-control" type="number" id="numero" name="numero" value="303">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tipoHabitacion" class="col-2 col-form-label">Tipo Habitación:</label>
                                <div class="col-10">
                                    <select class="form-control" name="tipoHabitacion" id="tipoHabitacion">
                                        <option>Seleccionar</option>
                                        <option value="1">Simple</option>
                                        <option value="2">Doble</option>
                                        <option value="3" selected>Matrimonial</option>
                                        <option value="3">Suite</option>
                                        <option value="3">Suite Ejecutiva</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="vista" class="col-2 col-form-label">Vista:</label>
                                <div class="col-10">
                                    <select class="form-control" name="vista" id="vista">
                                        <option disabled selected>Seleccionar</option>
                                        <option>Seleccionar</option>
                                        <option value="1">Calle</option>
                                        <option value="2" selected>Jardines</option>
                                        <option value="3">Pasillo</option>
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
                <div class="card-header card-inverse card-info">
                    <div class="float-left">
                        <i class="fa fa-info-circle"></i>
                        Características
                    </div>
                </div>
                <div class="card-block">
                    <div class="col-12">
                        <form method="post">
                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <th>Característica</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Capacidad:</td>
                                    <td>4</td>
                                    <td><input type="submit" name="eliminarCaracteristica" value="Eliminar" class="btn btn-outline-primary"></td>
                                </tr>
                                <tr>
                                    <td>Nro. Camas:</td>
                                    <td>1</td>
                                    <td><input type="submit" name="eliminarCaracteristica" value="Eliminar" class="btn btn-outline-primary"></td>
                                </tr>
                                <tr>
                                    <td>Tipo de Cama:</td>
                                    <td>King Size</td>
                                    <td><input type="submit" name="eliminarCaracteristica" value="Eliminar" class="btn btn-outline-primary"></td>
                                </tr>
                                <tr>
                                    <td>Jacuzzi:</td>
                                    <td>Si</td>
                                    <td><input type="submit" name="eliminarCaracteristica" value="Eliminar" class="btn btn-outline-primary"></td>
                                </tr>
                                <tr>
                                    <td>Sala:</td>
                                    <td>Si</td>
                                    <td><input type="submit" name="eliminarCaracteristica" value="Eliminar" class="btn btn-outline-primary"></td>
                                </tr>
                                <tr>
                                    <td>Balcón:</td>
                                    <td>Si</td>
                                    <td><input type="submit" name="eliminarCaracteristica" value="Eliminar" class="btn btn-outline-primary"></td>
                                </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-outline-primary col-4 offset-4 mb-3" data-toggle="modal" data-target="#modalCaracteristica">Agregar Característica</button>
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
                <div class="card-header card-inverse card-info">
                    <div class="float-left">
                        <i class="fa fa-money"></i>
                        Tarifas
                    </div>
                </div>
                <div class="card-block">
                    <div class="col-12">
                        <form method="post">
                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <th class="text-center">Descripción</th>
                                    <th class="text-center">Costo</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Regular</td>
                                    <td>$ 120.00</td>
                                    <td><input type="submit" name="eliminarTarifa" value="Eliminar" class="btn btn-outline-primary"></td>
                                </tr>
                                <tr>
                                    <td>Temp. Alta</td>
                                    <td>$ 180.00</td>
                                    <td><input type="submit" name="eliminarTarifa" value="Eliminar" class="btn btn-outline-primary"></td>
                                </tr>
                                <tr>
                                    <td>Temp. Baja</td>
                                    <td>$ 100.00</td>
                                    <td><input type="submit" name="eliminarTarifa" value="Eliminar" class="btn btn-outline-primary"></td>
                                </tr>
                                <tr>
                                    <td>Noche de Bodas</td>
                                    <td>$ 80.00</td>
                                    <td><input type="submit" name="eliminarTarifa" value="Eliminar" class="btn btn-outline-primary"></td>
                                </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-outline-primary col-4 offset-4 mb-3" data-toggle="modal" data-target="#modalTarifa">Asignar Nueva Tarifa</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modalCaracteristica" tabindex="-1" role="dialog" aria-labelledby="modalCaracteristica" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Característica de Habitación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="formCaracteristica" method="post" action="#">
                        <div class="form-group row">
                            <label class="col-form-label" for="caracteristica">Característica:</label>
                            <select name="caracteristica" id="caracteristica" class="form-control">
                                <option disabled selected>Seleccionar</option>
                                <option value="1">Capacidad</option>
                                <option value="2">Nro. de Camas</option>
                                <option value="3">Balcón</option>
                                <option value="3">Jacuzzi</option>
                                <option value="3">Tipo de Cama</option>
                                <option value="3">Sala</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label" for="detalle">Detalle:</label>
                            <input type="text" name="detalle" id="detalle" class="form-control">
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button form="formCaracteristica" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-primary" form="formCaracteristica" value="Submit" name="addCaracteristica">Guardar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTarifa" tabindex="-1" role="dialog" aria-labelledby="modalTarifa" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Asignar Nueva Tarifa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="formTarifa" method="post" action="#">
                        <div class="form-group row">
                            <label class="col-form-label" for="tarifa">Tarifa:</label>
                            <select name="tarifa" id="tarifa" class="form-control">
                                <option disabled selected>Seleccionar</option>
                                <option value="1">Regular</option>
                                <option value="2">Temp. Alta</option>
                                <option value="3">Temp. Baja</option>
                                <option value="3">Noche de Bodas</option>
                                <option value="3">Viaje de Negocios</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button form="formTarifa" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-primary" form="formTarifa" value="Submit" name="addTarifa">Guardar</button>
            </div>
        </div>
    </div>
</div>

<?php
/*}*/
include('footer.php');
/*}*/
?>
