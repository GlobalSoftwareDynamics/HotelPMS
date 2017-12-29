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
                            <i class="fa fa-bed"></i>
                            &nbsp;&nbsp;Nueva Habitación
                        </div>
                        <div class="float-right">
                            <div class="dropdown">
                                <input name="addHabitacion" type="submit" form="formInsumo" class="btn btn-light btn-sm" formaction="nuevaHabitacion2.php" value="Siguiente">
                                <input name="regresar" type="submit" form="formInsumo" class="btn btn-light btn-sm" formaction="gestionHabitaciones.php" value="Regresar">
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="col-12">
                            <div class="spacer20"></div>
                            <div class="form-group row">
                                <label for="numero" class="col-2 col-form-label">Nro. Habitación:</label>
                                <div class="col-2">
                                    <input class="form-control" type="number" id="numero" name="numero">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tipoHabitacion" class="col-2 col-form-label">Tipo de Habitación:</label>
                                <div class="col-10">
                                    <select class="form-control" name="tipoHabitacion" id="tipoHabitacion">
                                        <option selected disabled>Seleccionar</option>
                                        <?php
                                        $query = mysqli_query($link,"SELECT * FROM TipoHabitacion");
                                        while($row = mysqli_fetch_array($query)){
                                            echo "<option value='{$row['idTipoHabitacion']}'>{$row['descripcion']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="vista" class="col-2 col-form-label">Vista:</label>
                                <div class="col-10">
                                    <select class="form-control" name="vista" id="vista">
                                        <option disabled selected>Seleccionar</option>
	                                    <?php
	                                    $query = mysqli_query($link,"SELECT * FROM TipoVista");
	                                    while($row = mysqli_fetch_array($query)){
		                                    echo "<option value='{$row['idTipoVista']}'>{$row['descripcion']}</option>";
	                                    }
	                                    ?>
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