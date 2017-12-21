<?php
include('declaracionFechas.php');
include('funciones.php');
/*if(isset($_SESSION['login'])){*/
include('header.php');
include('navbarRecepcion.php');

/*$result = mysqli_query($link,"SELECT * FROM Proveedor WHERE idProveedor = '{$_POST['idProveedor']}'");
while($row = mysqli_fetch_array($result)) {
    $result1 = mysqli_query($link,"SELECT * FROM Direccion WHERE idDireccion = '{$row['idDireccion']}'");
    while ($fila = mysqli_fetch_array($result1)){
        $direccion = $fila['direccion'];
        $result2 = mysqli_query($link,"SELECT * FROM Ciudad WHERE idCiudad = '{$fila['idCiudad']}'");
        while ($fila1 = mysqli_fetch_array($result2)){
            $ciudad = $fila1['nombre'];
            $result3 = mysqli_query($link,"SELECT * FROM Pais WHERE idPais = '{$fila1['idPais']}'");
            while ($fila2 = mysqli_fetch_array($result3)){
                $pais = $fila2['pais'];
            }
        }
    }*/
?>

<section class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-inverse card-info">
                    <form method="post" action="gestionPaquetes.php" id="form">
                        <div class="float-left">
                            <i class="fa fa-shopping-bag"></i>
                            Detalle de Paquete
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
                            <div class="col-3"><p><b>Nombre:</b></p></div>
                            <div class="col-9"><p>Paquete Noche de Bodas</p></div>
                        </div>
                        <div class="row">
                            <div class="col-3"><p><b>Nro. de Noches:</b></p></div>
                            <div class="col-9"><p>1</p></div>
                        </div>
                        <div class="row">
                            <div class="col-3"><p><b>Adicionales:</b></p></div>
                            <div class="col-9"><p>Incluye decoración, botella de Champagne, Bouquet de Rosas.</p></div>
                        </div>
                        <div class="row">
                            <div class="col-3"><p><b>Costo Adicionales:</b></p></div>
                            <div class="col-9"><p>$ 80.00</p></div>
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
        <div class="col-12">
            <div class="card">
                <div class="card-header card-inverse card-info">
                    <div class="float-left">
                        <i class="fa fa-bed"></i>
                        Habitaciones
                    </div>
                </div>
                <div class="card-block">
                    <div class="col-12">
                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th>Habitación</th>
                                <th>Cantidad</th>
                                <th>Tarifa</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Matrimonial</td>
                                <td>1</td>
                                <td>Regular: $ 120.00</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
/*}*/
include('footer.php');
/*}*/
?>
