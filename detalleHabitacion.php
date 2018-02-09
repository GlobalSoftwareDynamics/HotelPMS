<?php
include('session.php');
include('declaracionFechas.php');
include('funciones.php');
if(isset($_SESSION['login'])){
    include('header.php');
    include('navbarRecepcion.php');

    $idHabitacion = null;
    $idTipoHabitacion = null;
    $tipoHabitacion = null;
    $vista = null;

    $query = mysqli_query($link,"SELECT * FROM Habitacion WHERE idHabitacion = '{$_POST['idHabitacionSeleccionada']}'");
    while($row = mysqli_fetch_array($query)) {
        $idHabitacion = $row['idHabitacion'];
	    $query2 = mysqli_query($link, "SELECT * FROM TipoHabitacion WHERE idTipoHabitacion = '{$row['idTipoHabitacion']}'");
	    while ($row2 = mysqli_fetch_array($query2)) {
	        $idTipoHabitacion = $row['idTipoHabitacion'];
	        $tipoHabitacion = $row2['descripcion'];
	    }
	    $query2 = mysqli_query($link, "SELECT * FROM TipoVista WHERE idTipoVista = '{$row['idTipoVista']}'");
	    while ($row2 = mysqli_fetch_array($query2)) {
		    $vista = $row2['descripcion'];
	    }
    }
        ?>

        <section class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header formularios card-inverse card-info">
                            <form method="post" action="gestionHabitaciones.php" id="form">
                                <div class="float-left">
                                    <i class="fa fa-bed"></i>
                                    Detalle de Habitación
                                </div>
                                <div class="float-right">
                                    <div class="dropdown">
                                        <input type='submit' value='Regresar' name='regresar' class='btn btn-light btn-sm'>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-block">
                            <div class="col-12">
                                <div class="spacer15"></div>
                                <div class="row">
                                    <div class="col-3"><p><b>Nro Habitación:</b></p></div>
                                    <div class="col-9"><p><?php echo $idHabitacion;?></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-3"><p><b>Tipo:</b></p></div>
                                    <div class="col-9"><p><?php echo $tipoHabitacion;?></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-3"><p><b>Vista:</b></p></div>
                                    <div class="col-9"><p><?php echo $vista;?></p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="spacer15"></div>
        <section class="container">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header formularios card-inverse card-info">
                            <div class="float-left">
                                <i class="fa fa-info-circle"></i>
                                Características
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="col-12">
                                <table class="table">
                                    <tbody>
                                    <?php
                                    $query = mysqli_query($link,"SELECT * FROM CaracteristicaHabitacion WHERE idHabitacion = '{$idHabitacion}'");
                                    while($row = mysqli_fetch_array($query)){
                                        echo "<tr>";
                                        $query2 = mysqli_query($link,"SELECT * FROM Caracteristica WHERE idCaracteristica = '{$row['idCaracteristica']}'");
                                        while($row2 = mysqli_fetch_array($query2)){
	                                        echo "<td><strong>{$row2['descripcion']}:</strong></td>";
                                        }
                                            echo "<td>{$row['valor']}</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header formularios card-inverse card-info">
                            <div class="float-left">
                                <i class="fa fa-money"></i>
                                Tarifas
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="col-12">
                                <table class="table text-center">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Descripción</th>
                                        <th class="text-center">Costo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query = mysqli_query($link,"SELECT * FROM Tarifa WHERE idTipoHabitacion = '{$idTipoHabitacion}'");
                                    while($row = mysqli_fetch_array($query)){
                                        echo "<tr>";
                                            echo "<td>{$row['descripcion']}</td>";
                                            echo "<td>{$row['moneda']} {$row['valor']}</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
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
