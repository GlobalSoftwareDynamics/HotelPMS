<?php
include('funciones.php');
include('declaracionFechas.php');
include('session.php');
if(isset($_SESSION['login'])){
	include('header.php');
	include('navbarRecepcion.php');

	if(isset($_POST['addContacto'])){
        $dni = 1;
        if($_POST['dni'] != ''){
            $dni = $_POST['dni'];
        }else{
            $id = mysqli_query($link, "SELECT * FROM Contacto");
            $dni += mysqli_num_rows($id);
        }
		$insert = mysqli_query($link,"INSERT INTO Contacto VALUES ('{$dni}','{$_POST['nombreCompleto']}','{$_POST['telefono']}','{$_POST['anexo']}','{$_POST['email']}','{$_POST['area']}','{$_POST['cargo']}')");
		$insert = mysqli_query($link,"INSERT INTO ContactoEmpresa VALUES ('{$_POST['idEmpresa']}','{$dni}')");
	}

	if(isset($_POST['eliminar'])){
	    $flag = false;
	    $delete = mysqli_query($link,"DELETE FROM ContactoEmpresa WHERE idContacto = '{$_POST['eliminar']}' AND idEmpresa = '{$_POST['idEmpresa']}'");
	    $query = mysqli_query($link,"SELECT * FROM ContactoEmpresa WHERE idContacto = '{$_POST['eliminar']}'");
	    while($row = mysqli_fetch_array($query)){
	        $flag = true;
        }
        if(!$flag){
	        $delete = mysqli_query($link,"DELETE FROM Contacto WHERE idContacto = '{$_POST['eliminar']}'");
        }
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
                            <div class="card-header card-inverse card-info">
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
                                        <div class="form-group row">
                                            <label for="descuento" class="col-4 col-form-label">Dscto. Corporativc:</label>
                                            <div class="col-2">
                                                <input class="form-control" type="number" id="descuento" name="descuento" value="<?php echo $row['descuentoCorporativo'];?>" min="0">
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
                        <div class="card-header card-inverse card-info">
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
                                    <th>Área</th>
                                    <th>Cargo</th>
                                    <th>Teléfono</th>
                                    <th>Anexo</th>
                                    <th>E-Mail</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
								<?php
								$query = mysqli_query($link,"SELECT * FROM Contacto WHERE idContacto IN (SELECT idContacto FROM ContactoEmpresa WHERE idEmpresa = '{$_POST['idEmpresa']}')");
								while($fila = mysqli_fetch_array($query)){
									echo "<tr>";
									echo "<td>{$fila['nombreCompleto']}</td>";
									echo "<td>{$fila['area']}</td>";
									echo "<td>{$fila['cargo']}</td>";
									echo "<td>{$fila['telefono']}</td>";
									echo "<td>{$fila['anexo']}</td>";
									echo "<td>{$fila['correoElectronico']}</td>";
									echo "<td>
                                            <form method='post' action='#' id='deleteForm'>
                                                <input type='hidden' name='idEmpresa' value='{$_POST['idEmpresa']}'>
                                                <button type='submit' name='eliminar' value='{$fila['idContacto']}' class='btn btn-sm btn-outline-danger' form='deleteForm'>Eliminar</button>
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
                                    <label class="col-form-label" for="area">Área:</label>
                                    <input type="text" name="area" id="area" class="form-control">
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label" for="cargo">Cargo:</label>
                                    <input type="text" name="cargo" id="cargo" class="form-control">
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label" for="telefono">Teléfono:</label>
                                    <input type="text" name="telefono" id="telefono" class="form-control">
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label" for="anexo">Anexo:</label>
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

		<?php

	}
	include('footer.php');
}
?>