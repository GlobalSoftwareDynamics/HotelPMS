<?php
include('funciones.php');
include('declaracionFechas.php');
/*if(isset($_SESSION['login'])){*/
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
                                &nbsp;&nbsp;Editar Colaborador
                            </div>
                            <div class="float-right">
                                <div class="dropdown">
                                    <input name="addColaborador" type="submit" form="formInsumo" class="btn btn-light btn-sm" formaction="gestionUsuarios.php" value="Guardar">
                                    <input name="regresar" type="submit" form="formInsumo" class="btn btn-light btn-sm" formaction="gestionUsuarios.php" value="Regresar">
                                </div>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="col-12">
                                <div class="spacer20"></div>
                                <div class="form-group row">
                                    <label for="dni" class="col-2 col-form-label">DNI:</label>
                                    <div class="col-10">
                                        <input class="form-control" type="number" id="dni" name="dni" value="46815948">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nombreCompleto" class="col-2 col-form-label">Nombre Completo:</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" id="nombreCompleto" name="nombreCompleto" value="Jose Perez Perez">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tipoUsuario" class="col-2 col-form-label">Tipo de Usuario:</label>
                                    <div class="col-10">
                                        <select name="tipoUsuario" id="tipoUsuario" class="form-control">
                                            <option>Seleccionar</option>
                                            <option value="1" selected>Administrador</option>
                                            <option value="2">Recepcionista</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="usuario" class="col-2 col-form-label">Usuario:</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" id="usuario" name="usuario" value="jpperez">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="contrasena" class="col-2 col-form-label">Contraseña:</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" id="contrasena" name="contrasena" value="1234">
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