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

    $result = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped = '{$_POST['idHuesped']}'");
    while ($fila = mysqli_fetch_array($result)){
        $codigoPostal = $fila['codigoPostal'];
        if($fila['idCiudad'] == ''){
            $idCiudad = "null";
            $ciudad = "Seleccionar";
            $fila['idCiudad'] = "null";
            $estado = "Seleccionar";
            $idEstado = "null";
            $pais = "Seleccionar";
            $idPais = "null";
        }else{
            $result1 = mysqli_query($link,"SELECT * FROM Ciudad WHERE idCiudad = '{$fila['idCiudad']}'");
            while ($fila1 = mysqli_fetch_array($result1)){
                $ciudad = $fila1['nombre'];
                $idCiudad = $fila1['idCiudad'];
                $result2 = mysqli_query($link,"SELECT * FROM EstadoPais WHERE idEstadoPais = '{$fila1['idEstadoPais']}'");
                while ($fila2 =  mysqli_fetch_array($result2)){
                    $estado = $fila2['nombre'];
                    $idEstado = $fila2['idEstadoPais'];
                    $result3 = mysqli_query($link,"SELECT * FROM Pais WHERE idPais = '{$fila2['idPais']}'");
                    while ($fila3 =  mysqli_fetch_array($result3)){
                        $pais = $fila3['nombre'];
                        $idPais = $fila3['idPais'];
                    }
                }
            }
        }

        $result1 = mysqli_query($link,"SELECT * FROM Empresa WHERE idEmpresa = '{$fila['idEmpresa']}'");
        $numrows = mysqli_num_rows($result1);
        if($numrows == 0){
            $empresa = "Sin Empresa";
            $idEmpresa = "Sin Empresa";
        }else{
            while ($fila1 = mysqli_fetch_array($result1)){
                $empresa = $fila1['razonSocial'];
                $idEmpresa = $fila['idEmpresa'];
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
                                <i class="fa fa-user"></i>
                                &nbsp;&nbsp;Editar Cliente
                            </div>
                            <div class="float-right">
                                <div class="dropdown">
                                    <input name="editar" type="submit" form="formInsumo" class="btn btn-light btn-sm" formaction="gestionClientes.php" value="Guardar">
                                    <input name="regresar" type="submit" form="formInsumo" class="btn btn-light btn-sm" formaction="gestionClientes.php" value="Regresar">
                                </div>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="spacer20"></div>
                                <div class="col-6">
                                    <input type="hidden" name="idHuesped" value="<?php echo $_POST['idHuesped']?>">
                                    <div class="form-group row">
                                        <label for="dni" class="col-4 col-form-label">DNI:</label>
                                        <div class="col-4">
                                            <input class="form-control" type="number" id="dni" name="dni" value="<?php echo $fila['dni']?>" min="0">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nombreCompleto" class="col-4 col-form-label">Nombre Completo:</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" id="nombreCompleto" name="nombreCompleto" value="<?php echo $fila['nombreCompleto']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="genero" class="col-4 col-form-label">Genero:</label>
                                        <div class="col-8">
                                            <select class="form-control" name="genero" id="genero">
                                                <option selected><?php echo $fila['idGenero']?></option>
                                                <?php
                                                $result1 = mysqli_query($link,"SELECT * FROM Genero");
                                                while ($fila1 = mysqli_fetch_array($result1)){
                                                    echo "<option>{$fila1['idGenero']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="empresa" class="col-4 col-form-label">Empresa:</label>
                                        <div class="col-8">
                                            <select class="form-control" name="empresa" id="empresa">
                                                <option value="<?php echo $idEmpresa?>" selected><?php echo $empresa?></option>
                                                <?php
                                                $result1 = mysqli_query($link,"SELECT * FROM Empresa ORDER BY razonSocial DESC");
                                                while ($fila1 = mysqli_fetch_array($result1)){
                                                    echo "<option value='{$fila1['idEmpresa']}'>{$fila1['razonSocial']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nacimiento" class="col-4 col-form-label">Fecha de Nacimiento:</label>
                                        <div class="col-8">
                                            <input class="form-control" type="date" id="nacimiento" name="nacimiento" value="<?php echo $fila['fechaNacimiento'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-4 col-form-label">Email:</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" id="email" name="email" value="<?php echo $fila['correoElectronico'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="vip" class="col-4 col-form-label">VIP:</label>
                                        <div class="col-8">
                                            <input class="form-check mt-2" type="checkbox" id="vip" name="vip" <?php if($fila['vip']==1){echo "checked";}?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="celular" class="col-3 col-form-label">Celular:</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" id="celular" name="celular" value="<?php echo $fila['telefonoCelular'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="telFijo" class="col-3 col-form-label">Tel. Fijo:</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" id="telFijo" name="telFijo" value="<?php echo $fila['telefonoFijo'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="direccion" class="col-3 col-form-label">Dirección:</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" id="direccion" name="direccion" value="<?php echo $fila['direccion'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="pais" class="col-3 col-form-label">Pais:</label>
                                        <div class="col-9">
                                            <select class="form-control" name="pais" id="pais" onchange="getEstado(this.value)">
                                                <option value="<?php echo $idPais;?>" selected><?php echo $pais;?></option>
                                                <?php
                                                $result = mysqli_query($link,"SELECT * FROM Pais ORDER BY nombre ASC");
                                                while ($fila = mysqli_fetch_array($result)){
                                                    echo "<option value='{$fila['idPais']}'>{$fila['nombre']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="estado" class="col-3 col-form-label">Estado:</label>
                                        <div class="col-9">
                                            <select class="form-control" name="estado" id="estado" onchange="getCiudad(this.value)">
                                                <option value="<?php echo $idEstado;?>" selected><?php echo $estado;?></option>
                                                <?php
                                                $result = mysqli_query($link,"SELECT * FROM EstadoPais ORDER BY nombre ASC");
                                                while ($fila = mysqli_fetch_array($result)){
                                                    echo "<option value='{$fila['idEstadoPais']}'>{$fila['nombre']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="ciudad" class="col-3 col-form-label">Ciudad:</label>
                                        <div class="col-9">
                                            <select class="form-control" name="ciudad" id="ciudad">
                                                <option value="<?php echo $idCiudad;?>" selected><?php echo $ciudad;?></option>
                                                <?php
                                                $result1 = mysqli_query($link,"SELECT * FROM Ciudad ORDER BY nombre DESC");
                                                while ($fila1 = mysqli_fetch_array($result1)){
                                                    echo "<option value='{$fila1['idCiudad']}'>{$fila1['nombre']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="codPostal" class="col-3 col-form-label">ZIP Code:</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" id="codPostal" name="codPostal" value="<?php echo $codigoPostal;?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <label for="preferencias" class="col-3 col-form-label">Preferencias:</label>
                                        <div class="col-12">
                                            <textarea name="preferencias" id="preferencias" rows="3" class="form-control"><?php echo $fila['preferencias'];?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

    <?php
    include('footer.php');
    }
}
?>