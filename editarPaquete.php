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
                        <i class="fa fa-shopping-bag"></i>
                        Editar Paquete
                    </div>
                    <div class="float-right">
                        <div class="dropdown">
                            <input type='submit' value='Regresar' name='regresar' class='btn btn-light btn-sm' form="form">
                            <input type='submit' value='Guardar' name='editar' class='btn btn-light btn-sm' form="form">
                        </div>
                    </div>
                </div>
                <div class="card-block">
                    <div class="col-12">
                        <div class="spacer15"></div>
                        <form method="post" action="gestionHabitaciones.php" id="form">
                            <div class="form-group row">
                                <label for="nombre" class="col-2 col-form-label">Nombre:</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" id="nombre" name="nombre" value="Paquete Noche de Bodas">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="noches" class="col-2 col-form-label">Nro. de Noches:</label>
                                <div class="col-1">
                                    <input class="form-control" type="number" id="noches" name="noches" value="4">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="descripcionAdicionales" class="col-2 col-form-label">Adicionales:</label>
                                <div class="col-10">
                                    <textarea class="form-control" id="descripcionAdicionales" name="descripcionAdicionales" rows="3">Incluye decoración, botella de Champagne, Bouquet de Rosas.</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="valorAdicionales" class="col-2 col-form-label">Valor Adicionales:</label>
                                <div class="col-2">
                                    <input class="form-control" type="number" id="valorAdicionales" name="valorAdicionales" value="80">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="moneda" class="col-2 col-form-label">Moneda:</label>
                                <div class="col-10">
                                    <select name="moneda" id="moneda" class="form-control">
                                        <option>Seleccionar</option>
                                        <option value="1" selected>Dólares</option>
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
</section>

<div class="spacer15"></div>
<section class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-inverse card-info">
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
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Matrimonial</td>
                                    <td>1</td>
                                    <td>Regular: $ 120.00</td>
                                    <td><input type="submit" name="eliminarTarifa" value="Eliminar" class="btn btn-sm btn-outline-primary"></td>
                                </tr>
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
                        <div class="form-group row">
                            <label class="col-form-label" for="habitacion">Habitación:</label>
                            <select name="habitacion" class="form-control" id="habitacion">
                                <option>Seleccionar</option>
                                <option>Simple</option>
                                <option>Doble</option>
                                <option selected>Matrimonial</option>
                                <option>Suite</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label" for="cantidad">Cantidad:</label>
                            <input type="number" class="form-control" value="1" name="cantidadHabitacion" id="cantidad">
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label" for="tarifa">Tarifa:</label>
                            <select name="tarifa" class="form-control" id="tarifa">
                                <option>Seleccionar</option>
                                <option value="1" selected>Regular</option>
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
                <button form="formHabitacion" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-primary" form="formHabitacion" value="Submit" name="addHabitacion">Guardar</button>
            </div>
        </div>
    </div>
</div>

<?php
/*}*/
include('footer.php');
/*}*/
?>
