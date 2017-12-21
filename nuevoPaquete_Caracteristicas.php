<?php
include('funciones.php');
include('declaracionFechas.php');
/*if(isset($_SESSION['login'])){*/
include('header.php');
include('navbarRecepcion.php');

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
                                            <table class="table table-bordered">
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
                                                            <option>Simple</option>
                                                            <option>Doble</option>
                                                            <option selected>Matrimonial</option>
                                                            <option>Suite</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="number" class="form-control" value="1" name="cantidadHabitacion"></td>
                                                    <td>
                                                        <select name="tarifaHabitacion" class="form-control">
                                                            <option>Seleccionar</option>
                                                            <option value="1" selected>Regular</option>
                                                            <option value="2">Temp. Alta</option>
                                                            <option value="3">Temp. Baja</option>
                                                            <option value="3">Noche de Bodas</option>
                                                            <option value="3">Viaje de Negocios</option>
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
                                                <tr>
                                                    <td>Doble</td>
                                                    <td>1</td>
                                                    <td>Regular</td>
                                                    <td><input type="submit" name="eliminarHabitacion" value="Eliminar" class="btn btn-outline-primary" form="formHabitaciones"></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="Adicionales" role="tabpanel">
                                        <div class="spacer20"></div>
                                        <form method="post" id="formAdicionales">
                                            <div class="form-group row">
                                                <label for="descripcionAdicionales" class="col-2 col-form-label">Descripción:</label>
                                                <div class="col-10">
                                                    <textarea class="form-control" id="descripcionAdicionales" name="descripcionAdicionales" rows="4">Incluye traslados entre el hotel y el Aeropuerto, desayunos, city tour, entrada a Convento de Santa Catalina.</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="valorAdicionales" class="col-2 col-form-label">Valor Adicionales:</label>
                                                <div class="col-2">
                                                    <input class="form-control" type="number" id="valorAdicionales" name="valorAdicionales" value="300">
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
                </div>
            </div>
        </section>

<?php
include('footer.php');
/*}*/
?>