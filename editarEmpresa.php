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

	if(isset($_POST['addContacto'])){

        $query = mysqli_query($link,"INSERT INTO Huesped(idEmpresa,idCiudad,idGenero,nacionalidad_idPais,nombreCompleto,direccion,correoElectronico,codigoPostal,telefonoFijo,telefonoCelular,fechaNacimiento,preferencias,vip,contacto,dni) VALUES ('{$_POST['idEmpresa']}',null,null,null,'{$_POST['nombreCompleto']}',null,'{$_POST['email']}',null,'{$_POST['telefono']}','{$_POST['anexo']}',null,null,null,1,'{$_POST['dni']}')");
        $queryPerformed = "INSERT INTO Huesped(idEmpresa,idCiudad,idGenero,nacionalidad_idPais,nombreCompleto,direccion,correoElectronico,codigoPostal,telefonoFijo,telefonoCelular,fechaNacimiento,preferencias,vip,contacto,dni) VALUES ({$_POST['idEmpresa']},null,null,null,{$_POST['nombreCompleto']},null,{$_POST['email']},null,{$_POST['telefono']},{$_POST['anexo']}'null,null,null,1,{$_POST['dni']})";
        $databaseLog = mysqli_query($link, "INSERT INTO DatabaseLog (idColaborador,fechaHora,evento,tipo,consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','Contacto','{$queryPerformed}')");

    }

	if(isset($_POST['eliminar'])){

        $query = mysqli_query($link,"UPDATE Huesped SET contacto = 0 WHERE idHuesped = '{$_POST['idHuesped']}'");
        $queryPerformed = "UPDATE Huesped SET contacto = 0 WHERE idHuesped = {$_POST['idHuesped']}";
        $databaseLog = mysqli_query($link, "INSERT INTO DatabaseLog (idColaborador,fechaHora,evento,tipo,consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','DELETE','Contacto','{$queryPerformed}')");

    }

    if (isset($_POST['addTarifa'])){

        $query = mysqli_query($link,"INSERT INTO Tarifa(idTipoHabitacion,idEmpresa,descripcion,valor,moneda) VALUES ('{$_POST['tipoHabitacion']}','{$_POST['idEmpresa']}','{$_POST['descripcion']}','{$_POST['valor']}','{$_POST['moneda']}')");

        $queryPerformed = "INSERT INTO Tarifa(idTipoHabitacion,idEmpresa,descripcion,valor,moneda) VALUES ({$_POST['tipoHabitacion']},{$_POST['idEmpresa']},{$_POST['descripcion']},{$_POST['valor']},{$_POST['moneda']})";

        $databaseLog = mysqli_query($link, "INSERT INTO DatabaseLog (idColaborador,fechaHora,evento,tipo,consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','Tarifa','{$queryPerformed}')");

    }

    if (isset($_POST['eliminarTarifa'])){

        $query = mysqli_query($link,"DELETE FROM Tarifa WHERE idTarifa = '{$_POST['idTarifa']}' AND idEmpresa = '{$_POST['idEmpresa']}'");

        $queryPerformed = "DELETE FROM Tarifa WHERE idTarifa = {$_POST['idTarifa']} AND idEmpresa = {$_POST['idEmpresa']}";

        $databaseLog = mysqli_query($link, "INSERT INTO DatabaseLog (idColaborador,fechaHora,evento,tipo,consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','DELETE','Tarifa','{$queryPerformed}')");

    }

	$result = mysqli_query($link,"SELECT * FROM Empresa WHERE idEmpresa = '{$_POST['idEmpresa']}'");
	while($row = mysqli_fetch_array($result)) {
		?>
        <form method="post" id="formInsumo">
            <input type="hidden" name="idEmpresa" value="<?php echo $_POST['idEmpresa'];?>">
            <section class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header formularios card-inverse card-info">
                                <div class="float-left mt-1">
                                    <i class="fa fa-industry"></i>
                                    &nbsp;&nbsp;Editar Empresa
                                </div>
                                <div class="float-right">
                                    <input name="editEmpresa" type="submit" form="formInsumo" class="btn btn-light btn-sm" formaction="gestionEmpresas.php" value="Guardar">
                                    <input name="regresar" type="submit" form="formInsumo" class="btn btn-light btn-sm" formaction="gestionEmpresas.php" value="Regresar">
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="spacer20"></div>
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label for="ruc" class="col-4 col-form-label">RUC:</label>
                                            <div class="col-4">
                                                <input class="form-control" type="number" id="ruc" name="ruc" value="<?php echo $row['idEmpresa'];?>" disabled min="0">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="razonSocial" class="col-4 col-form-label">Razón Social:</label>
                                            <div class="col-8">
                                                <input class="form-control" type="text" id="razonSocial" name="razonSocial" value="<?php echo $row['razonSocial'];?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="rubro" class="col-4 col-form-label">Rubro:</label>
                                            <div class="col-8">
                                                <input class="form-control" type="text" id="rubro" name="rubro" value="<?php echo $row['rubro'];?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="direccion" class="col-4 col-form-label">Dirección Fiscal:</label>
                                            <div class="col-8">
                                                <input class="form-control" type="text" id="direccion" name="direccion" value="<?php echo $row['direccionFiscal'];?>">
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

        <div class="spacer20"></div>

        <section class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header formularios card-inverse card-info">
                            <form method="post" action="gestionEmpresas.php" id="form">
                                <div class="float-left">
                                    <i class="fa fa-industry"></i>
                                    Listado de Tarifas
                                </div>
                                <div class="float-right">
                                    <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#modalTarifa">Agregar Tarifa</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-block">
                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <th>Descripción</th>
                                    <th>Monto</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $query = mysqli_query($link,"SELECT * FROM Tarifa WHERE idEmpresa = '{$_POST['idEmpresa']}'");
                                while($fila = mysqli_fetch_array($query)){
                                    echo "<tr>";
                                    echo "<td>{$fila['descripcion']}</td>";
                                    echo "<td>{$fila['moneda']} {$fila['valor']}</td>";
                                    echo "<td>
                                            <form method='post' action='#' id='deleteForm'>
                                                <input type='hidden' name='idEmpresa' value='{$_POST['idEmpresa']}'>
                                                <input type='hidden' name='idTarifa' value='{$fila['idTarifa']}'>
                                                <button type='submit' name='eliminarTarifa' class='btn btn-sm btn-outline-danger' form='deleteForm'>Eliminar</button>
                                            </form>
                                        </td>";
                                    echo "</tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="spacer20"></div>

        <section class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header formularios card-inverse card-info">
                            <form method="post" action="gestionEmpresas.php" id="form">
                                <div class="float-left">
                                    <i class="fa fa-industry"></i>
                                    Listado de Contactos
                                </div>
                                <div class="float-right">
                                    <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#modalContacto">Agregar Contacto</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-block">
                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Teléfono Fijo</th>
                                    <th>Teléfono Celular</th>
                                    <th>E-Mail</th>
                                </tr>
                                </thead>
                                <tbody>
								<?php
								$query = mysqli_query($link,"SELECT * FROM Huesped WHERE contacto = 1 AND idEmpresa = '{$_POST['idEmpresa']}'");
								while($fila = mysqli_fetch_array($query)){
									echo "<tr>";
									echo "<td>{$fila['nombreCompleto']}</td>";
									echo "<td>{$fila['telefonoFijo']}</td>";
                                    echo "<td>{$fila['telefonoCelular']}</td>";
									echo "<td>{$fila['correoElectronico']}</td>";
									echo "<td>
                                            <form method='post' action='#' id='deleteForm'>
                                                <input type='hidden' name='idEmpresa' value='{$_POST['idEmpresa']}'>
                                                <button type='submit' name='eliminar' value='{$fila['idHuesped']}' class='btn btn-sm btn-outline-danger' form='deleteForm'>Eliminar</button>
                                            </form>
                                        </td>";
									echo "</tr>";
								}
								?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <form method="post" action="#" id="formModal">
            <input type="hidden" name="idEmpresa" value="<?php echo $_POST['idEmpresa'];?>">
            <div class="modal fade" id="modalContacto" tabindex="-1" role="dialog" aria-labelledby="modalContacto" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Agregar Contacto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="form-group row">
                                    <label class="col-form-label" for="dni">DNI:</label>
                                    <input type="text" name="dni" id="dni" class="form-control">
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label" for="nombreCompleto">Nombre Completo:</label>
                                    <input type="text" name="nombreCompleto" id="nombreCompleto" class="form-control">
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label" for="telefono">Teléfono Fijo:</label>
                                    <input type="text" name="telefono" id="telefono" class="form-control">
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label" for="anexo">Teléfono Celular:</label>
                                    <input type="text" name="anexo" id="anexo" class="form-control">
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label" for="email">E-Mail:</label>
                                    <input type="text" name="email" id="email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" form="formModal" value="Submit" name="addContacto">Guardar Cambios</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form method="post" action="#" id="formModal1">
            <input type="hidden" name="idEmpresa" value="<?php echo $_POST['idEmpresa'];?>">
            <div class="modal fade" id="modalTarifa" tabindex="-1" role="dialog" aria-labelledby="modalTarifa" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Agregar Tarifa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="form-group row">
                                    <label for="descripcion" class="col-form-label">Descripción:</label>
                                    <input class="form-control" type="text" id="descripcion" name="descripcion">
                                </div>
                                <div class="form-group row">
                                    <label for="tipoHabitacion" class="col-form-label">Tipo de Habitación:</label>
                                    <select class="form-control" name="tipoHabitacion" id="tipoHabitacion">
                                        <option>Seleccionar</option>
                                        <?php
                                        $result = mysqli_query($link,"SELECT * FROM TipoHabitacion");
                                        while ($fila = mysqli_fetch_array($result)){
                                            echo "<option value='{$fila['idTipoHabitacion']}'>{$fila['descripcion']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="valor" class="col-form-label">Valor:</label>
                                    <input class="form-control" type="number" id="valor" name="valor" min="0">
                                </div>
                                <div class="form-group row">
                                    <label for="moneda" class="col-form-label">Moneda:</label>
                                    <select name="moneda" id="moneda" class="form-control">
                                        <option selected disabled>Seleccionar</option>
                                        <option value="$">Dólares</option>
                                        <option value="S/.">Soles</option>
                                        <option value="€">Euros</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" form="formModal1" value="Submit" name="addTarifa">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

		<?php

	}
	include('footer.php');
}
?>