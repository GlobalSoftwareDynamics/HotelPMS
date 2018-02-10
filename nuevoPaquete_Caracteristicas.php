<?php
include('session.php');
include('funciones.php');
include('declaracionFechas.php');
if(isset($_SESSION['login'])){
    include('header.php');
    include('navbarRecepcion.php');

    ?>
    <section class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header formularios card-inverse card-info">
                        <div class="float-left mt-1">
                            <i class="fa fa-shopping-bag"></i>
                            &nbsp;&nbsp;Nuevo Paquete
                        </div>
                        <div class="float-right">
                            <div class="dropdown">
                                <input name="addPaquete" type="submit" form="formAdicionales" class="btn btn-light btn-sm" formaction="gestionPaquetes.php" value="Finalizar">
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="col-12">
                            <div class="spacer20"></div>
                            <form method="post" id="formAdicionales">
                                <input type="hidden" value="<?php echo $_POST['idPaquete']?>" name="idPaquete">
                                <div class="form-group row">
                                    <label for="descripcionAdicionales" class="col-2 col-form-label">Descripción:</label>
                                    <div class="col-10">
                                        <textarea class="form-control" id="descripcionAdicionales" name="descripcionAdicionales" rows="4" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="valorAdicionales" class="col-2 col-form-label">Valor Adicionales:</label>
                                    <div class="col-2">
                                        <input class="form-control" type="number" id="valorAdicionales" name="valorAdicionales" required>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    include('footer.php');
}
?>