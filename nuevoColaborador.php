<?php
include('funciones.php');
include('declaracionFechas.php');
/*if(isset($_SESSION['login'])){*/
include('header.php');
if($_SESSION['userType'] == 1){
    include('navbarRecepcion.php');
}else{
    include('navbarAdmin.php');
}

?>
    <form method="post" id="formNuevoColaborador">
        <section class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header formularios card-inverse card-info">
                            <div class="float-left mt-1">
                                <i class="fa fa-user"></i>
                                &nbsp;&nbsp;Nuevo Colaborador
                            </div>
                            <div class="float-right">
                                <div class="dropdown">
                                    <input name="addColaborador" type="submit" form="formNuevoColaborador" class="btn btn-light btn-sm" formaction="gestionUsuarios.php" value="Guardar">
                                    <input name="regresar" type="submit" form="formNuevoColaborador" class="btn btn-light btn-sm" formaction="gestionUsuarios.php" value="Regresar">
                                </div>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="col-12">
                                <div class="spacer20"></div>
                                <div class="form-group row">
                                    <label for="dni" class="col-2 col-form-label">DNI:</label>
                                    <div class="col-10">
                                        <input class="form-control" type="number" id="dni" name="dni" min="0">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nombreCompleto" class="col-2 col-form-label">Nombre Completo:</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" id="nombreCompleto" name="nombreCompleto">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tipoUsuario" class="col-2 col-form-label">Tipo de Usuario:</label>
                                    <div class="col-10">
                                        <select name="tipoUsuario" id="tipoUsuario" class="form-control">
                                            <option selected disabled>Seleccionar</option>
                                            <option value="1">Administrador</option>
                                            <option value="2">Recepcionista</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="usuario" class="col-2 col-form-label">Usuario:</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" id="usuario" name="usuario">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="contrasena" class="col-2 col-form-label">Contraseña:</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" id="contrasena" name="contrasena">
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
/*}*/
?>