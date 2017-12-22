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
                    <form method="post" action="gestionClientes.php" id="form">
                        <div class="float-left">
                            <i class="fa fa-user"></i>
                            Detalle de Cliente
                        </div>
                        <div class="float-right">
                            <div class="dropdown">
                                <input type='submit' value='Regresar' name='regresar' class='btn btn-light btn-sm'>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="spacer15"></div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-4"><p><b>DNI:</b></p></div>
                                <div class="col-8"><p>46815489</p></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><p><b>Nombre Completo:</b></p></div>
                                <div class="col-8"><p>Juan Veracruz</p></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><p><b>Género:</b></p></div>
                                <div class="col-8"><p>Masculino</p></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><p><b>Fecha de Nacimiento:</b></p></div>
                                <div class="col-8"><p>21/11/1980</p></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><p><b>Empresa:</b></p></div>
                                <div class="col-8"><p>GSDynamics</p></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><p><b>Email:</b></p></div>
                                <div class="col-8"><p>juan.veracruz@gsdynamics.com</p></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-3"><p><b>Teléfono Celular:</b></p></div>
                                <div class="col-9"><p>959784565</p></div>
                            </div>
                            <div class="row">
                                <div class="col-3"><p><b>Teléfono Fijo:</b></p></div>
                                <div class="col-9"><p>5488795135</p></div>
                            </div>
                            <div class="row">
                                <div class="col-3"><p><b>Dirección:</b></p></div>
                                <div class="col-9"><p>Urb. Los Girasoles L-3, Umacollo</p></div>
                                <div class="col-9 offset-3"><p>Lima, Perú</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="text-left"><p><b>Preferencias:</b></p></div>
                            <div style="border: 1px solid lightgrey; height: 100px"><p style="padding-left: 10px">Toalla extra, cama King</p></div>
                        </div>
                        <div class="spacer10"></div>
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
                        Historial de Reservas
                    </div>
                </div>
                <div class="card-block">
                    <div class="col-12">
                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th>IDReserva</th>
                                <th>Habitación</th>
                                <th>Nro de Noches</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1564894</td>
                                <td>303-Matrimonial</td>
                                <td>2</td>
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
