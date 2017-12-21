<?php
include('funciones.php');
include('declaracionFechas.php');
/*if(isset($_SESSION['login'])){*/
include('header.php');
include('navbarRecepcion.php');

?>
    <form method="post" id="formPaquete">
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
                                    <input name="addPaquete" type="submit" form="formPaquete" class="btn btn-light btn-sm" formaction="nuevoPaquete_Caracteristicas.php" value="Guardar">
                                    <input name="regresar" type="submit" form="formPaquete" class="btn btn-light btn-sm" formaction="gestionPaquetes.php" value="Regresar">
                                </div>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="col-12">
                                <div class="spacer20"></div>
                                <div class="form-group row">
                                    <label for="nombre" class="col-2 col-form-label">Nombre:</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" id="nombre" name="nombre" value="Paquete Turismo Cultural Familiar">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="noches" class="col-2 col-form-label">Nro. de Noches:</label>
                                    <div class="col-1">
                                        <input class="form-control" type="number" id="noches" name="noches" value="4">
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