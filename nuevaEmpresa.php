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
                                <i class="fa fa-industry"></i>
                                &nbsp;&nbsp;Nueva Empresa
                            </div>
                            <div class="float-right">
                                <div class="dropdown">
                                    <input name="addCliente" type="submit" form="formInsumo" class="btn btn-light btn-sm" formaction="gestionEmpresas.php" value="Guardar">
                                    <input name="regresar" type="submit" form="formInsumo" class="btn btn-light btn-sm" formaction="gestionEmpresas.php" value="Regresar">
                                </div>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="spacer20"></div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="ruc" class="col-4 col-form-label">RUC:</label>
                                        <div class="col-4">
                                            <input class="form-control" type="number" id="ruc" name="ruc" value="109887546500" min="0">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="razonSocial" class="col-4 col-form-label">Razón Social:</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" id="razonSocial" name="razonSocial" value="Google">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="rubro" class="col-4 col-form-label">Rubro:</label>
                                        <div class="col-8">
                                            <select class="form-control" name="rubro" id="rubro">
                                                <option>Seleccionar</option>
                                                <option value="1" selected>Softawre</option>
                                                <option value="2">Automotriz</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="direccion" class="col-4 col-form-label">Dirección Fiscal:</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" id="direccion" name="direccion" value="Parque Industrial, Arequipa">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="descuento" class="col-4 col-form-label">Desc. Corporativc:</label>
                                        <div class="col-2">
                                            <input class="form-control" type="number" id="descuento" name="descuento" value="10" min="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <p><b>Información de Contacto:</b></p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dniContacto" class="col-4 col-form-label">DNI:</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" id="dniContacto" name="dniContacto" value="65984887">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nombreCompleto" class="col-4 col-form-label">Nombre Completo:</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" id="nombreCompleto" name="nombreCompleto" value="Miguel Valcarcel">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="telefonoContacto" class="col-4 col-form-label">Teléfono:</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" id="telefonoContacto" name="telefonoContacto" value="959875421">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="correoContacto" class="col-4 col-form-label">Email:</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" id="correoContacto" name="correoContacto" value="miguel.valcarcel@google.com">
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
/*}*/
?>