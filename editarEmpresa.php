<?php
include('funciones.php');
include('declaracionFechas.php');
include('session.php');
if(isset($_SESSION['login'])){
	include('header.php');
	include('navbarRecepcion.php');

	if(isset($_POST['addContacto'])){
	    $insert = mysqli_query($link,"INSERT INTO Contacto VALUES ('{$_POST['dni']}','{$_POST['nombreCompleto']}','{$_POST['telefono']}','{$_POST['email']}')");
	    $insert = mysqli_query($link,"INSERT INTO ContactoEmpresa VALUES ('{$_POST['idEmpresa']}','{$_POST['dni']}')");
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
                                                <input class="form-control" type="number" id="ruc" name="ruc" value="<?php echo $row['idEmpresa'];?>" disabled>
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
                                            <label for="descuento" class="col-4 col-form-label">Desc. Corporativc:</label>
                                            <div class="col-2">
                                                <input class="form-control" type="number" id="descuento" name="descuento" value="<?php echo $row['descuentoCorporativo'];?>">
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
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Teléfono</th>
                                    <th>E-Mail</th>
                                </tr>
                                </thead>
                                <tbody>
								<?php
								$query = mysqli_query($link,"SELECT * FROM Contacto WHERE idContacto IN (SELECT idContacto FROM ContactoEmpresa WHERE idEmpresa = '{$_POST['idEmpresa']}')");
								while($fila = mysqli_fetch_array($query)){
									echo "<tr>";
									echo "<td>{$fila['nombreCompleto']}</td>";
									echo "<td>{$fila['telefono']}</td>";
									echo "<td>{$fila['correoElectronico']}</td>";
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
                            <h5 class="modal-title">Agregar Cliente</h5>
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
                                    <label class="col-form-label" for="telefono">Teléfono:</label>
                                    <input type="text" name="telefono" id="telefono" class="form-control">
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label" for="email">E-Mail:</label>
                                    <input type="text" name="email" id="email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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