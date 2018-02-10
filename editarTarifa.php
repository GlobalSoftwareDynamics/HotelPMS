<?php
include('session.php');
include('funciones.php');
include('declaracionFechas.php');
if(isset($_SESSION['login'])){
    include('header.php');
    if($_SESSION['userType'] == 1){
        include('navbarRecepcion.php');
    }else{
        include('navbarAdmin.php');
    }

    $result = mysqli_query($link,"SELECT * FROM Tarifa WHERE idTarifa = '{$_POST['idTarifa']}'");
    while ($fila = mysqli_fetch_array($result)){
        $descripcion = $fila['descripcion'];
        $valor = $fila['valor'];
        $result1 = mysqli_query($link,"SELECT * FROM TipoHabitacion WHERE idTipoHabitacion = '{$fila['idTipoHabitacion']}'");
        while ($fila1 = mysqli_fetch_array($result1)){
            $tipoHabitacion = $fila1['descripcion'];
            $idTipoHabitacion = $fila1['idTipoHabitacion'];
        }
        switch ($fila['moneda']){
            case 1:
                $moneda = "Dólares";
                $numMoneda = "1";
                break;
            case 2:
                $moneda = "Soles";
                $numMoneda = "2";
                break;
            case 3:
                $moneda = "Euros";
                $numMoneda = "3";
                break;
        }
    }
    ?>
    <form method="post" id="formInsumo">
        <section class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header formularios card-inverse card-info">
                            <div class="float-left mt-1">
                                <i class="fa fa-money"></i>
                                &nbsp;&nbsp;Editar Tarifa
                            </div>
                            <div class="float-right">
                                <div class="dropdown">
                                    <input name="editar" type="submit" form="formInsumo" class="btn btn-light btn-sm" formaction="gestionTarifas.php" value="Guardar">
                                    <input name="regresar" type="submit" form="formInsumo" class="btn btn-light btn-sm" formaction="gestionTarifas.php" value="Regresar">
                                </div>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="col-12">
                                <div class="spacer20"></div>
                                <input type="hidden" name="idTarifa" value="<?php echo $_POST['idTarifa'];?>">
                                <div class="form-group row">
                                    <label for="descripcion" class="col-2 col-form-label">Descripción:</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" id="descripcion" name="descripcion" value="<?php echo $descripcion;?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tipoHabitacion" class="col-2 col-form-label">Tipo de Habitación:</label>
                                    <div class="col-10">
                                        <select class="form-control" name="tipoHabitacion" id="tipoHabitacion">
                                            <option value="<?php echo $idTipoHabitacion;?>"><?php echo $tipoHabitacion;?></option>
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
                                        <input class="form-control" type="number" min="0" id="valor" name="valor" value="<?php echo $valor;?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="moneda" class="col-2 col-form-label">Moneda:</label>
                                    <div class="col-10">
                                        <select name="moneda" id="moneda" class="form-control">
                                            <option value="<?php echo $numMoneda;?>"><?php echo $moneda;?></option>
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