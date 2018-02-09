<?php
include('declaracionFechas.php');
include('funciones.php');
include('session.php');
if(isset($_SESSION['login'])){
include('header.php');
include('navbarRecepcion.php');

$result = mysqli_query($link,"SELECT * FROM Empresa WHERE idEmpresa = '{$_POST['idEmpresa']}'");
while($row = mysqli_fetch_array($result)) {
?>

<section class="container">
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-header formularios card-inverse card-info">
                    <form method="post" action="gestionEmpresas.php" id="form">
                        <div class="float-left">
                            <i class="fa fa-industry"></i>
                            Detalle de Empresa
                        </div>
                    </form>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="spacer15"></div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4"><p><b>RUC:</b></p></div>
                                <div class="col-8"><p><?php echo $row['idEmpresa'];?></p></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><p><b>Razón Social:</b></p></div>
                                <div class="col-8"><p><?php echo $row['razonSocial'];?></p></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><p><b>Rubro:</b></p></div>
                                <div class="col-8"><p><?php echo $row['rubro'];?></p></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><p><b>Dirección Fiscal:</b></p></div>
                                <div class="col-8"><p><?php echo $row['direccionFiscal'];?></p></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><p><b>Desc. Corporativo:</b></p></div>
                                <div class="col-8"><p><?php echo $row['descuentoCorporativo'];?></p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="card">
                <div class="card-header formularios card-inverse card-info">
                    <form method="post" action="gestionEmpresas.php" id="form">
                        <div class="float-left">
                            <i class="fa fa-industry"></i>
                            Listado de Contactos
                        </div>
                        <div class="float-right">
                            <input type='submit' value='Regresar' name='regresar' class='btn btn-light btn-sm'>
                        </div>
                    </form>
                </div>
                <div class="card-block">
                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Área</th>
                            <th>Cargo</th>
                            <th>Teléfono</th>
                            <th>Anexo</th>
                            <th>E-Mail</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = mysqli_query($link,"SELECT * FROM Contacto WHERE idContacto IN (SELECT idContacto FROM ContactoEmpresa WHERE idEmpresa = '{$_POST['idEmpresa']}')");
                        while($fila = mysqli_fetch_array($query)){
	                        echo "<tr>";
	                        echo "<td>{$fila['nombreCompleto']}</td>";
	                        echo "<td>{$fila['area']}</td>";
	                        echo "<td>{$fila['cargo']}</td>";
	                        echo "<td>{$fila['telefono']}</td>";
	                        echo "<td>{$fila['anexo']}</td>";
	                        echo "<td>{$fila['correoElectronico']}</td>";
	                        echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
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
                <div class="card-header formularios card-inverse card-info">
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
                            <?php
                            $query = mysqli_query($link,"SELECT * FROM Huesped WHERE idEmpresa = '{$_POST['idEmpresa']}'");
                            while($fila = mysqli_fetch_array($query)){
                                echo "<tr>";
                                    echo "<td>{$fila['idHuesped']}</td>";
                                    echo "<td>{$fila['nombreCompleto']}</td>";
                                    echo "<td>{$fila['correoElectronico']}</td>";
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
}
include('footer.php');
}
?>
