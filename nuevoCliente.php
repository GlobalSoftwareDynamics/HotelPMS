<?php
include('session.php');
include('funciones.php');
include('declaracionFechas.php');
if(isset($_SESSION['login'])){
    include('header.php');
    include('navbarRecepcion.php');

    ?>
    <form method="post" id="formInsumo">
        <section class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header card-inverse card-info">
                            <div class="float-left mt-1">
                                <i class="fa fa-user"></i>
                                &nbsp;&nbsp;Nuevo Cliente
                            </div>
                            <div class="float-right">
                                <div class="dropdown">
                                    <input name="addCliente" type="submit" form="formInsumo" class="btn btn-light btn-sm" formaction="gestionClientes.php" value="Guardar">
                                    <input name="regresar" type="submit" form="formInsumo" class="btn btn-light btn-sm" formaction="gestionClientes.php" value="Regresar">
                                </div>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="spacer20"></div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="dni" class="col-4 col-form-label">DNI:</label>
                                        <div class="col-4">
                                            <input class="form-control" type="number" id="dni" name="dni" min="0">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nombreCompleto" class="col-4 col-form-label">Nombre Completo:</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" id="nombreCompleto" name="nombreCompleto">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="genero" class="col-4 col-form-label">Genero:</label>
                                        <div class="col-8">
                                            <select class="form-control" name="genero" id="genero">
                                                <option selected disabled>Seleccionar</option>
                                                <?php
                                                $result = mysqli_query($link,"SELECT * FROM Genero");
                                                while ($fila = mysqli_fetch_array($result)){
                                                    echo "<option value='{$fila['idGenero']}'>{$fila['idGenero']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="empresa" class="col-4 col-form-label">Empresa:</label>
                                        <div class="col-8">
                                            <select class="form-control" name="empresa" id="empresa">
                                                <option selected disabled>Seleccionar</option>
                                                <option>Sin Empresa</option>
                                                <?php
                                                $result = mysqli_query($link,"SELECT * FROM Empresa");
                                                while ($fila = mysqli_fetch_array($result)){
                                                    echo "<option value='{$fila['idEmpresa']}'>{$fila['razonSocial']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nacimiento" class="col-4 col-form-label">Fecha de Nacimiento:</label>
                                        <div class="col-8">
                                            <input class="form-control" type="date" id="nacimiento" name="nacimiento">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-4 col-form-label">Email:</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" id="email" name="email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="vip" class="col-4 col-form-label">VIP:</label>
                                        <div class="col-8">
                                            <input class="form-check mt-2" type="checkbox" id="vip" name="vip">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="celular" class="col-3 col-form-label">Celular:</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" id="celular" name="celular">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="telFijo" class="col-3 col-form-label">Tel. Fijo:</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" id="telFijo" name="telFijo">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="direccion" class="col-3 col-form-label">Dirección:</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" id="direccion" name="direccion">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="pais" class="col-3 col-form-label">Pais:</label>
                                        <div class="col-9">
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
                                    </div>
                                    <div class="form-group row">
                                        <label for="estado" class="col-3 col-form-label">Estado:</label>
                                        <div class="col-9">
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
                                    </div>
                                    <div class="form-group row">
                                        <label for="ciudad" class="col-3 col-form-label">Ciudad:</label>
                                        <div class="col-9">
                                            <select class="form-control" name="ciudad" id="ciudad">
                                                <option selected disabled>Seleccionar</option>
                                                <?php
                                                $result = mysqli_query($link,"SELECT * FROM Ciudad ORDER BY nombre ASC");
                                                while ($fila = mysqli_fetch_array($result)){
                                                    echo "<option value='{$fila['idCiudad']}'>{$fila['nombre']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="codPostal" class="col-3 col-form-label">ZIP Code:</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" id="codPostal" name="codPostal">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

    <?php
    include('footer.php');
}
?>