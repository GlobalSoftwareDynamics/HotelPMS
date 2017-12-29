<?php
include('session.php');
include('funciones.php');
include('declaracionFechas.php');
if(isset($_SESSION['login'])){
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
                            <i class="fa fa-money"></i>
                            &nbsp;&nbsp;Nueva Tarifa
                        </div>
                        <div class="float-right">
                            <div class="dropdown">
                                <input name="addTarifa" type="submit" form="formInsumo" class="btn btn-light btn-sm" formaction="gestionTarifas.php" value="Guardar">
                                <input name="regresar" type="submit" form="formInsumo" class="btn btn-light btn-sm" formaction="gestionTarifas.php" value="Regresar">
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="col-12">
                            <div class="spacer20"></div>
                            <div class="form-group row">
                                <label for="descripcion" class="col-2 col-form-label">Descripción:</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" id="descripcion" name="descripcion">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tipoHabitacion" class="col-2 col-form-label">Tipo de Habitación:</label>
                                <div class="col-10">
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
                            </div>
                            <div class="form-group row">
                                <label for="valor" class="col-2 col-form-label">Valor:</label>
                                <div class="col-2">
                                    <input class="form-control" type="number" id="valor" name="valor" min="0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="moneda" class="col-2 col-form-label">Moneda:</label>
                                <div class="col-10">
                                    <select name="moneda" id="moneda" class="form-control">
                                        <option selected disabled>Seleccionar</option>
                                        <option value="$">Dólares</option>
                                        <option value="S/.">Soles</option>
                                        <option value="€">Euros</option>
                                    </select>
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
}
?>