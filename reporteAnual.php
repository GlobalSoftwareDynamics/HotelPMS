<?php
include('session.php');
include('declaracionFechas.php');
include('funciones.php');
if(isset($_SESSION['login'])){
    include('header.php');
    include('navbarRecepcion.php');
    
    ?>

    <section class="container">
        <div class="card">
            <div class="card-header card-inverse card-info">
                <i class="fa fa-line-chart"></i>
                Reporte Anual
                <div class="float-right">
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <form method="post">
                                <input class="dropdown-item" type="submit" name="pdf" formaction="" value="Descargar PDF">
                            </form>
                        </div>
                    </div>
                </div>
                <span class="float-right">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <span class="float-right">
                    <button href="#collapsed" class="btn btn-light btn-sm" data-toggle="collapse">Mostrar Opciones</button>
                </span>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-12">
                        <div id="collapsed" class="collapse">
                            <form class="form-inline justify-content-center" method="post" action="#">
                                <label class="sr-only" for="idEmpresa">Año</label>
                                <input type="number" class="form-control mt-2 mb-2 mr-2" id="anio" name="anio" placeholder="YYYY" min="2000" max="9999">
                            </form>
                        </div>
                        <div class="spacer10"></div>
                        <div style="width: 100%; border-top: 1px solid lightgrey;"></div>
                    </div>
                </div>
                <div class="spacer20"></div>

            </div>
        </div>
    </section>

    <?php
    include('footer.php');
}
?>
