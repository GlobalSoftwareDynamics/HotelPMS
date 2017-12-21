<?php
include('declaracionFechas.php');
include('funciones.php');
/*if(isset($_SESSION['login'])){*/
include('header.php');
include('navbarRecepcion.php');

?>

<script>
    function myFunction() {
        // Declare variables
        var input, input2, input3, filter, filter2, filter3, table, tr, td, td2, td3, i;
        input = document.getElementById("dni");
        input2 = document.getElementById("nombre");
        input3 = document.getElementById("tipo");
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
        <div class="card-header card-inverse card-info">
            <i class="fa fa-list"></i>
            Gestión de Usuarios
            <div class="float-right">
                <div class="dropdown">
                    <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <form method="post">
                            <a class="dropdown-item" href="nuevoColaborador.php" style="font-size: 14px;">Registrar Nuevo Usuario</a>
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
                            <label class="sr-only" for="tipo">Tipo de Usuario</label>
                            <input type="text" class="form-control mt-2 mb-2 mr-2" id="tipo" placeholder="Tipo de Usuario" onkeyup="myFunction()">
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
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Tipo de Usario</th>
                            <th class="text-center">Usuario</th>
                            <th class="text-center">Contraseña</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>45484745</td>
                            <td>Juan Perez</td>
                            <td>Recepcionista</td>
                            <td>jperez</td>
                            <td>1234</td>
                            <td>
                                <form method='post'>
                                    <div class='dropdown'>
                                        <button class='btn btn-outline-primary btn-sm dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            Acciones
                                        </button>
                                        <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                            <button name='desactivar' class='dropdown-item' type='submit' formaction='editarColaborador.php'>Editar</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>13154648</td>
                            <td>Pablo Perez</td>
                            <td>Administrador</td>
                            <td>pperez</td>
                            <td>1234</td>
                            <td>
                                <form method='post'>
                                    <div class='dropdown'>
                                        <button class='btn btn-outline-primary btn-sm dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            Acciones
                                        </button>
                                        <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                            <button name='desactivar' class='dropdown-item' type='submit' formaction='editarColaborador.php'>Editar</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include('footer.php');
/*}*/
?>
