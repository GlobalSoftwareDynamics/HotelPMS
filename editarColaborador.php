<?php
include('funciones.php');
include('declaracionFechas.php');
include('session.php');
if(isset($_SESSION['login'])){
include('header.php');
    if($_SESSION['userType'] == 1){
        include('navbarRecepcion.php');
    }else{
        include('navbarAdmin.php');
    }

$query = mysqli_query($link,"SELECT * FROM Colaborador WHERE idColaborador = '{$_POST['idColaborador']}'");
while($row = mysqli_fetch_array($query)){
    ?>
    <form method="post" id="formEditColaborador">
        <input type="hidden" name="idColaborador" value="<?php echo $_POST['idColaborador'];?>">
        <section class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header formularios card-inverse card-info">
                            <div class="float-left mt-1">
                                <i class="fa fa-user"></i>
                                &nbsp;&nbsp;Editar Colaborador
                            </div>
                            <div class="float-right">
                                <div class="dropdown">
                                    <input name="editColaborador" type="submit" form="formEditColaborador" class="btn btn-light btn-sm" formaction="gestionUsuarios.php" value="Guardar">
                                    <input name="regresar" type="submit" form="formEditColaborador" class="btn btn-light btn-sm" formaction="gestionUsuarios.php" value="Regresar">
                                </div>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="col-12">
                                <div class="spacer20"></div>
                                <div class="form-group row">
                                    <label for="dni" class="col-2 col-form-label">DNI:</label>
                                    <div class="col-10">
                                        <input class="form-control" type="number" id="dni" name="dni" value="<?php echo $_POST['idColaborador'];?>" disabled  min="0">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nombreCompleto" class="col-2 col-form-label">Nombre Completo:</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" id="nombreCompleto" name="nombreCompleto" value="<?php echo $row['nombreCompleto'];?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tipoUsuario" class="col-2 col-form-label">Tipo de Usuario:</label>
                                    <div class="col-10">
                                        <select name="tipoUsuario" id="tipoUsuario" class="form-control">
	                                        <?php
                                            $query2 = mysqli_query($link,"SELECT * FROM TipoUsuario");
                                            while($row2 = mysqli_fetch_array($query2)){
                                                if($row['idTipoUsuario'] == $row2['idTipoUsuario']){
	                                                echo "<option selected value='{$row['idTipoUsuario']}'>{$row2['descripcion']}</option>";
                                                }else{
                                                    echo "<option value='{$row2['idTipoUsuario']}'>{$row2['descripcion']}</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="usuario" class="col-2 col-form-label">Usuario:</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" id="usuario" name="usuario" value="<?php echo $row['usuario'];?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="contrasena" class="col-2 col-form-label">Contraseña:</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" id="contrasena" name="contrasena" value="<?php echo $row['contraseña'];?>">
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
}
include('footer.php');
}
?>