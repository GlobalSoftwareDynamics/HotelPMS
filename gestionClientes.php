<?php
include('session.php');
include('declaracionFechas.php');
include('funciones.php');
if(isset($_SESSION['login'])){
    include('header.php');
    if($_SESSION['userType'] == 1){
        include('navbarRecepcion.php');
    }else{
        include('navbarAdmin.php');
    }

    if (isset($_POST['addCliente'])){

        if ($_POST['empresa'] == "Sin Empresa"){
            $_POST['empresa'] = "NULL";
        }else{
            $_POST['empresa'] = "'".$_POST['empresa']."'";
        }

        $dni = 1;
        if($_POST['dni'] != ''){
            $dni = $_POST['dni'];
        }else{
            $id = mysqli_query($link, "SELECT * FROM Contacto");
            $dni += mysqli_num_rows($id);
        }

        if(isset($_POST['vip'])){
            $_POST['vip'] = 1;
        }else{
            $_POST['vip'] = 0;
        }

        $query = mysqli_query($link,"INSERT INTO Huesped(idHuesped,idEmpresa,idCiudad,idGenero,nacionalidad_idPais,nombreCompleto,direccion,correoElectronico,codigoPostal,telefonoFijo,telefonoCelular,fechaNacimiento,preferencias,vip)
        VALUES ('{$dni}',{$_POST['empresa']},'{$_POST['ciudad']}','{$_POST['genero']}','{$_POST['pais']}','{$_POST['nombreCompleto']}','{$_POST['direccion']}','{$_POST['email']}','{$_POST['codPostal']}','{$_POST['telFijo']}','{$_POST['celular']}','{$_POST['nacimiento']}',NULL,'{$_POST['vip']}')");

        $queryPerformed = "INSERT INTO Huesped(idHuesped,idEmpresa,idCiudad,idGenero,nacionalidad_idPais,nombreCompleto,direccion,correoElectronico,codigoPostal,telefonoFijo,telefonoCelular,fechaNacimiento,preferencias,vip)
        VALUES ({$dni},{$_POST['empresa']},{$_POST['ciudad']},{$_POST['genero']},{$_POST['pais']},{$_POST['nombreCompleto']},{$_POST['direccion']},{$_POST['email']},{$_POST['codPostal']},{$_POST['telFijo']},{$_POST['celular']},{$_POST['nacimiento']},NULL,{$_POST['vip']})";

        $databaseLog = mysqli_query($link, "INSERT INTO DatabaseLog (idColaborador,fechaHora,evento,tipo,consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','INSERT','Huesped','{$queryPerformed}')");

    }

    if (isset($_POST['editar'])){

        if ($_POST['empresa'] == "Sin Empresa"){
            $_POST['empresa'] = "NULL";
        }else{
            $_POST['empresa'] = "'".$_POST['empresa']."'";
        }

        if($_POST['ciudad'] == ''){
            $_POST['ciudad'] = "null";
        }else{
            $_POST['ciudad'] = "'{$_POST['ciudad']}'";
        }

        if($_POST['pais'] == ''){
            $_POST['pais'] = "null";
        }else{
            $_POST['pais'] = "'{$_POST['pais']}'";
        }

        if($_POST['direccion'] == ''){
            $_POST['direccion'] = "null";
        }else{
            $_POST['direccion'] = "'{$_POST['direccion']}'";
        }

        if($_POST['codPostal'] == ''){
            $_POST['codPostal'] = "null";
        }else{
            $_POST['codPostal'] = "'{$_POST['codPostal']}'";
        }

        if($_POST['celular'] == ''){
            $_POST['celular'] = "null";
        }else{
            $_POST['celular'] = "'{$_POST['celular']}'";
        }

        if($_POST['preferencias'] == ''){
            $_POST['preferencias'] = "null";
        }else{
            $_POST['preferencias'] = "'{$_POST['preferencias']}'";
        }

        if($_POST['telFijo'] == ''){
            $_POST['telFijo'] = "null";
        }else{
            $_POST['telFijo'] = "'{$_POST['telFijo']}'";
        }

        if($_POST['nacimiento'] == ''){
            $_POST['nacimiento'] = "null";
        }else{
            $_POST['nacimiento'] = "'{$_POST['nacimiento']}'";
        }

        if($_POST['genero'] == ''){
            $_POST['genero'] = "null";
        }else{
            $_POST['genero'] = "'{$_POST['genero']}'";
        }

        if(isset($_POST['vip'])){
            $_POST['vip'] = 1;
        }else{
            $_POST['vip'] = 0;
        }

        $query = mysqli_query($link,"UPDATE Huesped SET idHuesped = '{$_POST['dni']}', idEmpresa = {$_POST['empresa']}, idCiudad = {$_POST['ciudad']}, idGenero = {$_POST['genero']}, nacionalidad_idPais = {$_POST['pais']}, nombreCompleto = '{$_POST['nombreCompleto']}', direccion = {$_POST['direccion']}, correoElectronico = '{$_POST['email']}', 
        codigoPostal = {$_POST['codPostal']}, telefonoCelular = {$_POST['celular']}, telefonoFijo = {$_POST['telFijo']}, fechaNacimiento = {$_POST['nacimiento']}, preferencias = {$_POST['preferencias']}, vip = '{$_POST['vip']}' WHERE idHuesped = '{$_POST['idHuesped']}'");

        $queryPerformed = "UPDATE Huesped SET idHuesped = {$_POST['dni']}, idEmpresa = {$_POST['empresa']}, idCiudad = {$_POST['ciudad']}, idGenero = {$_POST['genero']}, nacionalidad_idPais = {$_POST['pais']}, nombreCompleto = {$_POST['nombreCompleto']}, direccion = {$_POST['direccion']}, correoElectronico = {$_POST['email']}, 
        codigoPostal = {$_POST['codPostal']}, telefonoCelular = {$_POST['celular']}, telefonoFijo = {$_POST['telFijo']}, fechaNacimiento = {$_POST['nacimiento']}, preferencias = {$_POST['preferencias']}, vip = {$_POST['vip']} WHERE idHuesped = {$_POST['idHuesped']}";

        $databaseLog = mysqli_query($link, "INSERT INTO DatabaseLog (idColaborador,fechaHora,evento,tipo,consulta) VALUES ('{$_SESSION['user']}','{$dateTime}','UPDATE','Huesped','{$queryPerformed}')");

    }

    ?>

    <script>
        function myFunction() {
            // Declare variables
            var input, input2, input3, filter, filter2, filter3, table, tr, td, td2, td3, i;
            input = document.getElementById("dni");
            input2 = document.getElementById("nombre");
            input3 = document.getElementById("empresa");
            filter = input.value.toUpperCase();
            filter2 = input2.value.toUpperCase();
            filter3 = input3.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                td2 = tr[i].getElementsByTagName("td")[1];
                td3 = tr[i].getElementsByTagName("td")[2];
                if ((td)&&(td2)) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        if(td2.innerHTML.toUpperCase().indexOf(filter2) > -1){
                            if(td3.innerHTML.toUpperCase().indexOf(filter3) > -1){
                                tr[i].style.display = "";
                            }else{
                                tr[i].style.display = "none";
                            }
                        }else{
                            tr[i].style.display = "none";
                        }
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

    <section class="container">
        <div class="card">
            <div class="card-header gestion card-inverse card-info">
                <i class="fa fa-list"></i>
                Gestión de Clientes
                <div class="float-right">
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <form method="post">
                                <a class="dropdown-item" href="nuevoCliente.php" style="font-size: 14px;">Registrar Nuevo Cliente</a>
                            </form>
                        </div>
                    </div>
                </div>
                <span class="float-right">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <span class="float-right">
                    <button href="#collapsed" class="btn btn-light btn-sm" data-toggle="collapse">Mostrar Filtros</button>
                </span>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-12">
                        <div id="collapsed" class="collapse">
                            <form class="form-inline justify-content-center" method="post" action="#">
                                <label class="sr-only" for="dni">DNI</label>
                                <input type="number" class="form-control mt-2 mb-2 mr-2" id="dni" placeholder="DNI" onkeyup="myFunction()">
                                <label class="sr-only" for="nombre">Nombre</label>
                                <input type="text" class="form-control mt-2 mb-2 mr-2" id="nombre" placeholder="Nombre" onkeyup="myFunction()">
                                <label class="sr-only" for="empresa">Empresa</label>
                                <input type="text" class="form-control mt-2 mb-2 mr-2" id="empresa" placeholder="Empresa" onkeyup="myFunction()">
                                <input type="submit" class="btn btn-primary" value="Limpiar" style="padding-left:28px; padding-right: 28px;">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="spacer10"></div>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered text-center" id="myTable">
                            <thead class="thead-default">
                            <tr>
                                <th class="text-center">DNI</th>
                                <th class="text-center">Nombre Completo</th>
                                <th class="text-center">Empresa</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $result = mysqli_query($link,"SELECT * FROM Huesped");
                            while ($fila = mysqli_fetch_array($result)){
                                $result1 = mysqli_query($link,"SELECT * FROM Empresa WHERE idEmpresa = '{$fila['idEmpresa']}'");
                                $numrows = mysqli_num_rows($result1);
                                if ($numrows == 0){
                                    $empresa = "";
                                }else{
                                    while ($fila1 = mysqli_fetch_array($result1)){
                                        $empresa = $fila1['razonSocial'];
                                    }
                                }
                                echo "<tr>";
                                echo "<td>{$fila['idHuesped']}</td>";
                                echo "<td>{$fila['nombreCompleto']}</td>";
                                echo "<td>{$empresa}</td>";
                                echo "<td>{$fila['correoElectronico']}</td>";
                                echo "
                                    <td>
                                        <form method='post'>
                                            <div class='dropdown'>
                                                <button class='btn btn-outline-primary btn-sm dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    Acciones
                                                </button>
                                                <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                                    <input type='hidden' value='{$fila['idHuesped']}' name='idHuesped'>
                                                    <button name='detalle' class='dropdown-item' type='submit' formaction='detalleCliente.php'>Ver Detalle</button>
                                                    <button name='editar' class='dropdown-item' type='submit' formaction='editarCliente.php'>Editar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                ";
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

    <?php
    include('footer.php');
}
?>
