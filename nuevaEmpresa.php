<?php
include('funciones.php');
include('declaracionFechas.php');
include('session.php');
if(isset($_SESSION['login'])){
	include('header.php');
	include('navbarRecepcion.php');
		?>
        <form method="post" id="formInsumo">
            <section class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header formularios card-inverse card-info">
                                <div class="float-left mt-1">
                                    <i class="fa fa-industry"></i>
                                    &nbsp;&nbsp;Agregar Empresa
                                </div>
                                <div class="float-right">
                                    <input name="addEmpresa" type="submit" form="formInsumo" class="btn btn-light btn-sm" formaction="nuevaEmpresa2.php" value="Guardar">
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
                                                <input class="form-control" type="text" id="ruc" name="ruc">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="razonSocial" class="col-4 col-form-label">Razón Social:</label>
                                            <div class="col-8">
                                                <input class="form-control" type="text" id="razonSocial" name="razonSocial">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="rubro" class="col-4 col-form-label">Rubro:</label>
                                            <div class="col-8">
                                                <input class="form-control" type="text" id="rubro" name="rubro">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="direccion" class="col-4 col-form-label">Dirección Fiscal:</label>
                                            <div class="col-8">
                                                <input class="form-control" type="text" id="direccion" name="direccion">
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