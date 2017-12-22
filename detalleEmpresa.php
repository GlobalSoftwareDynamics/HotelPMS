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
                    <form method="post" action="gestionEmpresas.php" id="form">
                        <div class="float-left">
                            <i class="fa fa-industry"></i>
                            Detalle de Empresa
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
                                <div class="col-4"><p><b>RUC:</b></p></div>
                                <div class="col-8"><p>102654879800</p></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><p><b>Razón Social:</b></p></div>
                                <div class="col-8"><p>GSDynamics</p></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><p><b>Rubro:</b></p></div>
                                <div class="col-8"><p>Software</p></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><p><b>Dirección Fiscal:</b></p></div>
                                <div class="col-8"><p>Av. Lima 417, Arequipa</p></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><p><b>Desc. Corporativo:</b></p></div>
                                <div class="col-8"><p>10%</p></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-3"><p><b>DNI:</b></p></div>
                                <div class="col-9"><p>46815198</p></div>
                            </div>
                            <div class="row">
                                <div class="col-3"><p><b>Nombre Completo:</b></p></div>
                                <div class="col-9"><p>Ignacio Rondon</p></div>
                            </div>
                            <div class="row">
                                <div class="col-3"><p><b>Teléfono:</b></p></div>
                                <div class="col-9"><p>992112752</p></div>
                            </div>
                            <div class="row">
                                <div class="col-3"><p><b>Email:</b></p></div>
                                <div class="col-9"><p>ignacio.rondon@gsdynamics.com</p></div>
                            </div>
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
                        <i class="fa fa-users"></i>
                        Clientes de la Empresa
                    </div>
                </div>
                <div class="card-block">
                    <div class="col-12">
                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th>DNI</th>
                                <th>Nombre</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>46815489</td>
                                <td>Juan Veracruz</td>
                                <td>juan.veracruz@gsdynamics.com</td>
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
